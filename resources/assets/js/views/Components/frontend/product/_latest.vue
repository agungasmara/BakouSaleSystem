<template>
	<!-- Demo Features Content start -->
  <div v-bind:class="{ active: isActive }" class="loading">
    <div class="morePost row featuredPostContainer style2 globalPaddingTop ">
        <!-- this div is for demo || Please remove it when use this page -->

        <h3 class="section-title style2 text-center"><span>LATEST PRODUCT {{getCurrent}}</span></h3>

        <div class="container">
            <div class="row xsResponse categoryProduct">

                
                <div v-for="latestProduct of latestProducts" class="item itemauto col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <!-- <div>{{latest.thumb}}</div> -->
                    <div class="product">
                        <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
                           data-placement="left">
                            <i class="glyphicon glyphicon-heart"></i>
                        </a>


                        <div class="imageHover">

                            <template v-if="latestProduct.special != null">
                              <div class="promotion"><span class="discount"> PROMOTION</span></div>
                            </template>

                            <div id="carousel-id-1" class="carousel slide" data-ride="carousel" data-interval="0">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-id-1" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-id-1" data-slide-to="1"></li>
                                    <li data-target="#carousel-id-1" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                       <router-link v-bind:to="'/product/product_detail/'+ latestProduct.product_id+'/0'">
                                        
                                        <img v-bind:src="latestProduct.thumb" alt="img" class="img-responsive ">
                                      </router-link>
                                     <!--  <a v-bind:href="'/product/product_detail/'+ latestProduct.product_id+'/0'">
                                        <img src="/assets/frontend/images/product/5.jpg" alt="img" class="img-responsive ">
                                      </a>   -->

                                      <!-- <a href="product-details.html"> 
                                        <img src="/assets/frontend/images/product/5.jpg" alt="img" class="img-responsive ">
                                      </a> -->
                                    </div>
                                    <div class="item">
                                      <router-link v-bind:to="'/product/product_detail/'+ latestProduct.product_id+'/0'">
                                        <img src="/assets/frontend/images/product/21.jpg" alt="img"
                                          class="img-responsive ">
                                      </router-link>
                                    </div>
                                    <div class="item">
                                      <router-link v-bind:to="'/product/product_detail/'+ latestProduct.product_id+'/0'">
                                        <img src="/assets/frontend/images/product/30.jpg" alt="img"
                                          class="img-responsive ">
                                      </router-link>
                                    </div>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-id-1" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-id-1" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>


                        </div>


                        <div class="description">
                            <h4>
                              <a href="product-details.html">{{latestProduct.name}} </a>
                            </h4>
                            <div class="grid-description">
                              <p v-html="latestProduct.description"></p>
                            </div>
                            <!--<span class="size">XL / XXL / S </span>-->
                            <br/>
                          </div>
                        <div class="price">
                          <template v-if="latestProduct.special == null">
                              <span class="price-sales">
                                  ${{latestProduct.price}}
                              </span>
                          </template>
                          <template v-else>
                              <span class="price-sales">
                                  ${{latestProduct.special}}
                              </span> 
                              <span class="price-standard">
                                  ${{latestProduct.price}}
                              </span>
                          </template>
                        </div>
                        <div class="action-control">

                          <a class="btn btn-primary" @click="AddToCart(latestProduct.product_id)"> 
                            <span class="add2cart">
                              <i class="glyphicon glyphicon-shopping-cart"> </i> Add to cart 
                            </span> 
                          </a>
                        </div>
                    </div>
                </div>
                <!--/.item-->


            </div>
        </div>

    </div>
    <div v-if="flash.success" style="position: fixed;right: 30px; top: 0; color:#FFF;display: block;height: auto;min-height: 30px;width: auto;padding: 10px; border-radius: 3px; background-color: #000;z-index: 100; transition: all 0.3s ease; -web-kit-transition: all 0.3s ease;">
        {{flash.success}}
    </div>
  </div>
  <!-- Demo Features Content end -->
</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import Common from '../../../../helper/common'
    import {post} from '../../../../helper/api'
    import CartAction from '../../../../helper/cart'
    import Vue from 'vue';
    var VueCookie = require('vue-cookie')
    Vue.use(VueCookie)

    export default {
        data() {
            return {
              dialog:true,
              isActive: true,
              flash: Flash.state,
              error: Flash.state,
              error: {},
              latestProducts: [],
              isProcessing: false,
              getCurrent:'',
              session_id : this.$cookie.get('session_id')
            }
        },
        components:{

        },
        mounted(){

        },
        ready: function(){

        },
        created() {
          axios.get(`/api/latest`)
  		    .then(response => {
  		      this.latestProducts = response.data['data']
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
            Flash.setSuccess(qty+' Item added to your cart.')
              // let toast = this.$toasted.show("Toasted !!", {
              //     theme: "primary",
              //     position: "bottom-right",
              //     duration : 5000
              // });
            window.scrollTo(100,0)
          }
          
        }
    }
</script>