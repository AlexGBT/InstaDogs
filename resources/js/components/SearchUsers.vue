<template>
    <div>
         <input type="search" id="site-search-input" name="search"  v-model="userSearch"  @input="getUsersFromServer"  @blur="resultWrapperHide" >
         <div id="site-search-wrapper"  v-show="showSearchResults" >
            <ul>
                <li v-for="user in users"><a v-bind:href="url(user.id)">{{user.login}}</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                userSearch: '',
                showSearchResults:false,
                users: '',
                // url: window.location.origin,

            }
        },

        methods: {
            url(id){
                return window.location.origin+'/profile/'+id;
            },
            resultWrapperShow(){
                this.showSearchResults = true;
            },
            resultWrapperHide(){
                  setTimeout(()=>{
                    this.showSearchResults = false;
                },200);
            },
            getUsersFromServer() {
                let self = this;
                if (this.userSearch != '') {
                    this.resultWrapperShow();
                    axios.post('/user/search/' + this.userSearch)
                    .then(function (response) {
                        self.users = response.data;
                    })
                    .catch(function (error) {
                        self.users = error;
                    });
                } else {
                    this.resultWrapperHide();
                }
            }
        },
    }
</script>
