<template>
    <div class="row featuredPostContainer globalPadding style2">
        <h3 class="section-title style2 text-center"><span>BEST SELLER</span></h3>
        <!-- <div v-for="bestSellerProduct of bestSellerProducts">{{bestSellerProduct.product_id}}</div> -->
        <div class="row xsResponse categoryProduct">

          <div v-for="bestSellerProduct of bestSellerProducts" class="item itemauto col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <!-- <div>{{latest.thumb}}</div> -->
              <div class="product">
                  <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
                     data-placement="left">
                      <i class="glyphicon glyphicon-heart"></i>
                  </a>


                  <div class="imageHover">

                      <div class="promotion"><span class="discount">15% OFF</span></div>

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
                                 <router-link v-bind:to="'/product/product_detail/'+ bestSellerProduct.product_id">
                                  
                                  <img v-bind:src="bestSellerProduct.thumb" alt="img" class="img-responsive ">
                                </router-link>
                               <!--  <a v-bind:href="'/product/product_detail/'+ bestSellerProduct.product_id">
                                  <img src="/assets/frontend/images/product/5.jpg" alt="img" class="img-responsive ">
                                </a>   -->

                                <!-- <a href="product-details.html"> 
                                  <img src="/assets/frontend/images/product/5.jpg" alt="img" class="img-responsive ">
                                </a> -->
                              </div>
                              <div class="item">
                                <router-link v-bind:to="'/product/product_detail/'+ bestSellerProduct.product_id">
                                  <img src="/assets/frontend/images/product/21.jpg" alt="img"
                                    class="img-responsive ">
                                </router-link>
                              </div>
                              <div class="item">
                                <router-link v-bind:to="'/product/product_detail/'+ bestSellerProduct.product_id">
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
                      <h4><router-link v-bind:to="'/product/product_detail/'+ bestSellerProduct.product_id"> {{bestSellerProduct.name}} </router-link></h4>
                      <div class="grid-description">
                        <!-- <span v-html="bestSellerProduct.description"></span> -->
                      </div>
                      <span class="size">XL / XXL / S </span></div>
                  <div class="price"><span>{{bestSellerProduct.price}}</span></div>
                  <div class="action-control"><router-link to="" class="btn btn-primary"> <span class="add2cart"><i
                          class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </router-link></div>
              </div>
          </div>
          <!--/.item-->

        </div>
    </div>    
</template>
<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'

    export default {
        data() {
            return {
                flash: Flash.state,
                error: Flash.state,
                error: {},
                bestSellerProducts: [],
                isProcessing: false
            }
        },
        created() {
            axios.get(`/api/bestSeller`)
            .then(response => {
              this.bestSellerProducts = response.data['data']
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
        ready() {
           
        },
        methods: {
           
        }
    }
</script>