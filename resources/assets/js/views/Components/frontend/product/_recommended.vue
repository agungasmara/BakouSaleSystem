<template>
	<div v-bind:class="{ active: isActive }" class="loading">
		<div class="morePost row featuredPostContainer style2 globalPaddingTop ">
		      <h3 class="section-title style2 text-center"><span>RECOMMADED PRODUCT</span></h3>

		      <div class="container">
		          <div class="row xsResponse equalHeightCategoryProduct">

		              <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6" v-for="productRecommanded of productRecommandeds">
		                  <div class="product">
		                      <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
		                         data-placement="left">
		                          <i class="glyphicon glyphicon-heart"></i>
		                      </a>

		                      <div class="image">
		                          <div class="quickview">
		                              <a data-toggle="modal" class="btn btn-xs btn-quickview" href="ajax/product"
		                                 data-target="#productSetailsModalAjax">Quick View </a>
		                          </div>
		                          <router-link v-bind:to="'/product/product_detail/'+ productRecommanded.product_id">
		                          	 <img v-bind:src="productRecommanded.thumb" alt="img" class="img-responsive">
									</router-link>

		                          <div class="promotion">
		                          	<span class="new-product"> NEW</span>
		                          	<span class="discount">15% OFF</span>
		                          </div>
		                      </div>
		                      <div class="description">
		                          <h4>
		                          	<router-link v-bind:to="'/product/product_detail/'+ productRecommanded.product_id">
		                          		{{productRecommanded.name}}
									</router-link>
		                          </h4>

		                          <p v-html="productRecommanded.description">.</p>
		                          <span class="size">XL / XXL / S </span></div>
		                      <div class="price" v-if="productRecommanded.special != ''">
		                      	<span>  ${{productRecommanded.price}}</span> 
		                      </div>
		                      <div class="price" v-else>
		                      	<span>  ${{productRecommanded.price}}</span> 
		                      	<span class="old-price"> ${{productRecommanded.special}}</span>
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
		          </div>
		          <!-- /.row -->

		          <div class="row">
		              <div class="load-more-block text-center"><a class="btn btn-thin" href="#"> <i
		                      class="fa fa-plus-sign">+</i> load more products</a></div>
		          </div>
		      </div>
		      <!--/.container-->
		</div>
	</div>
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
          AddToCart(product_id,qty=1){
            CartAction.AddToCart(product_id,qty,this.session_id)
            window.scrollTo(100,100)
          }
        }
    }
</script>