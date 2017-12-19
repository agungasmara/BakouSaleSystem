<template>
    <section id="content">
      <!--breadcrumbs start-->
      <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
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
      </div>
      <!--breadcrumbs end-->
      <!--start container-->
      <div class="container">
        <div class="section">
          <p class="caption">Includes predefined classes for easy form layout options.</p>
          <div class="divider"></div>
          <!--Basic Form-->
          <div id="basic-form" class="section">
            <div class="row">
              
              <div class="flash flash__success" v-if="flash.success">
                {{flash.success}}
              </div>
              <form class="form" @submit.prevent="login">
                  <v-app>
                    <v-content>
                      <v-alert class="success" value='true'>
                          <v-icon>home</v-icon> Welcome Testing
                      </v-alert>
                      
                      <v-badge class="badge--left" value='true'><span class="badge__badge primary">6<span></span></span></v-badge>
                      <h1 class="form__title">Sign In Account</h1>
                      <!-- <div class="flash flash-success" v-if="flash.success">
                          {{ flash.success }}
                      </div> -->
                      <div class="flash flash-success" v-if="flash.error">
                          {{ flash.error }}
                      </div>
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
                    </v-content>
                  </v-app>
                  <!-- <div v-tabs>asf</div> -->   
              </form>
              <router-view></router-view>

            </div>
          </div>

        </div>
      </div>
    </section>
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
</script>