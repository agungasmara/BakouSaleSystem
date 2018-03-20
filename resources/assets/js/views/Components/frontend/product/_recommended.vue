<template>

	<div v-bind:class="{ active: isActive }" class="loading">
		<div class="morePost row featuredPostContainer style2 globalPaddingTop ">
		      <h3 class="section-title style2 text-center"><span>RECOMMADED PRODUCT</span></h3>

		      <div class="container">
		          <div class="row xsResponse equalHeightCategoryProduct">
		          	<!-- <pre>{{productRecommandeds|json}}</pre> -->
		          	<template v-for="productRecommanded of productRecommandeds">
			              <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
			                  <div class="product">
			                      <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
			                         data-placement="left">
			                          <i class="glyphicon glyphicon-heart"></i>
			                      </a>

			                      <div class="image">
		                          <div class="quickview">
		                            <a data-toggle="modal" class="btn btn-xs btn-quickview" :data-target="ModalQuickView(productRecommanded.product_id)">
		                            	Quick View 
		                            </a>
		                          </div>
		                          <router-link v-bind:to="'/product/product_detail/'+ productRecommanded.product_id+'/0'">
		                          	 <img v-bind:src="productRecommanded.thumb" alt="img" class="img-responsive">
								  	</router-link>
		                          <template v-if="productRecommanded.special != null">
									<div class="promotion"><span class="discount"> PROMOTION</span></div>
								  </template>
		                      </div>
		                      <div class="description">
		                          <h4>
		                          	<router-link v-bind:to="'/product/product_detail/'+ productRecommanded.product_id+'/0'">
		                          		{{productRecommanded.name}}
									</router-link>
		                          </h4>

		                          <p v-html="productRecommanded.description">.</p>
		                          <!--<span class="size">XL / XXL / S </span>-->
								  <br/>
								</div>

		                        <div class="price">
									<template v-if="productRecommanded.special == null">
										<span class="price-sales">
											${{productRecommanded.price}}
										</span>
									</template>
									<template v-else>
										<span class="price-sales">
											${{productRecommanded.special}}
										</span> 
										<span class="price-standard">
											${{productRecommanded.price}}
										</span>
									</template>
								</div>

			                      <div class="action-control">
			                      	<a class="btn btn-primary" @click="AddToCart(productRecommanded.product_id)"> 
			                          <span class="add2cart">
			                            <i class="glyphicon glyphicon-shopping-cart"> </i> 
			                            Add to cart 
			                          </span> 
			                        </a>
			                      </div>
			                  </div>
			              </div>
							</template>

								<template v-for="productRecommanded of productRecommandeds">
									<!-- Product Details Modal  -->
									<!-- Modal -->
									<div class="modal fade" :id="ShowId(productRecommanded.product_id)" tabindex="-1" role="dialog"
									 aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
										<div class="modal-dialog">
												{{productRecommanded.product_id}}
										    <div class="modal-content">
										        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> ×</button>
										        <div class="col-lg-5 col-md-5 col-sm-5  col-xs-12">
										            <!-- product Image -->
										            <div class="main-image  col-lg-12 no-padding style3">
										                <a class="product-largeimg-link" href="">
										                	<img src="images/product_details/low-res-white/1.jpg" class="img-responsive product-largeimg" alt="img">
										                </a>
										            </div>
										            <!--/.main-image-->

										            <div class="modal-product-thumb">
										                <a class="thumbLink selected">
										                	<img data-large="images/product_details/low-res-white/1.jpg" alt="img" class="img-responsive" src="images/product_details/low-res-white/1.jpg">
										                </a>
										                <a class="thumbLink">
										                	<img data-large="images/product_details/low-res-white/2.jpg" alt="img" class="img-responsive" src="images/product_details/low-res-white/2.jpg">
										                </a>
										                <a class="thumbLink">
										                	<img data-large="images/product_details/low-res-white/3.jpg" alt="img" class="img-responsive" src="images/product_details/low-res-white/3.jpg">
										                </a>
										            </div>
										            <!--/.modal-product-thumb-->
										        </div>
										        <!--/ product Image-->

										        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 modal-details no-padding">
										            <div class="modal-details-inner">
										                <h1 class="product-title">
										                	{{productRecommanded.name}}
										                </h1>

										                    <h3 class="product-code">Product Code : DEN1098</h3>

										                    <div class="product-price"><span class="price-sales"> $70</span> <span
										                            class="price-standard">$95</span></div>
										                    <div class="details-description">
										                        <p>In scelerisque libero ut elit porttitor commodo Suspendisse laoreet magna. </p>
										                    </div>
										                    <div class="color-details"><span class="selected-color"><strong>COLOR</strong></span>
										                        <ul class="swatches Color">
										                            <li class="selected">
										                                <a style="background-color:#f1f40e"> </a>
										                            </li>
										                            <li>
										                                <a style="background-color:#adadad"> </a>
										                            </li>
										                            <li>
										                                <a style="background-color:#4EC67F"> </a>
										                            </li>
										                        </ul>
										                    </div>
										                    <!--/.color-details-->

										                    <div class="productFilter productFilterLook2">
										                        <div class="row">
										                            <div class="col-lg-6 col-sm-6 col-xs-6">
										                                <div class="filterBox">
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
										                            <div class="col-lg-6">
										                                <button onclick="productAddToCartForm.submit(this);"
										                                        class="button btn-block btn-cart cart first" title="Add to Cart"
										                                        type="button">
										                                    Add to Cart
										                                </button>
										                            </div>
										                            <div class="col-lg-6"><a class="link-wishlist wishlist btn-block ">Add to Wishlist</a>
										                            </div>
										                        </div>
										                    </div>
										                    <!--/.cart-actions-->

										                    <div class="product-share clearfix">
										                        <p> SHARE </p>

										                        <div class="socialIcon">
										                            <a href="#"> <i class="fa fa-facebook"></i>
										                            </a>
										                            <a href="#"> <i class="fa fa-twitter"></i>
										                            </a>
										                            <a href="#"> <i class="fa fa-google-plus"></i>
										                            </a>
										                            <a href="#"> <i class="fa fa-pinterest"></i>
										                            </a>
										                        </div>
										                    </div>
										                    <!--/.product-share-->
										            </div>
										            <!--/.modal-details-inner-->
										        </div>
										        <!--/.modal-details-->
										        <div class="clear"></div>
										    </div>
										    <!-- /.modal-content -->
										</div>
									<!-- /.modal-dialog -->
									</div>
								</template>
								<!-- /.modal -->
								<!-- End Modal -->
		          </div>
		          <!-- /.row -->

		          <div class="row">
		              <div class="load-more-block text-center"><a class="btn btn-thin" href="#"> <i
		                      class="fa fa-plus-sign">+</i> load more products</a></div>
		          </div>
		      </div>
		      <!--/.container-->
		</div>
		<div v-if="flash.success" style="position: fixed;bottom: 30px;right: 30px; color:#FFF;display: block;height: auto;min-height: 30px;width: auto;padding: 10px; border-radius: 3px; background-color: #000;z-index: 100; transition: all 0.3s ease; -web-kit-transition: all 0.3s ease;">
	        {{flash.success}}
	    </div>
	</div>
	<!-- Quick View -->
	<!-- Product Details Modal  -->

<!-- End Modal -->

<!-- End Modal -->
</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'
    import CartAction from '../../../../helper/cart'
    import Vue from 'vue';
    var VueCookie = require('vue-cookie')
    Vue.use(VueCookie)

    export default {
        data() {
            return {
            	isActive: true,
                flash: Flash.state,
                error: Flash.state,
                error: {},
                productRecommandeds: [],
                productInfo:[],
                isProcessing: false,
                session_id : this.$cookie.get('session_id')
            }
        },
        created() {
      		axios.get(`/api/recommandProduct`)
          .then(response => {
            this.productRecommandeds = response.data['data']
            this.isActive = !this.isActive
          })
          .catch(e => {
            this.errors.push(e)
          })
        },
        ready() {
           
        },
        methods: {
          ModalQuickView (product_id) {
                var value = ['#productSetailsModalAjax​​'+product_id]
                return value.join(' ')
            },
          ShowId (product_id) {
              var value = ['productSetailsModalAjax​​'+product_id]
              return value.join(' ')
          },
          AddToCart(product_id,qty=1){
            CartAction.AddToCart(product_id,qty,this.session_id)
            Flash.setSuccess(qty+' Item added to your cart.')
            window.scrollTo(100,0)
          }
        }
    }
</script>