<template>
	<div>
        <div class="container main-container headerOffset">
            <div class="row">
                <div class="breadcrumbDiv col-lg-12">
                    <ul class="breadcrumb">
                        <li><a href="">Home</a></li>
                        <li><a href="">My Account</a></li>
                        <li class="active"> My Address</li>
                    </ul>
                </div>
            </div>
            <!--/.row-->


            <div class="row">

                <div class="col-lg-9 col-md-9 col-sm-7">
                    <h1 class="section-title-inner"><span><i class="fa fa-map-marker"></i> My addresses </span></h1>

                    <p>Please configure your default billing and delivery addresses when placing an order. You may also add
                        additional addresses, which can be useful for sending gifts or receiving an order at your office.</p>

                    <div class="row userInfo">

                        <div class="col-lg-12">
                            <h2 class="block-title-2"> Your addresses are listed below. </h2>

                            <p> Be sure to update your personal information if it has changed.</p>
                        </div>

                        <div class="w100 clearfix">
                           <div v-for="data in response" class="col-xs-12 col-sm-6 col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>My Address</strong></h3>
                                        <ul>
                                            <li>
                                                <span class="address-name"> 
                                                    <strong>Tanim Ahmed</strong>
                                                    <strong>{{data.firstname}} {{data.lastname}}</strong>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="address-company"> 
                                                    TanimDesign & Development 
                                                    {{data.company}} 
                                                </span>
                                            </li>
                                            <li>
                                                <span class="address-line1"> 
                                                    Gulshan 2 , Road 50, House FO12EO 
                                                    {{data.address1}} 
                                                </span>
                                            </li>
                                            <li>
                                                <span class="address-line2"> 
                                                    Dhaka, Bangladesh 
                                                    {{data.address2}} 
                                                </span>
                                            </li>

                                        </ul>
                                    </div>  
                                </div>
                            </div>
                        </div> 
                        <!--/.w100-->

                        <div class="col-lg-12 clearfix">
                             <router-link v-bind:to="'/account/addressadd'" title="Add address" class="btn   btn-primary">
        	                    <i class="fa fa-plus-circle"></i> Add New Address 
        	                </router-link>

                        </div>

                        <div class="col-lg-12 clearfix">
                            <ul class="pager">
                                <li class="previous pull-right">
                                    <router-link v-bind:to="'/'" title="Orders">
                                       <i class="fa fa-home"></i> Go to Shop
                                    </router-link>
                                </li>
                                <li class="next pull-left">
        	                        <router-link v-bind:to="'/account/dashboard'" title="Orders">
        	                            &larr; Back to My Account
        	                        </router-link>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!--/row end-->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-5"></div>

            </div>
            <!--/row-->

            <div style="clear:both"></div>
        </div>
        <!-- /.main-container -->
	</div>
</template>


<!-- frontEnd App -->
<script type="text/javascript">

  import axios from 'axios'
  import Flash from '../../../../helper/flash'
  import VueTranslate from 'vue-translate-plugin'
  import Vue from 'vue';
  Vue.use(VueTranslate);
  
  export default{
    data(){
      return{
        loaded: false,
        response: null,
      }
    },
    created() {
        axios.get(`/api/address`)
        .then(response => {
            this.response = response.data['data']
            console.log(response.data['data'])
            this.loaded = true
        })
        .catch(e => {
          this.errors.push(e)
        })
    },
    locales: {
        en: {
            'entry_account': 'My Account',
            'entry_login': 'Login',
            'entry_register': 'Register'
        },
        kh: {
            'entry_account': 'គណនី',
            'entry_login': 'ចូល',
            'entry_register': 'ចុះឈ្មោះ'
        }
    },
    mounted: function(){

    }
  }
</script>