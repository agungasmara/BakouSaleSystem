
<template>
    <form class="form" @submit.prevent="login">
        <h1 class="form__title">Sign In Account</h1>
        <div class="form__group">
            <label>Email</label>
            <input type="text" class="form__control" v-model="credential.email">
            <small class="error__control" v-if="error.email">{{error.email[0]}}</small>
        </div>
        <div class="form__group">
            <label>Password</label>
            <input type="password" class="form__control" v-model="credential.password">
            <small class="error__control" v-if="error.password">{{error.password[0]}}</small>
        </div>
        <div class="form__group">
            <button :disabled="isProcessing" class="btn btn__primary">Login</button>
        </div>

        <div v-tabs>asf</div>
    </form>


</template>

<script type="text/javascript">
    import {post} from '../../helper/api'
    import {Flash} from '../../helper/flash'
    export default {
        data() {
            return {
                credential: {
                    email: '',
                    password: ''
                },
                error: {},
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
                post('/login', this.credential)
                    .then((res) => {
                        console.log(res);
                    if(res.data.success) {
                    // Flash.setSuccess('Congratulations! You have now successfully registered.')
                    // alert('sd')
                    this.$router.push('/register')
                }
                this.isProcessing = false
                })
                .catch((err) => {
                        if(err.response.status === 422) {
                        this.error = err.response.data
                    }
                    this.isProcessing = false
                })
            }
        }
    }
</script>