<template>
  <div>    

    <!-- Fixed navbar start -->
    <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
        <div class="navbar-top">
            
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                        <div class="pull-left ">
                            <ul class="userMenu ">
                                <li><a href="#"> <span class="hidden-xs">Helps</span><i
                                        class="glyphicon glyphicon-info-sign hide visible-xs "></i> 

                                    </a></li>
                                <li class="phone-number">
                                    <a href="callto:+12025550151">
                                        <span> <i class="glyphicon glyphicon-phone-alt "></i></span>
                                        <span class="hidden-xs" style="margin-left:5px"> +1-202-555-0151 </span> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 no-margin no-padding">
                       
                        <div class="pull-right">
                            <ul class="userMenu">
                                <li class="dropdown">
                                  <a href="" title="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i> 
                                    <span class="hidden-xs hidden-sm hidden-md">Language</span> 
                                    <span class="caret"></span>
                                  </a>
                                  <template>
                                      <TopHeader/>
                                  </template>
                                </li>
                                <li class="dropdown">
                                  <a href="" title="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                                    <span class="hidden-xs hidden-sm hidden-md">{{ t('entry_account') }}</span> 
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li v-for="data in data_list">
                                        <template v-if="data.action">
                                            <a @click="logout()" href="javascript:void(0);">{{data.name}}</a>
                                        </template>
                                        <template v-else>
                                            <router-link v-bind:to="data.link">
                                                <span v-translate>{{data.name}}</span>
                                            </router-link>
                                            
                                        </template>
                                        
                                    </li>
                                    <!-- <li>
                                        <router-link to="/account/dashboard">
                                            <span v-translate>entry_account</span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a href="">
                                            Order
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Transaction
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            Download
                                        </a>
                                    </li>
                                    <li>
                                        <router-link to="/account/register">
                                            <span v-translate>entry_register</span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/account/login">
                                            <span v-translate>entry_login</span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <a @click="logout()" href="javascript:void(0);">Logout</a>
                                    </li> -->
                                  </ul>
                                </li>
                                <li><router-link to="/account/signin" data-toggle="modal" data-target="#ModalLogin"> <span class="hidden-xs">SignIn</span>
                                    <i class="glyphicon glyphicon-log-in hide visible-xs "></i> </router-link></li>
                                <li class="hidden-xs">
                                    <router-link to="/account/register" data-toggle="modal" data-target="#ModalSignup">Create Account</router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/.navbar-top-->

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                        class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span
                        class="icon-bar"> </span> <span class="icon-bar"> </span></button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-cart"><i
                        class="fa fa-shopping-cart colorWhite"> </i> <span
                        class="cartRespons colorWhite">Cart ($210.00) </span></button>

                <router-link class="navbar-brand" to="/">
                  <img src="/assets/frontend/images/logo.png" alt="TSHOP">
                </router-link>

                <!-- this part for mobile -->
                <div class="search-box pull-right hidden-lg hidden-md hidden-sm">
                    <div class="input-group">
                        <button class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
                    </div>
                    <!-- /input-group -->

                </div>
            </div>

            <!-- this part is duplicate from cartMenu  keep it for mobile -->
            <div class="navbar-cart  collapse">
                <div class="cartMenu  col-lg-4 col-xs-12 col-md-4 ">
                    <div class="w100 miniCartTable scroll-pane">
                        <CartProduct/>
                        
                    </div>
                    <!--/.miniCartTable-->

                    
                    <!--/.miniCartFooter-->

                </div>
                <!--/.cartMenu-->
            </div>
            <!--/.navbar-cart-->

            <div class="navbar-collapse collapse">
                <ul v-if="posts && posts.length" class="nav navbar-nav">

                    <!-- <li class="active"><a href="/"> nAME </a></li> -->
                   
                    <li v-for="post of posts" class="dropdown megamenu-fullwidth">
                        <router-link data-toggle="dropdown" class="dropdown-toggle" to="/">
                        {{post.name}} 
                        <span><b class="caret"> </b> </span>
                        </router-link>
                        <ul  v-for="cat of post['categories']" class="dropdown-menu">
                            <li class="megamenu-content ProductDetailsList">
                                <!-- <h3 class="promo-1 no-margin hidden-xs">60 + HTML PAGES || AVAILABLE ONLY AT WRAP
                                    BOOTSTRAP </h3>

                                <h3 class="promo-1sub hidden-xs"> Complete Parallax E-Commerce Boostrap Template, Responsive
                                    on any Device, 10+ color Theme + Parallax Effect </h3> -->
                                <ul class="col-lg-2  col-sm-2 col-md-2 unstyled">
                                    <li class="no-border">
                                        <p><strong> {{cat.name}} </strong></p>
                                    </li>
                                    <li v-for="child of cat['children']">
                                        <a href="index.html"> {{child.name}}</a>
                                    </li>
                                </ul>

                            </li>
                        </ul>

                    </li>

                </ul>


                <!--- this part will be hidden for mobile version -->
                <div class="nav navbar-nav navbar-right hidden-xs">
                    <div class="dropdown  cartMenu "><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                            class="fa fa-shopping-cart"> </i> <span class="cartRespons"> Cart ($ {{TotalPrices.products.TotalPrices}}) </span> <b
                            class="caret"> </b> </a>

                        <div class="dropdown-menu col-lg-4 col-xs-12 col-md-4 ">
                            <div class="w100 miniCartTable scroll-pane">
                                <CartProduct/>
                            
                            </div>
                            <!--/.miniCartTable-->

                            <!--/.miniCartFooter-->

                        </div>
                        <!--/.dropdown-menu-->
                    </div>
                    <!--/.cartMenu-->

                    <div class="search-box">
                        <div class="input-group">
                            <button class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
                        </div>
                        <!-- /input-group -->

                    </div>
                    <!--/.search-box -->
                </div>
                <!--/.navbar-nav hidden-xs-->
            </div>
            <!--/.nav-collapse -->

        </div>
        <!--/.container -->

        <div class="search-full text-right"><a class="pull-right search-close"> <i class=" fa fa-times-circle"> </i> </a>

            <div class="searchInputBox pull-right">
                <input type="search" data-searchurl="search?=" name="q" placeholder="start typing and hit enter to search"
                       class="search-input">
                <button class="btn-nobg search-btn" type="submit"><i class="fa fa-search"> </i></button>
            </div>
        </div>
        <!--/.search-full-->
    </div>
    <!-- /.Fixed navbar  -->

    <router-view></router-view>

    <!-- Footer -->
     <!-- ***** template component Footer ***** -->
    <template>
      <FooterComponet/>
    </template>
    <!-- Footer -->
     <!-- ***** template component End Footer ***** -->
  </div>
</template>

<!-- frontEnd App -->
<script type="text/javascript">

  import axios from 'axios'
  import Flash from './helper/flash'
  import CartProduct from './views/Components/frontend/include/cart.vue'
  import CartAction from './helper/cart'
  import FooterComponet from './views/Components/frontend/common/_footer.vue'
  import VueTranslate from 'vue-translate-plugin'
  import Vue from 'vue';
  Vue.use(VueTranslate);
  import TopHeader from './views/Components/frontend/common/_top_language'
  
  export default{
    data(){
      return{
        posts: [],
        TotalPrices : CartAction.data,
        data_list:[],
        account_data: [
            {
              name: 'My Account',
              link: '/account/dashboard'
            },
            {
              name: 'Order',
              link: '/account/login'
            },
            {
              name: 'Transaction',
              link: '/account/login'
            },
            {
              name: 'Logout',
              action:'logout',
              link: '/account/login'
            }
        ],
        account_auth: [
            {
              name: 'Login',
              link: '/account/login'
            },
            {
              name: 'Register',
              link: '/account/login'
            }
        ],
      }
    },
    created() {
        axios.get(`/api/header`)
        .then(response => {
          this.posts = response.data['data']
          this.$translate.setLang(response.data['lang'])
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
    components:{
        CartProduct,
        FooterComponet,
        TopHeader,
    },
    getLang(){

    },
    methods: {
        logout () {
            axios.get(`/api/account/logout`)
            .then(response => {
              var checkAuthenticationAccount = response.data['success']
              if(checkAuthenticationAccount==true){
                // this.$router.push('/account/login')
                window.location = '/account/login'
              }
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
    },
    mounted: function(){
        console.log("====================================")
        axios.get(`/api/account/check_authorize`)
        .then(response => {
          var checkAuthenticationAccount = response.data['success']
          if(checkAuthenticationAccount==false){
            this.data_list = this.account_auth
          }else{
            this.data_list = this.account_data
          }
        })
        .catch(e => {
          this.errors.push(e)
        })
    },
  }
</script>
