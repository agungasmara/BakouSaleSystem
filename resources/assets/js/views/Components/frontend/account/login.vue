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
            <h1 class="section-title-inner"><span><i class="fa fa-lock"></i> Authentication</span></h1>

            <div class="row userInfo">
                <h2 class="block-title-2"><span>Already registered?</span></h2>

                <form role="form" class="logForm ">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" placeholder="Enter email" v-model="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" v-model="password"> 
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="checkbox">
                            Remember me 
                        </label>
                    </div>
                    <div class="form-group">
                        <p>
                            <a title="Recover your forgotten password" href="forgot-password.html">
                                Forgot your password? 
                            </a>
                        </p>
                    </div>

                    <input @click="submit()" type="button" value="Sign In" class="btn btn-primary" />
                    
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
    import axios from 'axios'

    export default {
        data() {
            return {
                valid: true,
                email: '',
                password: '',
                flash:Flash.state

            }
        },
        methods: {
            submit () {
                axios.post('/api/customer/login', {
                  email: this.email,
                  password: this.password,
                }).then((res)=>{
                    if(res.data.success==true){
                        Flash.setSuccess(res.data.message)
                        this.$router.push('/account/dashboard')
                    }
                })
            },
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