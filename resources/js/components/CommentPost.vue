<template>
    <div>
        <div class="list-group-wrapper" v-if="commentStatus">
            <ul class="list-group" id="infinite-list">
                <li class="list-group-item d-flex justify-content-between" v-for="item in items" >
                    <div><strong>{{item[1]+': '}} </strong>"{{item[0]}}"</div>
<!--                    <div @click="deleteComment">Butt</div>-->
                    <div @click="deleteComment(item[2])">del</div>
                </li>
            </ul>
        </div>
        <textarea placeholder="Comment it" v-model="commentBody" v-if="commentStatus"></textarea>
        <button class="btn btn-primary  " @click="sendComment" v-if="commentStatus" >Send</button>
        <button class="btn btn-primary  " @click="ableComments" >{{commentStatusLabel}}</button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'postId', 'userLogin', 'commentStatus'],

        mounted() {
            const ListItem = document.querySelector('#infinite-list');
            ListItem.addEventListener('scroll', e => {
                if (ListItem.scrollTop + ListItem.clientHeight  >= ListItem.scrollHeight) {
                    this.loadMore();
                }
            });
            this.loadMore();
        },

        data: function () {
            return {
                commentBody: '',
                nextItem: 1,
                items:[],
               }
        },
        computed: {
            commentStatusLabel: function() {
              if (this.commentStatus) {
                  return 'Disable'
              }
                   return  'Able Comments';
            },

        },
        methods: {
            loadMore() {
                let self = this;
                axios.post('/comment/load', {
                    post_id: this.postId,
                    comments_number: this.items.length,
                })
                    .then(function (response) {
                        // console.log(response.data);
                        // console.log(self.items.length);
                        for (var i = 0; i <= response.data.length; i++) {
                            self.items.push([response.data[i].body, response.data[i].user.login, response.data[i].id]);
                            // self.items.push(response.data[i].body);
                        }
                        // console.log(self.items);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            sendComment() {
                let self = this;
                axios.post('/comment', {
                    body: this.commentBody,
                    post_id: this.postId,
                    user_id: this.userId,
                })
                    .then(function (response) {
                        self.items.unshift([self.commentBody, self.userLogin, response.data.id]);
                        let lastComment = document.querySelector('.list-group-item');
                        lastComment.scrollIntoView({block: "center", behavior: "smooth"});
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            deleteComment(commentId) {
                let self = this;
                axios.delete('/comment/' + commentId)
                    .then(function (response) {
                        if (response.data == 'success') {
                            for (var i = 0; i<=self.items.length; i++){
                                if (self.items[i][2] == commentId) {
                                    self.items.splice(i,1);
                                    return
                                }
                            }
                        }
                     })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            ableComments() {
                let self = this;
                axios.get('/post/' + this.postId + '/edit'
                )
                    .then(function (response) {
                        self.commentStatus= !self.commentStatus ;
                        // console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

        }
    }

</script>
