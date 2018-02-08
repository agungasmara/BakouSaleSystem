<template>
    <div>
      <router-view></router-view>
    </div>
</template>

<script type="text/javascript">
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'
    import axios from 'axios'

    export default {
        data() {
            return {
                credential: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                flash: Flash.state,
                error: Flash.state,
                error: {},
                isProcessing: false
            }
        },
        ready() {
            this.credential.name    = credential.name
            this.credential.email    = credential.email
            this.credential.password = credential.password
            this.credential.password_confirmation = credential.password_confirmation
            this.register()
        },
        mounted: function(){
        	
        },
        beforeUpdate(){
            axios.get(`/api/account/check_authorize`)
  		    .then(response => {
  		      var checkAuthenticationAccount = response.data['success']
  		      if(checkAuthenticationAccount==false){
  		      	this.$router.push('/account/login')
  		      }
  		    })
  		    .catch(e => {
  		      this.errors.push(e)
  		    })
        },
        created() {
        	axios.get(`/api/account/check_authorize`)
  		    .then(response => {
  		      var checkAuthenticationAccount = response.data['success']
  		      if(checkAuthenticationAccount==false){
  		      	this.$router.push('/account/login')
  		      }
  		    })
  		    .catch(e => {
  		      this.errors.push(e)
  		    })
        },
        methods: {
            register() {
                this.isProcessing = true
                this.error = {}
                post('/api/register', this.credential)
                    .then((res) => {
                    console.log(res);
                    if(res.data.registered) {
                    Flash.setSuccess('Congratulations! You have now successfully registered.')
                    this.$router.push('/login')
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