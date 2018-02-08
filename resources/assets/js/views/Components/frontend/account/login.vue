<template>
    <div>
      <div class="container main-container headerOffset">

        <div class="row">
            <div class="breadcrumbDiv col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active"> Authentication</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-7">
            <h1 class="section-title-inner">
                <span><i class="fa fa-lock"></i> Authentication</span>
            </h1>

            <div class="row userInfo">
                <h2 class="block-title-2"><span>Already registered?</span></h2>

                <form role="form" class="logForm" @submit.prevent="login">
                    <template>
                      <div v-if="flash.error" class="alert alert-danger"><i class="fa fa-wa fa-info-circle"></i> {{ flash.error }}</div>
                    </template>
                    <template>
                      <div v-if="flash.success" class="alert alert-success"><i class="fa fa-wa fa-check"></i> {{flash.success}}</div>
                    </template>
                    
                    <input type="hidden" v-model="credential.is_account" value="1">
                    <div class="form-group required">
                        <label class="control-label text-right">Email</label>
                        <input type="email" class="form-control" placeholder="Enter email" v-model="credential.email" required>
                    </div>
                    <div class="form-group required">
                        <label class="control-label text-right">Password</label>
                        <input type="password" class="form-control" placeholder="Password" v-model="credential.password"> 
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="checkbox">
                            Remember me 
                        </label>
                    </div>
                    <div class="form-group">
                        <p>
                            <a title="Recover your forgotten password" href="javascript:void(0);">
                                Forgot your password? 
                            </a>
                        </p>
                    </div>

                    <input type="submit" value="Sign In" class="btn btn-primary" />
                    
                   <!--  <router-link v-bind:to="'/account/dashboard/'" class="btn btn-primary">
                        <i class="fa fa-sign-in"></i> Sign In
                    </router-link> -->
                </form>

            </div>
            <!--/row end-->

        </div>

        <div class="col-lg-3 col-md-3 col-sm-5"></div>
        <!--/row-->

        <div style="clear:both"></div>
    </div>
    </div>
</template>

<script type="text/javascript">
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'
    import Vue from 'vue'
    var VueCookie = require('vue-cookie')
    Vue.use(VueCookie)

    export default {
        data() {
            return {
                valid: true,
                credential: {
                    email: '',
                    password: '',
                    is_account:1,
                    emailRules: [
                      (v) => !!v || 'E-mail is required',
                      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
                    ],
                    passwordRules: [
                      (v) => !!v || 'password is required',
                      (v) => v && v.length <= 32 || 'Code must be less than 32 characters'
                    ]
                },
                session_id : this.$cookie.get('session_id'),
                flash: Flash.state,
                error: Flash.state,
                isProcessing: false
            }
        },
        ready() {
          this.credential.email    = credential.email;
          this.credential.password = credential.password;
          this.credential.is_account = credential.is_account;
          this.login();
        },
        methods: {
            login() {
              // if (this.$refs.form.validate()) {
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
                      if(res.data.success) {
                          Flash.setSuccess('Congratulations! You have now successfully login.')
                          window.location.href="/account/dashboard"
                          // this.$router.push('/admin')
                      }else{
                          Flash.setError('You enter wrong username or password!')
                      }
                      this.isProcessing = false
                  })
                  .catch((err) => {
                      if(err.response.status === 422) {
                          this.error = err.response.data
                      }
                      Flash.setError(' Error while trying tologin.')
                      this.isProcessing = false
                  })
              // }
            }
        },
        // wait a look have this field user show button co
        watch:{
            firstname(){
                if(this.firstname.length > 0)
                    this.not_working=false
                else
                    this.not_working=true
            }
        }
    }
</script>