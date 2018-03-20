<template>
    <div v-bind:class="{ active: isActive }" class="loading">
        <!-- /.Fixed navbar  -->
        <div class="container main-container headerOffset">
            <div class="row">
                <div class="breadcrumbDiv col-lg-12">
                    <ul class="breadcrumb">
                        <li><router-link to="/">Home</router-link></li>
                        <template v-if="category_info==''">
                            <li><router-link :to="'/product/category_product/'+category_info.category_id">{{category_info.name}}</router-link></li>
                        </template>
                        <li><router-link to="">{{productInfo.name}}</router-link></li>
                        <!--<li class="active">Lorem ipsum dolor sit amet</li>-->
                    </ul>
                </div>
            </div>
            <div class="row transitionfx">
                <!-- left column -->
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <!-- product Image and Zoom -->
                    <div class="_main-image _sp-wrap col-lg-12 no-padding">
                        <center>
                            <a v-bind:href="productInfo.image">
                                <img v-bind:src="productInfo.image" alt="img" class="_img-responsive">
                            </a>
                            <div class="clearfix"></div>
                            <div class="sp-tb-active" style="margin-top:20px;">
                                <template v-for="thumb in gallary">
                                    <div class="col-sm-2" style="border:1px solid #f4f4f4;border-radius:4px;">
                                        <a :href="thumb.image">
                                            <img class="img-responsive" alt="img" :src="thumb.image"/>
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </center>

                        <!--<template v-for="thumb in gallary">
                            <a href="/images/catalog/demo/htc_touch_hd_2.jpg"><img
                                src="/images/catalog/demo/htc_touch_hd_2.jpg" class="img-responsive" alt="img"></a>
                        </template>-->
                        <!--<a href="/images/catalog/demo/htc_touch_hd_2.jpg"><img
                                src="/images/catalog/demo/htc_touch_hd_2.jpg" class="img-responsive" alt="img"></a>
                        <a href="/images/catalog/demo/htc_touch_hd_2.jpg"><img
                                src="/images/catalog/demo/htc_touch_hd_2.jpg" class="img-responsive" alt="img"></a>-->
                        
                        <!--<a :href="productInfo.image">
                            <img v-bind:src="productInfo.image" class="img-responsive" alt="img"/>
                        </a>-->
                        <!--<template v-for="thumb in gallary">-->
                        <!--<a v-for="thumb in gallary" v-bind:href="thumb.image">
                            <img :src="thumb.image"/>
                        </a>-->
                        <!--</template>-->
                    </div>
                </div>
                <!--/ left column end -->
                
                <!-- right column -->
                <div class="col-lg-6 col-md-6 col-sm-5">
                    <!--<pre>{{gallary|json}}</pre>-->
                    <h1 class="product-title">{{productInfo.name}}</h1>
                    
                    <div class="form-group">
                        <template>
                            <div v-if="flash.success" class="alert alert-success"><i class="fa fa-wa fa-check"></i> {{ flash.success }}</div>
                        </template>
                    </div>

                    <h3 class="product-code">Product Code : {{productInfo.sku}}</h3>
                    <div class="rating" v-if="reviewStatus">
                        <p>
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
                    <template v-if="productInfo.special==null">
                        <div class="product-price">
                            <span class="price-sales">
                                ${{productInfo.price}}
                            </span> 
                        </div>
                    </template>
                    <template v-else>
                        <div class="product-price">
                            <span class="price-sales">
                                ${{productInfo.special}}
                            </span> 
                            <span class="price-standard">
                                ${{productInfo.price}}
                            </span>
                        </div>
                    </template>
                    <span class="details-description" v-html="productInfo.description">
                    </span>
                    
                    <!--/.color-details-->

                    <div class="productFilter productFilterLook2">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="filterBox">
                                    <!-- <input type="text" class="form-control" v-model="qty"> -->
                                    <select class="form-control">
                                        <option value="strawberries" selected>Quantity</option>
                                        <option value="mango">1</option>
                                        <option value="bananas">2</option>
                                        <option value="watermelon">3</option>
                                        <option value="grapes">4</option>
                                        <option value="oranges">5</option>
                                        <option value="pineapple">6</option>
                                        <option value="peaches">7</option>
                                        <option value="cherries">8</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <!--<div class="col-lg-6 col-sm-6 col-xs-6">
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
                            </div>-->
                        </div>
                    </div>
                    <!-- productFilter -->
                    <!--Discount Order-->
                    <template v-if="productDiscount.length>0">
                        <div v-for="discount in productDiscount">Order : {{discount.quantity}}, price : {{discount.price}}</div>
                    </template>
                    <!--<pre>{{productOptions['options'] | json}}</pre>-->
                    <template v-if="productOptions['options'].length>0">
                        <template v-for="options in productOptions['options']">
                            <template v-if="options.type=='color'">
                                <div class="color-details"><span class="selected-color"><strong>{{options.name}}</strong></span>
                                    <ul class="swatches Color">
                                        <li class="selected" v-for="option_val in options['product_option_value']"><a :style="BackgroundColor(option_val.value)"> </a></li>
                                    </ul>
                                </div>
                            </template>
                            
                            <template v-else-if="options.type=='select'">
                                <div class="color-details"><span class="selected-color"><strong>{{options.name}}</strong></span>
                                    <select class="form-control">
                                        <option value="strawberries" selected>Choose Size</option>
                                        <option v-for="option_val in options['product_option_value']" :value="option_val.option_value_id">{{option_val.name}}</option>
                                    </select>
                                </div>
                            </template>
                                
                            <template v-else>
                                Here is radio form
                            </template>
                        </template>
                    </template>
                    <br/>

                    <div class="cart-actions">
                        <div class="addto row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <button @click="AddToCart(productInfo.product_id)"
                                        class="button btn-block btn-cart cart first" title="Add to Cart" type="button">
                                        Add to Cart
                                </button>
                            </div>
                            <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <a class="link-wishlist wishlist btn-block ">
                                    Add to Wishlist
                                </a>
                            </div>-->
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
                            <li v-if="attributeGroups.length>0"><a href="#size" data-toggle="tab">Specification</a></li>
                            <!--<li><a href="#shipping" data-toggle="tab">Shipping</a></li>-->
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="details" v-html="productInfo.description"></div>
                            <div class="tab-pane" id="size"> 
                               <!--  16" waist<br>
                                34" inseam<br>
                                10.5" front rise<br>
                                8.5" knee<br>
                                7.5" leg opening<br>
                                <br>
                                Measurements taken from size 30<br>
                                Model wears size 31. Model is 6'2 <br>
                                <br> -->
                                <!--  -->
                                <!-- <div v-for="attg of attributeGroups">
                                    <span>{{attg.name}}</span>
                                    <div v-for="att of attg['attribute']">
                                        ==<span>{{att.name}}</span>
                                    </div>
                                </div> -->

                                <table class="table table-bordered">
                                    <template v-for="attg of attributeGroups">
                                        <thead>
                                            <tr>
                                                <td colspan="2"><strong>{{attg.name}}</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="att of attg['attribute']">
                                                <td>{{ att.name }}</td>
                                                <td>{{ att.text }}</td>
                                            </tr>
                                        </tbody>
                                    </template>
                                    <!-- <thead v-for="attg of attributeGroups">
                                        <tr>
                                            <td colspan="2">{{attg.name}}</td>
                                        </tr>

                                        <tbody>  
                                            <tr v-for="att of attg['attribute']">
                                               
                                              <td>{{ att.name }}</td> 
                                              <td>{{ att.text }}</td>           
                                            
                                            </tr>
                                        </tbody>
                                    </thead> -->
                                    
                                    <!-- </thead> -->
                                    <!-- <tbody v-for="attgs of attributeGroups"> -->
                                        <!-- <template v-for="attgs of attributeGroups">   
                                        <tr v-for="att of attgs['attribute']">
                                           
                                          <td>{{ att.name }}</td> 
                                          <td>{{ att.text }}</td>           
                                        
                                        </tr>
                                        </template> -->
                                    <!-- </tbody> -->
                                </table>

                                
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
                <h1 v-if="productRelates.length>0"> YOU MAY ALSO LIKE </h1>

                <div id="_SimilarProductSlider" style="padding-top:20px;">
                    <template>
                        <div v-for="productRelate of productRelates" class="item col-sm-3">
                            <div class="product">
                                <router-link v-bind:to="'/product/product_detail/'+ productRelate.product_id+'/0'">
                                  <img v-bind:src="productRelate.thumb" alt="img" class="img-responsive ">
                                </router-link>

                                <div class="description">
                                    <h4>
                                        <a href="san-remo-spaghetti" v-html="productRelate.name">
                                            
                                        </a>
                                    </h4>

                                    <div class="price">
                                        <template v-if="productRelate.special == null">
                                            <span class="price-sales">
                                                ${{productRelate.price}}
                                            </span>
                                        </template>
                                        <template v-else>
                                            <span class="price-sales">
                                                ${{productRelate.special}}
                                            </span> 
                                            <span class="price-standard">
                                                ${{productRelate.price}}
                                            </span>
                                        </template>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- <div class="item" v-for="productRelate of productRelates">
                        <div class="product">
                            <a class="product-image"> 
                                <img src="/assets/frontend/images/product/a1.jpg" alt="img"> 
                            </a>

                            <div class="description">
                                <h4><a href="san-remo-spaghetti">{{productRelate.minimum}}</a></h4>

                                <div class="price"><span>$57</span></div>
                            </div>
                        </div>
                    </div> -->
                    
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

                       <!--  <h3 class="reviewtitle uppercase">You're reviewing: Lorem ipsum dolor sit amet</h3>
         -->
                        <form>
                            <div class="form-group">
                                <label>
                                    How do you rate this product? </label> <br>

                                <!--<label>
                                    <input type="radio" v-model="formData.rating_count" name="agree" value="1"/>
                                    1</label>
                                
                                <label>
                                    <input type="radio" v-model="formData.rating_count" name="agree" value="2"/>
                                    2</label>
                                
                                <label>
                                    <input type="radio" v-model="formData.rating_count" name="agree" value="3"/>
                                    3</label>
                                
                                <label>
                                    <input type="radio" v-model="formData.rating_count" name="agree" value="4"/>
                                    4</label>
                                
                                <label>
                                    <input type="radio" v-model="formData.rating_count" name="agree" value="5"/>
                                    5</label>-->
                                

                                <div class="rating-here">
                                    <star-rating v-model="rating"></star-rating>
                                    <!--<input name="rating_count" v-model="formData.rating_count" type="hidden" class="rating-tooltip-manual" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" data-fractions="3"/>-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rtext">Name *</label>
                                <input value="Visitor" v-model="formData.rating_name" type="text" class="form-control" id="rtext" placeholder="Your name" required>
                            </div>

                            <div class="form-group ">
                                <label>Review *</label>
                                <textarea v-model="formData.rating_text" class="form-control" rows="3" placeholder="Your Review" required></textarea>

                            </div>


                            <button type="button" @click="submitReview(productInfo.product_id)" class="btn btn-success">Submit Review</button>
                        </form>


                    </div>

                </div>
                <!-- /.modal-content -->

            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Modal review -->
        </div>

    </div>  
<!-- <div class="gap"></div> -->
</template>
<style type="text/css">
    .table{
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
    table.table tbody tr{width:100%;}
    table.table tbody tr td{width:50%;}
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{padding: 8px !important;}
</style>

<script>
    paceOptions = {
        elements: true
    };
</script>

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
<!--<script src="/assets/frontend/js/pace.min.js"></script>-->
<script type="text/javascript">
    /* wait for images to load */
    // $(window).load(function () {
    //     $('.sp-wrap').smoothproducts();
    // });
</script>

<script>
    import Flash from '../../../../helper/flash'
    import axios from 'axios'
    import CartAction from '../../../../helper/cart'
    import StarRating from 'vue-star-rating'
    import Vue from 'vue';
    var VueCookie = require('vue-cookie')
    Vue.use(VueCookie)

    export default{
        props:['id','cat_id'],
        data(){
            return{
                rating: 1,
                formData: {
                    rating_count: '',
                    rating_name: '',
                    rating_text: ''
                },
                category_info:'',
                isActive: true,
                gallary:[],
                productOptions:[],
                productInfo:[],
                productDiscount:[],
                reviews:[],
                reviewStatus:[],
                attributeGroups:[],
                productRelates:[],
                flash: Flash.state,
                qty:'',
                session_id : this.$cookie.get('session_id')
            }
        },
        ready() {
            // if ( ! window.jQuery ) {
            // }
        },
        beforeUpdate(){
            var pid = this.$route.params.id
            $('#search-list').slideUp(100)
            $('.search-full').hide(100)
        },
        mounted(){
            // prdouct detail
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
            
            $('.sp-wrap').smoothproducts();
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
        components: {
            StarRating
        },
        watch:{
            '$route.params.id': function (id) {
                //$('.sp-wrap').smoothproducts()
                this.productDetails(id,this.cat_id)
                this.isActive = !this.isActive
                // $(window).load(function () {
                //     $('.sp-wrap').smoothproducts();
                // });
            }
        },
        created(){
            this.productDetails(this.id,this.cat_id)
        },
        methods:{
            BackgroundColor (color) {
                var value = ['background-color:'+color]
                // if (this.orderKey === id) {
                //   value.push('active')
                // }
                return value.join(' ')
            },
            submitReview(product_id) {
                // alert(this.formData.rating_count)
                // formData.rating_count = '1'
                // formData.rating_name = '2'
                // formData.rating_text = '3'
                this.formData.product_id = product_id
                this.formData.author = this.formData.rating_name
                this.formData.text = this.formData.rating_text
                this.formData.rating = this.rating;//$("input[name='rating_count']").val()
                //console.log(this.formData)
		      	// if (this.$refs.form.validate()) {
			        // Native form submission is not yet supporte
                if(this.formData.rating_name==''){
                    alert("Name author is null")
                    return false
                }else if(this.formData.rating_text==''){
                    alert("Description is null")
                    return false
                }else{
                    axios.post("/api/product_review",
                        this.formData
                    ).then((res)=>{
                        console.log(res.data)
                        if(res.data.success==true){
                            Flash.setSuccess(res.data.message)
                            this.productDetails(product_id,this.cat_id)
                            this.isActive = !this.isActive
                            // $('#modal-review').modal().close();
                            $('#modal-review').modal('hide')
                            // $('#modal-review').modal('toggle')
                            // this.$refs.form.reset()
                            // alert("review success")
                            // this.$router.push(this.backUrl)
                        }else{
                            Flash.setError(res.data.message)
                        }
                    })
                    .catch((err) => {
                        this.error = err.response.message
                        Flash.setError('Error while saving data')
                    })   
		      	}
		    },
            productDetails(id,cat_id){
                axios.get('/api/product_detail/'+id+'/'+cat_id).then(res=>{
                    this.productInfo=res.data['data']
                    this.category_info=res.data['category_info']
                    this.reviewStatus =res.data['review_status']
                    this.reviews =res.data['reviews']
                    this.productRelates =res.data['product_relate']
                    this.attributeGroups =res.data['attribute_groups']
                    this.productDiscount = res.data['discount']
                    this.gallary = res.data['images']
                    this.productOptions = res.data['option_value']
                    this.isActive = !this.isActive
                });
            },
            AddToCart(product_id,qty=1){
                CartAction.AddToCart(product_id,qty,this.session_id)
                window.scrollTo(100,0)
              }
        }
    }
</script>