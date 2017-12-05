<template>
    <div>
          <div>asdf
              <ul id="example-1">
                <li v-for="item in items">
                  {{ item.message }}
                </li>
              </ul>
          </div>


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
                post('/login', this.credential)
                    .then((res) => {
                        console.log(res);
                    if(res.data.success) {
                        Flash.setSuccess('Congratulations! You have now successfully registered.')
                    }else{
                        Flash.setError('Error while trying to login.')
                        // this.$router.push('/register')
                    }
                    this.isProcessing = false
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


<script type="text/javascript">
import Vue from 'vue'
import VueRouter from 'vue-router'

    var example1 = new Vue({
      el: '#example-1',
      data: {
        items: [
          { message: 'Foo' },
          { message: 'Bar' }
        ]
      }
    })
</script>