<template>
    <div>
         <span>
                <a :href="url()">
                    Likes:
                </a>
                {{usersThatLikedMeCount}}
         </span>
         <button class="btn btn-primary ml-4" @click="likePost" >I like it</button>
    </div>
</template>

<script>
    export default {
        props: ['postId','usersThatLikedMe'],
        data: function () {
            return {
                usersThatLikedMeCount: this.usersThatLikedMe,
            }
        },
        mounted() {
            this.initStyle();
        },

        methods: {
            initStyle() {
                axios.get('/like/check/' + this.postId)
                .then(response => {
                    if (response.data) {
                        this.$el.querySelector('.btn').style.color = 'red';
                    }
                })
                .catch(errors => {
                });
            },
            buttonStyle(response) {
                switch (response.data) {
                    case 1:
                        this.$el.querySelector('.btn').style.color = 'white';
                        this.usersThatLikedMeCount--;
                        break;
                    case 'no_likes':
                        alert("you don't have any likes");
                        break;
                    case "":
                        this.$el.querySelector('.btn').style.color = 'red';
                        this.usersThatLikedMeCount++;
                        break;
                }
            },
            url(){
                return window.location.origin + '/like/' + this.postId;
            },
            likePost() {
                axios.get('/like/post/' + this.postId)
                .then(response => {
                    this.buttonStyle(response)
                    console.log(response);
                })
                .catch(errors => {

                });
            }
        },
    }
</script>
