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
                                        class="glyphicon glyphicon-info-sign hide visible-xs "></i> </a></li>
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
                                <li><router-link to="/account/signin"><span class="hidden-xs">My Account</span> <i
                                        class="glyphicon glyphicon-user hide visible-xs "></i></router-link></li>
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
                            class="fa fa-shopping-cart"> </i> <span class="cartRespons"> Cart ($210.00) </span> <b
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

    <!-- footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                        <h3> Support </h3>
                        <ul>
                            <li class="supportLi">
                                <p> Lorem ipsum dolor sit amet, consectetur </p>
                                <h4><a class="inline" href="callto:+12025550151"> <strong> <i class="fa fa-phone"> </i>
                                    +1-202-555-0151 </strong> </a></h4>
                                <h4><a class="inline" href="mailto:help@yourweb.com"> <i class="fa fa-envelope-o"> </i>
                                    help@yourweb.com </a></h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> Shop </h3>
                        <ul>
                            <li><a href="#">
                                Men's
                            </a></li>
                            <li><a href="#">
                                Women's</a></li>
                            <li><a href="#">
                                Kids'
                            </a></li>
                            <li><a href="#">Shoes
                            </a></li>
                            <li><a href="#">
                                Gift Cards
                            </a></li>

                        </ul>

                    </div>

                    <div style="clear:both" class="hide visible-xs"></div>

                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> Information </h3>
                        <ul class="list-unstyled footer-nav">
                            <li><a href="#">Questions?
                            </a></li>

                            <li><a href="#"> Order Status
                            </a></li>
                            <li><a href="#"> Sizing Charts
                            </a></li>
                            <li><a href="#"> Return Policy </a></li>
                            <li><a href="#">
                                Contact Us
                            </a></li>

                        </ul>
                    </div>


                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> My Account</h3>
                        <ul>
                            <li><a href="account.html"> My Account </a></li>
                            <li><a href="/customer/address"> My Address </a></li>
                            <li><a href="/whish/lists"> Wish List </a></li>
                            <li><a href="/order/lists"> Order list </a></li>
                            <li><a href="/order/status"> Order Status </a></li>
                        </ul>
                    </div>

                    <div style="clear:both" class="hide visible-xs"></div>

                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                        <h3> Stay In Touch</h3>
                        <ul>
                            <li>
                                <div class="input-append newsLatterBox text-center">
                                    <input type="text" class="full text-center" placeholder="Email">
                                    <button class="btn  bg-gray" type="button"> SubSCript <i
                                            class="fa fa-long-arrow-right"> </i></button>
                                </div>
                            </li>
                        </ul>
                        <ul class="social">
                            <li><a href="http://facebook.com"> <i class=" fa fa-facebook"> &nbsp; </i> </a></li>
                            <li><a href="http://twitter.com"> <i class="fa fa-twitter"> &nbsp; </i> </a></li>
                            <li><a href="https://plus.google.com"> <i class="fa fa-google-plus"> &nbsp; </i> </a></li>
                            <li><a href="http://youtube.com"> <i class="fa fa-pinterest"> &nbsp; </i> </a></li>
                            <li><a href="http://youtube.com"> <i class="fa fa-youtube"> &nbsp; </i> </a></li>
                        </ul>
                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </div>
        <!--/.footer-->

        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left"> &copy; TSHOP 2014. All right reserved. </p>

                <div class="pull-right paymentMethodImg">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/master_card.png" alt="img"> 
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/visa_card.png" alt="img">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/paypal.png" alt="img">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/american_express_card.png" alt="img"> 
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/discover_network_card.png" alt="img">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/google_wallet.png" alt="img">

                </div>
            </div>
        </div>
        <!--/.footer-bottom-->
    </footer>
    <!-- #### END Footer -->
  </div>
</template>

<!-- frontEnd App -->
<script type="text/javascript">

  import axios from 'axios'
  import Flash from './helper/flash'
  import CartProduct from './views/Components/frontend/include/cart.vue'

  export default{
    data(){
      return{
        posts: [],
      }
    },

    created() {
        axios.get(`/api/header`)
        .then(response => {
          this.posts = response.data['data']
        })
        .catch(e => {
          this.errors.push(e)
        })
    },

    components:{
        CartProduct
    },
    methods: function() {
        alert('sd');
        // window.location = "#/login";
    },
    mounted: function(){
        // window.location = "#/home";
    },
  }
</script>
