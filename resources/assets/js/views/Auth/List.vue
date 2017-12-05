<template>
    <div>
        <div class="flash flash__success" v-if="flash.success">
            {{flash.success}}
        </div>
        <form class="form" @submit.prevent="login">
            <v-app>
              <v-content>
                <div v-loop {{$}} >
                    
                </div>
              </v-content>
            </v-app>
            <!-- <div v-tabs>asf</div> -->
             
        </form>

        <router-view></router-view>
    </div>
</template>

<script type="text/javascript">
    import Flash from '../../helper/flash'
    import {post} from '../../helper/api'
    
    export default {
        data() {
            return {
                credential: {
                    email: '',
                    password: ''
                },
                flash: Flash.state,
                error: Flash.state,
                isProcessing: false
            }
        },
        mounted: function () {
            console.log(this.$http);
        },
        ready() {
          this.credential.email    = credential.email;
          this.credential.password = credential.password;
          this.login();
        },
        methods: {
            login() {
                this.isProcessing = true
                this.error = {}
                // post('http://localhost:8000/login', this.credential, function (data, status, request) {
                //     window.location = "#/register";
                //     this.$dispatch('login:success');
                //     storage.saveArray('credential', this.credential);
                //     $.snackbar({content: data.message, style: 'toast', toggle: 'snackbar'});

                //   }).error(function (data, status, request) {

                //     $.snackbar({content: data.message, style: 'toast', toggle: 'snackbar'});

                //   });
                post('/api/getTest', this.credential)
                    $getTest = getHttpExposeAPI(res);
                })
                .catch((err) => {
                    if(err.response.status === 422) {
                        this.error = err.response.data
                    }
                    Flash.setError('Error while trying to login.')
                    this.isProcessing = false
                })
            }
        }
    }
</script>