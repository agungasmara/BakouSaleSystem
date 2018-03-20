<template>
  <div>
    <!-- include template slider -->
    <template lang="jade">
      <SlideComponent/>
    </template>
    <!-- {searchResults}} -->
    <!-- <div v-if="searchResults">
      <div v-for="item of searchResults['elasticdata']">
        {{item._source.name}}<br/>
      </div>
    </div> -->
    <!-- elastic search -->
    <!-- <br/> -->
    <!-- <center><input style="width:300px" placeholder="Search, Branch, Shop, ..." v-model="q" type="text" @keyup="search" name=""/></center> -->

    <div class="container main-container">

       <!-- Main component call to action -->

    <!-- BestSeller -->
     <!-- ***** template component BestSeller ***** -->
        <template>
          <BestSellerProductComponent/>
        </template>

      <!-- Main component call to action -->
     <!-- BestSeller -->

    <!--/.featuredPostContainer-->      
      <!--/.featuredPostContainer-->
    </div>
  <!-- /main container -->

  <div class="parallax-section parallax-image-1">
    <div class="container">
      <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="parallax-content clearfix">
            <h1 class="parallaxPrce"> $200 </h1>

            <h2 class="uppercase">FREE INTERNATIONAL SHIPPING! Get Free Shipping Coupons</h2>

            <h3> Energistically develop parallel mindshare rather than premier deliverables. </h3>

            <div style="clear:both"></div>
            <a class="btn btn-discover "> <i class="fa fa-shopping-cart"></i> Shop Now </a>
          </div>
        </div>
      </div>
        <!--/.row-->
    </div>
    <!--/.container-->
  </div>
  <!--/.parallax-image-1-->

  <div class="container main-container">
    
    <!-- ***** template component latest ***** -->
    <template>
      <LatestProductComponent/>
      <RecommendProductComponent/>
    </template>
    <!--/.featuredPostContainer-->

    <hr class="no-margin-top">
    <div class="width100 section-block ">
        <div class="row featureImg">
          
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-1.jpg" class="img-responsive" alt="img">
              </a>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-2.jpg" class="img-responsive" alt="img">
              </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-3.jpg" class="img-responsive" alt="img">
              </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-4.jpg" class="img-responsive" alt="img">
              </a>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.section-block-->

    <!-- ***** template component Carousel ***** -->
    <template>
      <CarouselDesignComponent/>
    </template>
    <!-- Main component call to action -->

    <!--/.section-block-->
  </div>
  <!--main-container-->

  <div class="parallax-section parallax-image-2">
      <div class="w100 parallax-section-overley">
          <div class="container">
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="parallax-content clearfix">
                          <h1 class="xlarge"> Trusted Seller 500+ </h1>
                          <h5 class="parallaxSubtitle"> Want to be our reseller on website? </h5>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--/.parallax-section-->

  <!-- Product Details Modal  -->
  <!-- Modal -->
  <div class="modal fade" id="productSetailsModalAjax" tabindex="-1" role="dialog"
       aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  </div>
</template>

<script>
  import Vue from 'vue'
  import VueResource from 'vue-resource'
  import Request from 'sync-request'
  import axios from 'axios'
  import {post} from '../../../helper/api'
  import {createIndex} from '../../../helper/createIndex'
  import Flash from '../../../helper/flash'

  // ***** include component *****
  import RegisterComponent from './../../Auth/Register.vue'
  import SlideComponent from './../../Components/frontend/include/slide.vue'
  import LatestProductComponent from './../../Components/frontend/product/_latest.vue'
  import RecommendProductComponent from './../../Components/frontend/product/_recommended.vue'
  import BestSellerProductComponent from './../../Components/frontend/product/_bestseller.vue'
  // ***** design component *****
  import CarouselDesignComponent from './../../Components/frontend/desgin/_carousel.vue'
  // import { search } from './helper/elasticsearch'

  Vue.use(VueResource)

  Vue.http.options.emulateJSON = true
  Vue.http.options.emulateHTTP = true
  Vue.http.options.crossOrigin = true
  Vue.http.headers.common['Access-Control-Allow-Origin'] = 'http://localhost:9200/'

  Vue.http.headers.common['Access-Control-Request-Method'] = '*'
  Vue.http.headers.common['Content-Type'] = 'application/x-www-form-urlencoded'
  Vue.http.headers.common['Accept'] = 'application/json, text/plain, */*'
  Vue.http.headers.common['Access-Control-Allow-Headers'] = 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin'

  const es_host = 'http://localhost'; // For Production
  const es_port = 9200;
  // import ES from 'elasticsearch'
  var es = require('elasticsearch');
  // var client = new elasticsearch.Client({
  //     host: '127.0.0.1:9200'
  // });

  // var client = new ES.Client({
  //   host: 'localhost:9200',
  //   log: 'trace'
  // });

  var client = new es.Client({
    host: 'localhost:9200',
    log: 'trace',
  });


  // var client = new ES.Client({
  //     host: 'localhost:9200',
  //     log: 'trace',
  //     keepAlive: true
  // });

  // var searchText = "myiphone";
  // Vue.http.headers.common['Access-Control-Allow-Origin'] = '*';
  // Vue.http.headers.common['Access-Control-Request-Method'] = '*';
  export default {
    data() {
      return {
        q:'',
        searchResults:Flash.state,
        posts: [],
        errors: [],
        latestProducts:[],
        loading: true,
        results: null,
      }
    },
    ready() {
      this.q = q;
    },
    methods: {
      search: function() {
        // client.ping({
        //   requestTimeout: 30000,
        // }, function (error) {
        //   if (error) {
        //     console.error('elasticsearch cluster is down!');
        //   } else {
        //     console.log('All is well');
        //   }
        // });
        var searchText = this.q;
        client.search({
          index: "store",
          type: "product",
          body: {
                    "size": 5,
                      "sort": [
                    {"popular": {"order": "desc"}}
                ],
                "query": {
                      "query_string": {
                      "query": (searchText == '' || searchText == ' ')? '*' : searchText+"*",
                      "fields": ["name"]
                  }
                }
                ,
                "aggs": {
                    "categories": {
                        "terms": {
                            "field": "categories.cat_id",
                            "size": 5 // limit number result distinct
                        },
                        "aggs": {
                            "tops": {
                                "top_hits": {
                                    "size": 5
                                }
                            }
                        }
                    }
                }// end aggs
          }// end body
        }).then(function (resp) {
            // return hits = resp.hits.hits;
            Flash.setState(resp['hits']['hits']);
        }, function (err) {
          console.trace(err.message);
        });
      }
    },
    components:{
      RegisterComponent,
      SlideComponent,
      LatestProductComponent,
      BestSellerProductComponent,
      RecommendProductComponent,
      CarouselDesignComponent,
    },
    // Fetches posts when the component is created.
    created() {
      var params = '';
      params = {
        data: {
          "mappings": {
            "products": {
              "properties":{
                "id": {
                  "type": "string"
                },
                "name": {
                  "type": "string",
                  "fielddata": true
                },
                "alias": {
                  "type": "string",
                },
                "image": {
                  "type": "string"
                },
                "price": {
                  "type": "double"
                },
                // "ex_price": {
                //   "type": "double"
                // },
                // "price_range_id": {
                //   "type": "string"
                // },
                "status": {
                  "type": "integer"
                },
                "description": {
                  "type": "string"
                },
                "isCrawler":{
                  "type":"boolean"
                },
                "categories": {
                  "properties": {
                    "cat_id": {
                      "type": "string",
                      "fielddata": true
                    },
                    "cat_name": { "type": "string" },
                    "cat_alias": { "type": "string" }
                  }
                },
                "brand":{
                  "properties":{
                    "id":{
                      "type": "string",
                      "fielddata": true
                    },
                    "name":{
                      "type":"string"
                    }
                  }
                },
                "popular": {
                  "type": "integer"
                }
              }
            }
          }
        }
      };
      // createIndex('http://localhost:9200', params);
      // Vue.http.put("http://localhost:9200", params)

      // async / await version (created() becomes async created())
      
      // try {
      //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
      //   this.posts = response.data
      // } catch (e) {
      //   this.errors.push(e)
      // }
      
    }
  }
</script>