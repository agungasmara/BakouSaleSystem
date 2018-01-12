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

        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-7">
                <h1 class="section-title-inner"><span><i class="fa fa-lock"></i> Authentication</span></h1>

                <div class="row userInfo">

                    <div class="col-xs-12 col-sm-6">
                        <h2 class="block-title-2"><span>Already registered?</span></h2>

                        <form role="form" class="logForm ">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="checkbox">
                                    Remember me </label>
                            </div>
                            <div class="form-group">
                                <p><a title="Recover your forgotten password" href="forgot-password.html">Forgot your
                                    password? </a></p>
                            </div>
                            <a class="btn btn-primary" href="account.html"><i class="fa fa-sign-in"></i> Sign In</a>


                        </form>
                    </div>
                </div>
                <!--/row end-->

            </div>

            <div class="col-lg-3 col-md-3 col-sm-5"></div>
        </div>
        <!--/row-->

        <div style="clear:both"></div>
    </div>
    </div>
</template>

<script type="text/javascript">
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'

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
            this.credential.name    = credential.name;
            this.credential.email    = credential.email;
            this.credential.password = credential.password;
            this.credential.password_confirmation = credential.password_confirmation;
            this.register();
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
