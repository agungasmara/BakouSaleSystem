<template>
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
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/31.jpg" alt="img"
	                                                              class="img-responsive"></a>

	                          <div class="promotion"><span class="discount">15% OFF</span></div>
	                      </div>
	                      <div class="description">
	                          <h4><a href="product-details.html">ullamcorper suscipit lobortis </a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	             <!--  <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/34.jpg" alt="img"
	                                                              class="img-responsive"></a>

	                          <div class="promotion"><span class="new-product"> NEW</span></div>
	                      </div>
	                      <div class="description">
	                          <h4><a href="product-details.html">demonstraverunt lectores </a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	             <!--  <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/12.jpg" alt="img"
	                                                              class="img-responsive"></a></div>
	                      <div class="description">
	                          <h4><a href="product-details.html">humanitatis per</a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	             <!--  <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/33.jpg" alt="img"
	                                                              class="img-responsive"></a></div>
	                      <div class="description">
	                          <h4><a href="product-details.html">Eodem modo typi</a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	             <!--  <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/10.jpg" alt="img"
	                                                              class="img-responsive"></a></div>
	                      <div class="description">
	                          <h4><a href="product-details.html">sequitur mutationem </a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/37.jpg" alt="img"
	                                                              class="img-responsive"></a></div>
	                      <div class="description">
	                          <h4><a href="product-details.html">consuetudium lectorum.</a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/35.jpg" alt="img"
	                                                              class="img-responsive"></a></div>
	                      <div class="description">
	                          <h4><a href="product-details.html">parum claram</a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span> <span class="old-price">$75</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/13.jpg" alt="img"
	                                                              class="img-responsive"></a></div>
	                      <div class="description">
	                          <h4><a href="product-details.html">duis dolore </a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/21.jpg" alt="img"
	                                                              class="img-responsive"></a>

	                          <div class="promotion"><span class="new-product"> NEW</span> <span
	                                  class="discount">15% OFF</span></div>
	                      </div>
	                      <div class="description">
	                          <h4><a href="product-details.html">aliquam erat volutpat</a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/14.jpg" alt="img"
	                                                              class="img-responsive"></a>

	                          <div class="promotion"><span class="discount">15% OFF</span></div>
	                      </div>
	                      <div class="description">
	                          <h4><a href="product-details.html">ullamcorper suscipit lobortis </a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	              <!-- <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
	                          <a href="product-details.html"><img src="/assets/frontend/images/product/17.jpg" alt="img"
	                                                              class="img-responsive"></a>

	                          <div class="promotion"><span class="new-product"> NEW</span></div>
	                      </div>
	                      <div class="description">
	                          <h4><a href="product-details.html">demonstraverunt lectores </a></h4>

	                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
	                          <span class="size">XL / XXL / S </span></div>
	                      <div class="price"><span>$25</span></div>
	                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
	                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
	                  </div>
	              </div> -->
	              <!--/.item-->
	          </div>
	          <!-- /.row -->

	          <div class="row">
	              <div class="load-more-block text-center"><a class="btn btn-thin" href="#"> <i
	                      class="fa fa-plus-sign">+</i> load more products</a></div>
	          </div>
	      </div>
	      <!--/.container-->
	</div>
</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'
    import CartAction from '../../../../helper/cart'
    export default {
        data() {
            return {
                flash: Flash.state,
                error: Flash.state,
                error: {},
                productRecommandeds: [],
                isProcessing: false
            }
        },
        created() {
      		axios.get(`/api/recommandProduct`)
            .then(response => {
              this.productRecommandeds = response.data['data']
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
        ready() {
           
        },
        methods: {
          AddToCart(product_id,qty=1){
            CartAction.AddToCart(product_id,qty)
            window.scrollTo(100,100)
          }
        }
    }
</script>