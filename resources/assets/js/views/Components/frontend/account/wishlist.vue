<template>
	<div id="loading">
		<i v-show="loading" style="font-size:70px;position:absolute;left:50%;top:20%" class="fa fa-spinner fa-spin"></i>
		<div class="container main-container headerOffset">
		    <div class="row">
		        <div class="breadcrumbDiv col-lg-12">
		            <ul class="breadcrumb">
		                <li><a href="">Home</a></li>
		                <li><a href="">My Account</a></li>
		                <li class="active"> Wisthlist</li>
		            </ul>
		        </div>
		    </div>
		    <!--/.row-->
		    <div class="row">
		        <div class="col-lg-9 col-md-9 col-sm-7">
		            <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-heart"></i> Wisthlist </span></h1>

		            <div class="row userInfo">
		                <div class="col-lg-12">
		                    <h2 class="block-title-2"> Update your wishlist if it has changed. </h2>
		                </div>
		                <div class="col-xs-12 col-sm-12">
		                    <table>
		                        <tbody>
			                        <tr v-for="data in response" class="CartProduct">
			                            <td style="width:15%" class="CartProductThumb">
			                                <div><a href="product-details.html"><img v-bind:src="data.image" v-bind:alt="data.name"></a></div>
			                            </td>
			                            <td style="width:40%">
			                                <div class="CartDescription">
			                                    <h4><a href="">{{data.name}}</a></h4>
			                                    <span class="size">12 x 1.5 L</span>

			                                    <div class="price"><span>${{data.price}}</span></div>
			                                </div>
			                            </td>
			                            <td style="width:15%">
			                                <a class="btn btn-primary">
			                                    <span class="add2cart"><i class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span>
			                                </a>
			                            </td>
			                            <td style="width:40%" class="delete"><a title="Delete"> <i
			                                    class="glyphicon glyphicon-trash fa-2x"></i> </a></td>
			                        </tr>

			                        <!-- <tr class="CartProduct">
			                            <td style="width:10%" class="CartProductThumb">
			                                <div><a href="product-details.html">
			                                    <img src="images/product/11.jpg" alt="img"></a></div>
			                            </td>
			                            <td style="width:40%">
			                                <div class="CartDescription">
			                                    <h4><a href="product-details.html">Denim T shirt Black </a></h4>
			                                    <span class="size">12 x 1.5 L</span>

			                                    <div class="price"><span>$80</span></div>
			                                </div>
			                            </td>
			                            <td style="width:15%"><a class="btn btn-primary"> <span class="add2cart"><i
			                                    class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></td>
			                            <td style="width:40%" class="delete"><a title="Delete"> <i
			                                    class="glyphicon glyphicon-trash fa-2x"></i> </a></td>
			                        </tr>

			                        <tr class="CartProduct">
			                            <td style="width:10%" class="CartProductThumb">
			                                <div><a href="product-details.html">
			                                    <img src="images/product/a2.jpg" alt="img"></a></div>
			                            </td>
			                            <td style="width:40%">
			                                <div class="CartDescription">
			                                    <h4><a href="product-details.html">Denim T shirt Black </a></h4>
			                                    <span class="size">12 x 1.5 L</span>

			                                    <div class="price"><span>$88</span></div>
			                                </div>
			                            </td>
			                            <td style="width:15%"><a class="btn btn-primary"> <span class="add2cart"><i
			                                    class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></td>
			                            <td style="width:40%" class="delete"><a title="Delete"> <i
			                                    class="glyphicon glyphicon-trash fa-2x"></i> </a></td>
			                        </tr>

			                        <tr class="CartProduct">
			                            <td style="width:10%" class="CartProductThumb">
			                                <div><a href="product-details.html">
			                                    <img src="images/product/a5.jpg" alt="img"></a></div>
			                            </td>
			                            <td style="width:40%">
			                                <div class="CartDescription">
			                                    <h4><a href="product-details.html">Denim T shirt Black </a></h4>
			                                    <span class="size">12 x 1.5 L</span>

			                                    <div class="price"><span>$70</span></div>
			                                </div>
			                            </td>
			                            <td style="width:15%"><a class="btn btn-primary"> <span class="add2cart"><i
			                                    class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></td>
			                            <td style="width:40%" class="delete"><a title="Delete"> <i
			                                    class="glyphicon glyphicon-trash fa-2x"></i> </a></td>
			                        </tr>

			                        <tr class="CartProduct">
			                            <td style="width:10%" class="CartProductThumb">
			                                <div><a href="product-details.html">
			                                    <img src="images/product/a4.jpg" alt="img"></a></div>
			                            </td>
			                            <td style="width:40%">
			                                <div class="CartDescription">
			                                    <h4><a href="product-details.html">Denim T shirt Black </a></h4>
			                                    <span class="size">12 x 1.5 L</span>

			                                    <div class="price"><span>$55</span></div>
			                                </div>
			                            </td>
			                            <td style="width:15%"><a class="btn btn-primary"> <span class="add2cart"><i
			                                    class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></td>
			                            <td style="width:40%" class="delete"><a title="Delete"> <i
			                                    class="glyphicon glyphicon-trash fa-2x"></i> </a></td>
			                        </tr>

			                        <tr class="CartProduct">
			                            <td style="width:10%" class="CartProductThumb">
			                                <div><a href="product-details.html">
			                                    <img src="images/product/a3.jpg" alt="img"></a></div>
			                            </td>
			                            <td style="width:40%">
			                                <div class="CartDescription">
			                                    <h4><a href="product-details.html">Denim T shirt Black </a></h4>
			                                    <span class="size">12 x 1.5 L</span>

			                                    <div class="price"><span>$60</span></div>
			                                </div>
			                            </td>
			                            <td style="width:15%"><a class="btn btn-primary"> <span class="add2cart"><i
			                                    class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></td>
			                            <td style="width:40%" class="delete"><a title="Delete"> <i
			                                    class="glyphicon glyphicon-trash fa-2x"></i> </a></td>
			                        </tr> -->

		                        </tbody>
		                    </table>
		                </div>

		                <div class="col-lg-12 clearfix">
		                    <ul class="pager">
		                        <li class="previous pull-right">
		                        	<router-link v-bind:to="'/'" title="Orders">
		                               <i class="fa fa-home"></i> Go to Shop
		                            </router-link>
		                        </li>
		                        <li class="next pull-left">
		                        	 <router-link v-bind:to="'/account/dashboard'" title="Orders">
                                    	← Back to My account
                            		</router-link>
		                        </li>
		                    </ul>
		                </div>

		            </div>
		            <!--/row end-->

		        </div>
		        <div class="col-lg-3 col-md-3 col-sm-5"></div>
		    </div>
		    <!--/.row-->
		    <div style="clear:both"></div>
		</div>
		<!-- /main-container -->

		<div class="gap"></div>
	</div>
</template>


<script type="text/javascript">

  import axios from 'axios'
  import Flash from '../../../../helper/flash'
  import VueTranslate from 'vue-translate-plugin'
  import Vue from 'vue';
  Vue.use(VueTranslate);
  
  export default{
    data(){
      return{
        loaded: true,
        response: null,
      }
    },
    created() {
    	this.loading = true
        axios.get(`/api/wishlist`)
        .then(response => {
            this.response = response.data['data']  
            this.loading = false
        })
        .catch(e => {
          this.errors.push(e)
        })
    },
    locales: {
        en: {
            'entry_personal_information': 'My personal information',
            'entry_text_update_information': 'Please be sure to update your personal information if it has​​​​ changed.',
            'entry_require_field': 'Required Field'
        },
        kh: {
            'entry_personal_information': 'ពត៌មានផ្ទាល់ខ្លួន',
            'entry_text_update_information': 'Please be sure to update your personal information if it has​​​​ changed.',
            'entry_require_field': 'Required Field'
        }
    },
    mounted: function(){
        // this.loading = true;

        // return this.$scopedSlots.default({
        //   response: this.response.data['data']
        // })
    }
  }
</script>