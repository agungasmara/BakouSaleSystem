<template>
  <div>    

    <!-- Fixed navbar start -->
    <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
       
        <!--/.navbar-top-->
        <!-- Footer -->
        <!-- ***** template component Footer ***** -->
        <template>
          <TopHeaderComponet/>
        </template>
        <!-- Footer -->
         <!-- ***** template component End Footer ***** -->

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
  import FooterComponet from './views/Components/frontend/common/_footer.vue'
  import TopHeaderComponet from './views/Components/frontend/common/_top_header.vue'

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

        let recaptchaScript = document.createElement('script')
        recaptchaScript.setAttribute('src', 'https://www.google.com/recaptcha/api.js')
        document.head.appendChild(recaptchaScript)
    },

    components:{
        CartProduct,
        FooterComponet,
        TopHeaderComponet,
    },
    methods: function() {
        
        // window.location = "#/login";
    },
    mounted: function(){
        // window.location = "#/home";
    },
  }
</script>
