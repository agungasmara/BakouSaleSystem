<template>
    <!--<section id="content">-->
    <section style="margin-top:100px;">
      <!--breadcrumbs start-->
      <!--<div id="breadcrumbs-wrapper" style="display: none;">-->
        <!-- Search for small screen -->
        <!--<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
          <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </div>
        <div class="container">
          <div class="row">
            <div class="col s10 m6 l6">
              <h5 class="breadcrumbs-title">Forms</h5>
              <ol class="breadcrumbs">
                <li><a href="index.html">Dashboard</a>
                </li>
                <li><a href="#">Forms</a>
                </li>
                <li class="active">Forms Layouts</li>
              </ol>
            </div>
            <div class="col s2 m6 l6">
              <a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-activates="dropdown1">
                <i class="material-icons hide-on-med-and-up">settings</i>
                <span class="hide-on-small-onl">Settings</span>
                <i class="material-icons right">arrow_drop_down</i>
              </a>
              <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!" class="grey-text text-darken-2">Access<span class="badge">1</span></a>
                </li>
                <li><a href="#!" class="grey-text text-darken-2">Profile<span class="new badge">2</span></a>
                </li>
                <li><a href="#!" class="grey-text text-darken-2">Notifications</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>-->
      <!--breadcrumbs end-->
      <!--start container-->
      <!--<div class="container">
        <div class="section">-->
          <!--Basic Form-->
          <!--<div id="basic-form" class="section">
            <div class="row">-->
              <!-- #########logo -->
              <center>
                <div style="padding:40px 0 20px 0;"><img src="/images/logo/bakou.png"/></div>
              </center>

              <v-app id="inspire" style="marign-top:150px">
                <v-flex xs12 offset-xs0 sm4 offset-sm6 md4 offset-md4>
                  <v-card>
                    <!--<div class="flash flash__success" v-if="flash.success">
                      {{flash.success}}
                    </div>-->
                    <v-form v-model="valid" ref="form" lazy-validation @submit.prevent="login">
                        <v-alert class="success" value='true' v-if="flash.success">
                            <v-icon>home</v-icon> {{flash.success}}
                        </v-alert>
                        <v-alert class="danger" value='true' v-if="flash.error">
                            {{ flash.error }}
                        </v-alert>
                        <!--<v-badge class="badge--left" value='true'><span class="badge__badge primary">6<span></span></span></v-badge>-->
                        <!--<v-alert class="info" value='true' v-if="!flash.success && !flash.error">
                            <center><v-icon style="float:left">home</v-icon> <div style="float:left;font-size:16px;padding-left:10px;">USER LOGIN</div></center>
                        </v-alert>-->
                        <!-- <div class="flash flash-success" v-if="flash.success">
                            {{ flash.success }}
                        </div> -->
                        <div class="container">
                          <v-flex sm12>
                              <v-text-field label="Email" v-model="credential.email" :rules="credential.emailRules" required></v-text-field>
                              <small class="error__control" v-if="error.email">{{error.email[0]}}</small>
                          </v-flex>
                          <v-flex sm12>
                              <v-text-field type="password" label="Password" v-model="credential.password" :rules="credential.passwordRules" required></v-text-field>
                              <small class="error__control" v-if="error.password">{{error.password[0]}}</small>
                          </v-flex>
                          <v-flex sm12>
                            <div>
                              <v-btn type="submit" class="btn primary" :disabled="isProcessing">Sign In</v-btn>
                            </div>
                          </v-flex>
                        </div>
                        <!-- <div v-tabs>asf</div> -->   
                    </v-form>
                  </v-card>
                </v-flex>
              </v-app>

              <footer>Copyright&copy;2018. Power By Bakou System. All Right Reserved.</footer>
            <!--</div>
          </div>

        </div>
      </div>-->
    </section>
</template>

<style type="text/css">
footer{text-align: center;padding:10px 0;color:#fff;}
.application.theme--light{background: none !important}
.card{overflow: normal !important}
  html body{
    overflow-y:hidden;
    background-image: url(/images/sea.jpg) ;
    background-position: center center;
    background-repeat:  no-repeat;
    background-attachment: fixed;
    background-size:  cover;
    background-color: #999;
  }
  button.btn.primary{width: 100%;}
  .btn.primary{margin:10px 0 !important;}
  .alert{padding:10px;}
  .alert.info{}
  .application .theme--light.icon, .theme--light .icon{color:#fff !important;}
  .application--wrap{min-height: 100%;}
  .alert.info{background-color:#003a5d !important;color:#fff !important;}
  button.btn.primary{background-color:#003a5d !important;}
</style>

<script type="text/javascript">
    import Flash from '../../helper/flash'
    import {post} from '../../helper/api'
    
    export default {
        data() {
            return {
                valid: true,
                credential: {
                    email: '',
                    password: '',
                    emailRules: [
                      (v) => !!v || 'E-mail is required',
                      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
                    ],
                    passwordRules: [
                      (v) => !!v || 'password is required',
                      (v) => v && v.length <= 32 || 'Code must be less than 32 characters'
                    ]
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
              if (this.$refs.form.validate()) {
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
                          window.location.href="/admin"
                          // this.$router.push('/admin')
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
    }
</script>