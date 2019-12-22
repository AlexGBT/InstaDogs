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
                if (response.data.attached.length) {
                    this.$el.querySelector('.btn').style.color = 'red';
                    this.usersThatLikedMeCount++;
                } else {
                    this.$el.querySelector('.btn').style.color = 'white';
                    this.usersThatLikedMeCount--;
                }
            },
            url(){
                return window.location.origin + '/like/' + this.postId;
            },
            likePost() {
                axios.get('/like/post/' + this.postId)
                .then(response => {
                    this.buttonStyle(response)
                })
                .catch(errors => {

                });
            }
        },
    }
</script>
