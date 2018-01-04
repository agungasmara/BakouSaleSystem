<template>
	<!-- Demo Features Content start -->

  <div class="morePost row featuredPostContainer style2 globalPaddingTop ">
      <!-- this div is for demo || Please remove it when use this page -->

      <h3 class="section-title style2 text-center"><span>LATEST PRODUCT</span></h3>

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
                                    <router-link to="/my_account">
                                        <img src="/assets/frontend/images/product/5.jpg" alt="img" class="img-responsive ">
                                    </router-link>
                                    <!-- <a href="product-details.html"> 
                                      <img src="/assets/frontend/images/product/5.jpg" alt="img" class="img-responsive ">
                                    </a> -->
                                  </div>
                                  <div class="item">
                                    <a href="product-details.html"> 
                                      <img src="/assets/frontend/images/product/21.jpg" alt="img"
                                        class="img-responsive ">
                                    </a>
                                  </div>
                                  <div class="item">
                                    <a href="product-details.html"> 
                                      <img src="/assets/frontend/images/product/30.jpg" alt="img"
                                        class="img-responsive ">
                                    </a>
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
                          <h4><a href="product-details.html"> {{latestProduct.name}} </a></h4>

                          <div class="grid-description">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                          </div>
                          <div class="list-description">
                              <p> Sed sed rutrum purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                  Pellentesque risus lacus, iaculis in ante vitae, viverra hendrerit ante. Aliquam vel
                                  fermentum elit. Morbi rhoncus, neque in vulputate facilisis, leo tortor sollicitudin
                                  odio, quis pellentesque lorem nisi quis enim. In dolor mi, hendrerit at blandit
                                  vulputate, congue a purus. Sed eget turpis sit amet orci euismod accumsan. Praesent
                                  sit amet placerat elit. </p>
                          </div>
                          <span class="size">XL / XXL / S </span></div>
                      <div class="price"><span>$25</span></div>
                      <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
                              class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
                  </div>
              </div>
              <!--/.item-->


          </div>
      </div>

  </div>
  <!-- Demo Features Content end -->
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
                latestProducts: [],
                isProcessing: false
            }
        },
        created() {
            axios.get(`/api/latest`)
		    .then(response => {
          
		      this.latestProducts = response.data['data']
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