<template>
	
<!-- /.Fixed navbar  -->
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="category.html">MEN COLLECTION</a></li>
                <li><a href="sub-category.html">TSHIRT</a></li>
                <li class="active">Lorem ipsum dolor sit amet</li>
            </ul>
        </div>
    </div>
    <div class="row transitionfx">
        <!-- left column -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <!-- product Image and Zoom -->
            <div class="main-image sp-wrap col-lg-12 no-padding">
                <a href="/assets/frontend/images/product_details/hi-res-croped/1.jpg">
                    <img src="/assets/frontend/images/product_details/low-res-white/1.jpg" class="img-responsive" alt="img">
                </a>
                <a href="/assets/frontend/images/product_details/hi-res-croped/2.jpg">
                    <img src="/assets/frontend/images/product_details/low-res-white/2.jpg" class="img-responsive" alt="img">
                </a>
                <a href="/assets/frontend/images/product_details/hi-res-croped/3.jpg">
                    <img src="/assets/frontend/images/product_details/low-res-white/3.jpg" class="img-responsive" alt="img">
                </a>
            </div>
        </div>
        <!--/ left column end -->

        <!-- right column -->
        <div class="col-lg-6 col-md-6 col-sm-5">
            <h1 class="product-title">{{productInfo.name}}</h1>

            <h3 class="product-code">Product Code : {{productInfo.sku}}</h3>
            <div class="rating" v-if="reviewStatus">
                <p>.
                    <span v-for="n in 5">
                        <span v-if="productInfo.rating < n">
                            <i class="fa fa-star-o "></i>
                        </span>
                        <span v-else>
                            <i class="fa fa-star"></i>
                        </span> 
                    </span> 
                    <!-- <span><i class="fa fa-star"></i></span> 
                    <span><i class="fa fa-star"></i></span> 
                    <span><i class="fa fa-star-o "></i></span>  -->
                    <span class="ratingInfo">
                        <a href="" data-target="#modal-review" data-toggle="modal">{{reviews}}
                        </a>
                        <span>/</span> 
                        <a data-target="#modal-review" data-toggle="modal"> 
                            Write a review
                        </a>
                    </span>
                </p>
            </div>
            <div class="product-price" v-if="productInfo.special != ''">
                <span class="price-sales">
                    ${{productInfo.price}}
                </span> 
            </div>
            <div class="product-price" v-else>
                <span class="price-sales">
                    ${{productInfo.price}}
                </span> 
                <span class="price-standard">
                    ${{productInfo.special}}
                </span>
            </div>
            <span class="details-description" v-html="productInfo.description">
            </span>
            <div class="color-details"><span class="selected-color"><strong>COLOR</strong></span>
                <ul class="swatches Color">
                    <li class="selected"><a style="background-color:#f1f40e"> </a></li>
                    <li><a style="background-color:#adadad"> </a></li>
                    <li><a style="background-color:#4EC67F"> </a></li>
                </ul>
            </div>
            <!--/.color-details-->

            <div class="productFilter productFilterLook2">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <div class="filterBox">
                            <input type="text" class="form-control" v-model="qty">
                            <!-- <select class="form-control">
                                <option value="strawberries" selected>Quantity</option>
                                <option value="mango">1</option>
                                <option value="bananas">2</option>
                                <option value="watermelon">3</option>
                                <option value="grapes">4</option>
                                <option value="oranges">5</option>
                                <option value="pineapple">6</option>
                                <option value="peaches">7</option>
                                <option value="cherries">8</option>
                            </select> -->
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6">
                        <div class="filterBox">
                            <select class="form-control">
                                <option value="strawberries" selected>Size</option>
                                <option value="mango">XL</option>
                                <option value="bananas">XXL</option>
                                <option value="watermelon">M</option>
                                <option value="apples">L</option>
                                <option value="apples">S</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- productFilter -->

            <div class="cart-actions">
                <div class="addto row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button @click="AddToCart(id,qty);"
                                class="button btn-block btn-cart cart first" title="Add to Cart" type="button">
                                Add to Cart
                        </button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="link-wishlist wishlist btn-block ">
                            Add to Wishlist
                        </a>
                    </div>
                </div>
                <div style="clear:both"></div>
                <h3 class="incaps">
                    <i class="fa fa fa-check-circle-o color-in"></i> In stock
                </h3>

                <h3 style="display:none" class="incaps">
                    <i class="fa fa-minus-circle color-out"></i> Out of stock
                </h3>

                <h3 class="incaps">
                    <i class="glyphicon glyphicon-lock"></i> Secure online ordering
                </h3>
            </div>
            <!--/.cart-actions-->

            <div class="clear"></div>
            <div class="product-tab w100 clearfix">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#size" data-toggle="tab">Specification</a></li>
                    <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="details">Sed ut eros felis. Vestibulum rutrum imperdiet nunc a
                        interdum. In scelerisque libero ut elit porttitor commodo. Suspendisse laoreet magna nec
                        urna
                        fringilla viverra.<br>
                        100% Cotton<br>
                    </div>
                    <div class="tab-pane" id="size"> 16" waist<br>
                        34" inseam<br>
                        10.5" front rise<br>
                        8.5" knee<br>
                        7.5" leg opening<br>
                        <br>
                        Measurements taken from size 30<br>
                        Model wears size 31. Model is 6'2 <br>
                        <br>
                    </div>
                    <div class="tab-pane" id="shipping">
                        <table>
                            <colgroup>
                                <col style="width:33%">
                                <col style="width:33%">
                                <col style="width:33%">
                            </colgroup>
                            <tbody>
                            <tr>
                                <td>Standard</td>
                                <td>1-5 business days</td>
                                <td>$7.95</td>
                            </tr>
                            <tr>
                                <td>Two Day</td>
                                <td>2 business days</td>
                                <td>$15</td>
                            </tr>
                            <tr>
                                <td>Next Day</td>
                                <td>1 business day</td>
                                <td>$30</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3">* Free on orders of $50 or more</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.tab content -->

            </div>
            <!--/.product-tab-->

            <div style="clear:both"></div>
            <div class="product-share clearfix">
                <p> SHARE </p>

                <div class="socialIcon"><a href="#"> <i class="fa fa-facebook"></i></a> <a href="#"> <i
                        class="fa fa-twitter"></i></a> <a href="#"> <i class="fa fa-google-plus"></i></a> <a
                        href="#">
                    <i class="fa fa-pinterest"></i></a></div>
            </div>
            <!--/.product-share-->

        </div>
        <!--/ right column end -->

    </div>
    <!--/.row-->

    <div class="row recommended">
        <h1> YOU MAY ALSO LIKE </h1>

        <div id="SimilarProductSlider">
            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/a1.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">YOUR LIFE</a></h4>

                        <div class="price"><span>$57</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/a2.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">RED CROWN</a></h4>

                        <div class="price"><span>$44</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/a3.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">WHITE GOLD</a></h4>

                        <div class="price"><span>$35</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/a4.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">DENIM 4240</a></h4>

                        <div class="price"> $<span>55</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/30.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">CROWN ROCK</a></h4>

                        <div class="price"><span>$500</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/a5.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">SLIM ROCK</a></h4>

                        <div class="price"><span>$50 </span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product"><a class="product-image"> <img src="/assets/frontend/images/product/36.jpg" alt="img"> </a>

                    <div class="description">
                        <h4><a href="san-remo-spaghetti">ROCK T-Shirts </a></h4>

                        <div class="price"><span>$130</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->

            <div class="item">
                <div class="product">
                    <a class="product-image"> 
                        <img src="/assets/frontend/images/product/13.jpg" alt="img"> 
                    </a>
                    <div class="description">
                        <h4><a href="san-remo-spaghetti">Denim T-Shirts </a></h4>

                        <div class="price"><span>$43</span></div>
                    </div>
                </div>
            </div>
            <!--/.item-->
        </div>
        <!--/.recommended-->
    </div>
    <div style="clear:both"></div>

<!-- Modal review start -->
<div class="modal  fade" id="modal-review" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
                <h3 class="modal-title-site text-center">PRODUCT REVIEW </h3>
            </div>
            <div class="modal-body">

                <h3 class="reviewtitle uppercase">You're reviewing: Lorem ipsum dolor sit amet</h3>

                <form>
                    <div class="form-group">
                        <label>
                            How do you rate this product? </label> <br>

                        <div class="rating-here">
                            <input type="hidden" class="rating-tooltip-manual" data-filled="fa fa-star fa-2x"
                                   data-empty="fa fa-star-o fa-2x" data-fractions="3"/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rtext">Name</label>
                        <input type="text" class="form-control" id="rtext" placeholder="Your name" required>
                    </div>

                    <div class="form-group ">
                        <label>Review</label>
                        <textarea class="form-control" rows="3" placeholder="Your Review" required></textarea>

                    </div>


                    <button type="submit" class="btn btn-success">Submit Review</button>
                </form>


            </div>

        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal review -->
</div>


<!-- /main-container -->

<!-- <div class="gap"></div> -->
</template>


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{url('assets/frontend/js/jquery/jquery-2.1.3.min.js')}}"></script>
<script src="{{url('assets/frontend/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- include footable plugin -->
<script src="{{url('assets/frontend/js/footable.js')}}" type="text/javascript"></script>
<script src="{{url('assets/frontend/js/footable.sortable.js')}}" type="text/javascript"></script>

<!-- include jqueryCycle plugin -->
<script src="{{url('assets/frontend/js/jquery.cycle2.min.js')}}"></script>

<!-- include easing plugin -->
<script src="{{url('assets/frontend/js/jquery.easing.1.3.js')}}"></script>

<!-- include  parallax plugin -->
<script type="text/javascript" src="{{url('assets/frontend/js/jquery.parallax-1.1.js')}}"></script>

<!-- optionally include helper plugins -->
<script type="text/javascript" src="{{url('assets/frontend/js/helper-plugins/jquery.mousewheel.min.js')}}"></script>

<!-- include mCustomScrollbar plugin //Custom Scrollbar  -->

<script type="text/javascript" src="{{url('assets/frontend/js/jquery.mCustomScrollbar.js')}}"></script>

<!-- include icheck plugin // customized checkboxes and radio buttons   -->
<script type="text/javascript" src="{{url('assets/frontend/plugins/icheck-1.x/icheck.min.js')}}"></script>

<!-- include grid.js // for equal Div height  -->
<script src="{{url('assets/frontend/plugins/jquery-match-height-master/dist/jquery.matchHeight-min.js')}}"></script>
<script src="{{url('assets/frontend/js/grids.js')}}"></script>

<!-- include carousel slider plugin  -->
<script src="{{url('assets/frontend/js/owl.carousel.min.js')}}"></script>

<!-- include smoothproducts // product zoom plugin  -->
<script type="text/javascript" src="{{url('assets/frontend/plugins/smoothproducts-master/js/smoothproducts.min.js')}}"></script>
<!-- jQuery select2 // custom select   -->
<script src="{{url('assets/frontend/js/select2.min.js')}}"></script>

<!-- include touchspin.js // touch friendly input spinner component   -->
<script src="{{url('assets/frontend/js/bootstrap.touchspin.js')}}"></script>

<!-- include custom script for only homepage  -->
<script src="{{url('assets/frontend/js/home.js')}}"></script>

<script src="{{url('assets/frontend/js/grids.js')}}"></script>
<script src="{{url('assets/frontend/js/enquire.min.js')}}"></script>
<!-- include custom script for site  -->
<script src="{{url('assets/frontend/js/script.js')}}"></script>



<!-- include pace script for automatic web page progress bar  -->

<script>
    paceOptions = {
        elements: true
    };
</script>
<script src="{{url('assets/frontend/js/pace.min.js')}}"></script>

<script type="text/javascript">
    $(function () {
        $('.footable').footable();
    });
</script>
<script>
    // this script required for subscribe modal
    $(window).load(function () {
        // full load
        $('#modalAds').modal('show');
        $('#modalAds').removeClass('hide');
    });

</script>
<script type="text/javascript">
    /* wait for images to load */
    $(window).load(function () {
        $('.sp-wrap').smoothproducts();
    });
</script>

<script>
    import Flash from '../../../../helper/flash'
    import axios from 'axios'
    import CartAction from '../../../../helper/cart'
    export default{
        props:['id'],
        data(){
            return{
                productInfo:[],
                reviewStatus:[],
                qty:''
            }
        },
        ready() {
            // if ( ! window.jQuery ) {
            // }
        },
        mounted(){
            // switch color
            $(".swatches li").click(function () {
                $(".swatches li.selected").removeClass("selected");
                $(this).addClass('selected');
            });

            $(".product-color a").click(function () {
                $(".product-color a").removeClass("active");
                $(this).addClass('active');

            });

            // select
            $('select.form-control').select2();


            function customPager() {

                $.each(this.owl.userItems, function (i) {

                    var pagination1 = $('.owl-controls .owl-pagination > div:first-child');
                    var pagination = $('.owl-controls .owl-pagination');
                    $(pagination[i]).append("<div class=' owl-has-nav owl-next'><i class='fa fa-angle-right'></i>  </div>");
                    $(pagination1[i]).before("<div class=' owl-has-nav owl-prev'><i class='fa fa-angle-left'></i> </div>");


                });

            }

            var latestProductSlider = $("#productslider");
            latestProductSlider.owlCarousel({
                navigation: false, // Show next and prev buttons
                items: 4,
                itemsTablet: [768, 2],
                afterInit: customPager,
                afterUpdate: customPager
            });


            // Custom Navigation Events
            $(".owl-next").click(function () {
                latestProductSlider.trigger('owl.next');
            })
            $(".owl-prev").click(function () {
                latestProductSlider.trigger('owl.prev');
            })


            // BRAND  carousel
            var owl = $(".brand-carousel");

            owl.owlCarousel({
                //navigation : true, // Show next and prev buttons
                navigation: false,
                pagination: false,
                items: 8,
                itemsTablet: [768, 4],
                itemsMobile: [400, 2]


            });

            // Custom Navigation Events
            $("#nextBrand").click(function () {
                owl.trigger('owl.next');
            })
            $("#prevBrand").click(function () {
                owl.trigger('owl.prev');
            })

            // YOU MAY ALSO LIKE  carousel

            $("#SimilarProductSlider").owlCarousel({
                navigation: false, // Show next and prev buttons
                afterInit: customPager,
                afterUpdate: customPager
            });


            var SimilarProductSlider = $("#SimilarProductSlider");
            SimilarProductSlider.owlCarousel({
                navigation: false, // Show next and prev buttons
                afterInit: customPager,
                afterUpdate: customPager
            });

            // Custom Navigation Events
            $("#SimilarProductSlider .owl-next").click(function () {
                SimilarProductSlider.trigger('owl.next');
            })

            $("#SimilarProductSlider .owl-prev").click(function () {
                SimilarProductSlider.trigger('owl.prev');
            })


            // Home Look 2 || Single product showcase 

            // productShowCase  carousel
            var pshowcase = $("#productShowCase");

            pshowcase.owlCarousel({
                autoPlay: 4000,
                stopOnHover: true,
                navigation: false,
                paginationSpeed: 1000,
                goToFirstSpeed: 2000,
                singleItem: true,
                autoHeight: true


            });

            // Custom Navigation Events
            $("#ps-next").click(function () {
                pshowcase.trigger('owl.next');
            })
            $("#ps-prev").click(function () {
                pshowcase.trigger('owl.prev');
            })


            // Home Look 3 || image Slider

            // imageShowCase  carousel
            var imageShowCase = $("#imageShowCase");

            imageShowCase.owlCarousel({
                autoPlay: 4000,
                stopOnHover: true,
                navigation: false,
                pagination: false,
                paginationSpeed: 1000,
                goToFirstSpeed: 2000,
                singleItem: true,
                autoHeight: true
            });

            // Custom Navigation Events
            $("#ps-next").click(function () {
                imageShowCase.trigger('owl.next');
            })
            $("#ps-prev").click(function () {
                imageShowCase.trigger('owl.prev');
            })

            $('.sp-wrap').smoothproducts();



            // rating start
            $('.rating-tooltip-manual').rating({
                extendSymbol: function () {
                    var title;
                    $(this).tooltip({
                        container: 'body',
                        placement: 'bottom',
                        trigger: 'manual',
                        title: function () {
                            return title;
                        }
                    });
                    $(this).on('rating.rateenter', function (e, rate) {
                        title = rate;
                        $(this).tooltip('show');
                    })
                        .on('rating.rateleave', function () {
                            $(this).tooltip('hide');
                        });
                }
            });
        },
        created(){
            this.productDetails(this.id);
        },
        methods:{
            productDetails(id){
                axios.get('/api/detail/'+id).then(res=>{
                    this.productInfo=res.data['data']
                    this.reviewStatus =res.data['review_status']
                    this.reviews =res.data['reviews']
                });
            },
            AddToCart(product_id,qty=1){
                CartAction.AddToCart(product_id,qty)
                window.scrollTo(100,100)
            }
        }
    }
</script>