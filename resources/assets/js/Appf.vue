<template>
  <div style="-display:none;">
    <!-- Fixed navbar start -->
    <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
        <!-- <div style="height:500px">
            <button @click="initInsertElastic">Click me to insert elastic search</button>
        </div> -->

        <div class="navbar-top">
            <!--container-->
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
                                        <span class="hidden-xs" style="margin-left:5px"> (+855)87 575 787, (+855)92 755 767 </span> </a></li>
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
                                    <span class="hidden-xs hidden-sm hidden-md">My Account<!--{{ t('entry_account') }}--></span> 
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
                                <li><router-link to="/account/login" data-toggle="modal" data-target="#ModalLogin"> <span class="hidden-xs">SignIn</span>
                                    <i class="glyphicon glyphicon-log-in hide visible-xs "></i> </router-link></li>
                                <li class="hidden-xs">
                                    <router-link to="/customer/register" data-toggle="modal" data-target="#ModalSignup">Create Account</router-link>
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
                        <button @click="getFullSearch" class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
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
                <template v-if="posts && posts.length">
                    <ul class="nav navbar-nav">

                        <!-- <li class="active"><a href="/"> nAME </a></li> -->
                       
                        <li v-for="post of posts" class="dropdown megamenu-fullwidth" v-if="post['categories']">
                            <router-link data-toggle="dropdown" class="dropdown-toggle" to="/">
                            {{post.name}} 
                            <span><b class="caret"> </b> </span>
                            </router-link>
                            
                            <ul class="dropdown-menu">
                                <li class="megamenu-content ProductDetailsList">
                                    <template v-for="cat of post['categories']">
                                    <!-- <h3 class="promo-1 no-margin hidden-xs">60 + HTML PAGES || AVAILABLE ONLY AT WRAP
                                        BOOTSTRAP </h3>

                                    <h3 class="promo-1sub hidden-xs"> Complete Parallax E-Commerce Boostrap Template, Responsive
                                        on any Device, 10+ color Theme + Parallax Effect </h3> -->
                                        <ul class="col-lg-2  col-sm-2 col-md-2 unstyled">
                                            <li class="no-border">
                                                <p><strong> {{cat.name}} </strong></p>
                                            </li>
                                            <li v-for="child of cat['children']">
                                                <router-link v-bind:to="child.href">
                                                  {{child.name}}
                                                </router-link>
                                            </li>

                                        </ul>
                                    </template>
                                </li>
                            </ul>
                        </li>
                        <li v-else>
                            <a href="">{{post.name}}</a>
                        </li>
                    </ul>
                </template>


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
                            <button @click="getFullSearch" class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
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

        <div class="search-full text-right"><a @click="initCloseSearch" class="pull-right search-close"> <i class=" fa fa-times-circle"> </i> </a>

            <div class="searchInputBox pull-right">
                <input type="search" v-model="q" @click="initClickSearch" @keyup="search" autocomplete="off" data-searchurl="search?=" name="q" placeholder="Search Product, Brand, Category,..." class="search-input">
                <button class="btn-nobg search-btn" type="submit"><i class="fa fa-search"> </i></button>
            </div>

            <template v-if="searchResults">
                <div id="search-list" class="container-fluid" style="display:none;">
                    <div style="position: absolute;width: 100%;background-color: rgb(255, 255, 255);top: 52px;padding: 15px 60px 15px;left: 0;text-align:left;box-shadow: 1px 1px #e3e3e3;">
                        <!-- <div>Popular Search</div>
                        <hr/>
                        <ul class="popular-product">
                            <li v-for="item of searchResults['elasticdata']"><img v-bind:src="item._source.imageUrl"/> {{item._source.name}}</li>
                        </ul>
                        <br/> -->
                        <div>Best Seller Store</div>
                        <hr/>
                        <ul class="popular-product">
                            <li v-for="item of fetchStore['fetchStore']">
                                <router-link v-bind:to="'/store/'+item._source.store.storename+'/'+ item._source.store.store_id">
                                    <div class="pull-left product-img"><img width="120px" v-bind:src="item._source.store.image"/> </div>
                                    <!-- <div class="pull-left">{{item._source.store.storename}}</div> -->
                                    <div class="clearfix"></div>
                                </router-link>
                            </li>
                        </ul>
                        <br/>
                        <div>Popular Products</div>
                        <hr/>
                        <ul class="popular-product">
                            <template v-if="searchResults['elasticdata'].length>0">
                                <li v-for="item of searchResults['elasticdata']">
                                    <router-link v-bind:to="'/product/product_detail/'+ item._source.id+'/0'">
                                        <div class="pull-left product-img"><img width="30px" v-bind:src="item._source.imageUrl"/> </div>
                                        <div class="pull-left">{{item._source.name}}
                                            <div>
                                                <span class="original-price">{{item._source.crawlPrice}}</span>
                                                <span class="special-price">{{item._source.crawlPrice}}</span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </router-link>
                                </li>
                            </template>
                            <template v-else>
                                <li>There is no product found!</li>
                            </template>
                        </ul>
                    </div>
                </div>
            </template>
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

<style type="text/css">
    .alert-success {
    background-color: #4caf50;
}

.alert-success i {
    background: #388e3c;
}

.alert i {
    padding-top: 10px;
    color: #fff;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    text-align: center;
    width: 60px;
    font-size: 40px;
    -webkit-animation: alert-icon-anim 1s;
    -moz-animation: alert-icon-anim 1s;
    -ms-animation: alert-icon-anim 1s;
    -o-animation: alert-icon-anim 1s;
    animation: alert-icon-anim 1s;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.15);
}

.alert.fadeOut {
    -moz-transform: translate(0, -100%);
    -ms-transform: translate(0, -100%);
    -o-transform: translate(0, -100%);
    -webkit-transform: translate(0, -100%);
    transform: translate(0, -100%);
}

.alert {
    font-size: 14px;
    position: absolute;
    width:100%;
    padding: 18px 40px 18px 75px;
    z-index: 30;
    color: #fff;
    border-radius: 0;
    min-height: 60px;
    box-sizing: border-box;
    border: none;
    font-weight: 600;
    box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
    transition: 1s all cubic-bezier(1, -0.01, 0, 0.99);
}
.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}

    span.special-price{/*color:#4ec67f;*/color:#000;padding-left: 10px;}
    span.original-price{color:#f00;text-decoration: line-through;}
    .product-img{padding-right: 10px;}
    ul.popular-product li{
        font-size:14px;
        padding-bottom: 10px;
        /*line-height: 40px;*/
    }
</style>

<!-- frontEnd App -->
<script type="text/javascript">

    import axios from 'axios'
    import {post} from './helper/api'
    import Flash from './helper/flash'
    import CartProduct from './views/Components/frontend/include/cart.vue'
    import CartAction from './helper/cart'
    import FooterComponet from './views/Components/frontend/common/_footer.vue'
    import VueTranslate from 'vue-translate-plugin'
    import TopHeader from './views/Components/frontend/common/_top_language'
    import Vue from 'vue'
    import VueRouter from 'vue-router'
    import VueResource from 'vue-resource'
    import Vuetify from 'vuetify'

    Vue.use(VueTranslate)
    var VueCookie = require('vue-cookie')
    Vue.use(VueCookie)

    var randomstring = require("randomstring")

    const es_host = 'http://localhost';
    const es_port = 9200;
    var es = require('elasticsearch');
    var client = new es.Client({
        host: 'localhost:9200',
        log: 'trace',
    });

    export default{
        data(){
          return{
            q:'',
            searchResults:Flash.state,
            fetchStore:Flash.state,
            posts: [],
            loading:true,
            session_id : this.$cookie.get('session_id'),
            TotalPrices : CartAction.data,
            random: Math.floor(Math.random()),
            data_list:[],
            account_data: [
                {
                  name: 'My Account',
                  link: '/account/dashboard'
                },
                {
                  name: 'Order',
                  link: '/account/orderlist'
                },
                {
                  name: 'My Wishlists',
                  link: '/account/wishlist'
                },
                {
                  name: 'Logout',
                  action:'logout',
                  link: '/logout'
                }
            ],
            account_auth: [
                {
                  name: 'My Account',
                  link: '/account/login'
                },
                {
                  name: 'Order',
                  link: '/account/login'
                },
                {
                  name: 'My Wishlists',
                  link: '/logout'
                }
            ],
          }
        },
        ready() {
          this.q = q;
        },
        created() {
            // To delete a cookie use
            // this.$cookie.delete('cookie');
            // alert(randomstring.generate())
            var session_id = this.session_id
            if(session_id==null){
                this.$cookie.set('session_id', randomstring.generate(), 168)
            }
            axios.get('/api/header?session_id='+session_id)
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
        beforeUpdate(){
            
        },
        methods: {
            initInsertElastic(){
                post(''+es_host+':'+es_port+'/store/product/3333', {id: '3333',name: 'myiphone12'}).then(response => {
                    alert("success")
                },{headers: {'Content-Type': 'application/json','Accept': 'application/json','Access-Control-Allow-Origin': '*','Access-Control-Allow-Headers': 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin'}}, response => {
                })
            },
            // onLostFocus:function(){
            //     $('#search-list').slideUp(100)
            //     $('.search-full').hide(100)
            // },
            initCloseSearch:function(){
                $('.search-full').hide(100)
            },
            getFullSearch:function(){
                $('.search-full').show(100)
            },
            _onLostFocus: function(){
                $('#search-list').slideUp(1000)
                $('.search-full').hide(100)
            },
            initClickSearch: function(){
                $("#search-list").show(10)
            },
            search: function() {    
                var searchText = this.q
                // fetchProduct
                client.search({
                  index: "store",
                  type: "product",
                  body: {
                            "size": 5,
                              "sort": [
                            {"popular": {"order": "desc"}}
                        ],
                        "query": {
                              "query_string": {
                              "query": (searchText == '' || searchText == ' ')? '*' : searchText+"*",
                              "fields": ["name"]
                          }
                        }
                        ,
                        "aggs": {
                            "categories": {
                                "terms": {
                                    "field": "categories.cat_id",
                                    "size": 5 // limit number result distinct
                                },
                                "aggs": {
                                    "tops": {
                                        "top_hits": {
                                            "size": 1
                                        }
                                    }
                                }
                            }
                        }// end aggs
                  }// end body
                }).then(function (resp) {
                    // return hits = resp.hits.hits;
                    Flash.setState(resp['hits']['hits'])
                }, function (err) {
                  console.trace(err.message)
                })
                // fetchStore
                client.search({
                  index: "store",
                  type: "product",
                  body: {
                            "size": 1,
                              "sort": [
                            {"popular": {"order": "desc"}}
                        ],
                        "query": {
                              "query_string": {
                              "query": (searchText == '' || searchText == ' ')? '*' : searchText+"*",
                              "fields": ["store.storename"]
                          }
                        }
                        ,
                        "aggs": {
                            "store": {
                                "terms": {
                                    "field": "store.storename",
                                    "size": 1 // limit number result distinct
                                },
                                "aggs": {
                                    "tops": {
                                        "top_hits": {
                                            "size": 1
                                        }
                                    }
                                }
                            }
                        }// end aggs
                  }// end body
                }).then(function (resp) {
                    // return hits = resp.hits.hits;
                    this.fetchStore = Flash.fetchStore(resp['hits']['hits'])
                }, function (err) {
                  console.trace(err.message)
                })
            },
            logout () {
                window.location = '/logout'
                // axios.get(`/api/account/logout`)
                // .then(response => {
                //   var checkAuthenticationAccount = response.data['success']
                //   // if(checkAuthenticationAccount==true){
                //   this.$router.push('/account/login')
                //   //   window.location = '/account/login'
                //   // }
                // })
                // .catch(e => {
                //   this.errors.push(e)
                // })
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
