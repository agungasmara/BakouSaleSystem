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
						  	<productQuickView v-bind:productId="productRecommanded.product_id"/>
						</template>
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
	import productQuickView from './_product_quick_view.vue'
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
		components:{
			productQuickView,
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