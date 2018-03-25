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

                <h1 class="section-title-inner"><span><i class="fa fa-lock"></i>
                    Register Account</span>
                </h1>
                <p>If you already have an account with us, please login at the <a href="http://localhost:81/open_cart/upload/index.php?route=account/login">login page</a>.</p>
            <div class="row userInfo">
                <h2 class="block-title-2"> Create an account </h2>
                <div class="flash flash__success" v-if="flash.success">
                   <!--  <v-alert color="success" icon="check_circle" value="true">
                        {{flash.success}}
                    </v-alert> -->
                     <alert :show.sync="showRight" placement="top-right" duration="3000" type="success" width="400px" dismissable value="true">
                      <span class="icon-ok-circled alert-icon-float-left"></span>
                      <strong>Well Done!</strong>
                      <p>{{flash.success}}.</p>
                    </alert>
                </div>
               
                <form role="form" class="regForm" @submit.prevent="submit">
                    <template>
                      <div v-if="flash.error" class="alert alert-danger"><i class="fa fa-wa fa-info-circle"></i> {{ flash.error }}</div>
                    </template>
                    <template>
                      <div v-if="flash.success" class="alert alert-success"><i class="fa fa-wa fa-check"></i> {{flash.success}}</div>
                    </template>

                    <fieldset id="account">
                      <legend>Your Personal Details</legend>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-firstname">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="First Name" id="input-firstname" class="form-control" v-model="firstname" :rules="firstnameRules" :counter="50" required />
                          <div class="text-danger"></div>                          
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-lastname">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" required name="lastname" value="<?php echo $lastname; ?>" placeholder="Last Name" id="input-lastname" class="form-control" v-model="lastname" title="Please enter your username (at least 3 characters)"/>
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-email">E-mail</label>
                        <div class="col-sm-9">
                          <input type="email" required name="email" value="<?php echo $email; ?>" placeholder="E-mail" id="input-email" class="form-control" v-model="email" />
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label text-right" for="input-telephone">Telephone</label>
                        <div class="col-sm-9">
                          <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="Telephone" id="input-telephone" class="form-control" v-model="telephone" />
                          <div class="text-danger"></div>
                        </div>
                        <div style="padding-bottom: 20px;margin-bottom: 20px;"></div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label text-right" for="input-fax">Fax</label>
                        <div class="col-sm-9">
                          <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="Fax" id="input-fax" class="form-control" v-model="fax"/>
                        </div>
                        <div class="text-danger"></div>
                      </div>
                    </fieldset>

                    <!-- <fieldset id="address">
                      <legend>Your address</legend>
                      <div class="form-group">
                        <label class="col-sm-3 control-label text-right" for="input-company">Company</label>
                        <div class="col-sm-9">
                          <input type="text" name="company" value="<?php echo $company; ?>" placeholder="Company" id="input-company" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-address-1">Address 1</label>
                        <div class="col-sm-9">
                          <input type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="Address 1" id="input-address-1" class="form-control" />
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label text-right" for="input-address-2">Address 2</label>
                        <div class="col-sm-9">
                          <input type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="Address 2" id="input-address-2" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-city">City</label>
                        <div class="col-sm-9">
                          <input type="text" name="city" value="<?php echo $city; ?>" placeholder="City" id="input-city" class="form-control" />
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-postcode">Post Code</label>
                        <div class="col-sm-9">
                          <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="Post Code" id="input-postcode" class="form-control" />
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-country">Country</label>
                        <div class="col-sm-9">
                          <select name="country_id" id="input-country" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($countries as $country) { ?>
                            <?php if ($country['country_id'] == $country_id) { ?>
                            <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-zone">Region / State</label>
                        <div class="col-sm-9">
                          <select name="zone_id" id="input-zone" class="form-control">
                          </select>
                          <div class="text-danger"></div>
                        </div>
                      </div>
                    </fieldset> -->

                    <fieldset>
                      <legend>Your Password</legend>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-password">Password</label>
                        <div class="col-sm-9">
                          <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" v-model="password" />
                          <div class="text-danger"></div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-3 control-label text-right" for="input-confirm">Password Confirm</label>
                        <div class="col-sm-9">
                          <input type="password" name="confirm" value="" placeholder="Password Confirm" id="input-confirm" class="form-control" v-model="confirm"/>
                          <div class="text-danger"></div>
                        </div>
                      </div>
                    </fieldset>

                    <!-- <fieldset>
                      <legend>Newsletter</legend>
                      <div class="form-group">
                        <label class="col-sm-3 control-label text-right">Subscribe</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name="newsletter" value="1" checked="checked" />Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="newsletter" value="0" />No
                            </label>                              
                        </div>
                      </div>
                    </fieldset> -->

                    <div class="buttons">
                      <div class="pull-right">
                        I have read and agree to the Privacy Policy  
                        <input type="checkbox" name="agree" value="1" checked="checked" />
                        &nbsp;
                        <input type="submit" value="Countinue" class="btn btn-primary" />
                      </div>
                    </div>
                    <div class="customer-padding" style="padding-bottom: 50px !important;"></div>

                   <!--  <div class="form-group">
                        <label>First name</label>
                        <input title="Please enter your username (at least 3 characters)" type="text" class="form-control" placeholder="Firstname" required minlength="3" v-model="firstname">
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input title="Please enter your username (at least 3 characters)" type="text" class="form-control" placeholder="Lastname" required minlength="3" v-model="lastname">
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input title="Please enter valid email" type="email" class="form-control" placeholder="E-mail" required v-model="email">
                    </div>
                     <div class="form-group">
                        <label>Telephone</label>
                        <input title="Please enter valid phone" type="tel" class="form-control" placeholder="Telephone" required v-model="telephone">
                    </div>
                     <div class="form-group">
                        <label>Address1</label>
                        <input title="Please enter valid address" type="text" class="form-control" placeholder="Address" required v-model="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input required minlength="5" title="Please enter your password, between 5 and 12 characters" type="password" class="form-control" placeholder="Password" v-model="password">
                    </div>
                    <div class="error">
                    </div>

                    <button class="btn btn-success pull-left" :disabled="not_working" @click="create_customer()">
                            <i class="fa fa-user"></i>Create an account
                    </button> -->

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
                firstname: '',
                firstnameRules: [
                  (v) => !!v || 'First name is required',
                  (v) => v && v.length <= 50 || 'First name must be less than 50 characters'
                ],
                lastname: '',
                email: '',
                telephone: '',
                fax: '',
                password: '',
                confirm: '',
                flash: Flash.state,
                error: Flash.state,

            }
        },
        methods: {
            submit () {
                axios.post('/api/account/register', {
                  first_name: this.firstname,
                  last_name: this.lastname,
                  email: this.email,
                  telephone: this.telephone,
                  fax: this.fax,
                  password: this.password,
                  confirm_password: this.confirm,
                  deviceId: 0,
                }).then((res)=>{
                    if(res.data.success){
                      Flash.setSuccess(res.data.message)
                      this.$router.push('/account/login');
                    }else{
                      Flash.setError(res.data.message)
                    }
                }).catch((err) => {
                  if(err.response.status === 401) {
                      this.error = err.response.data
                  }
                  Flash.setError('Error while trying to register.')
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
