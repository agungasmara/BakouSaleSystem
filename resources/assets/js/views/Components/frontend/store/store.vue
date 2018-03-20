<template>
	<div v-bind:class="{ active: isActive }" class="loading">	
		<div class="container main-container headerOffset">
            <center>
				<img v-bind:src="storeData['config_image']"/>
			</center>
		    <!-- Main component call to action -->
		    <div class="row">
		        <div class="breadcrumbDiv col-lg-12">
		            <ul class="breadcrumb">
		                <li><router-link to="/">Home</router-link></li>
                        <li><router-link to="#">Store</router-link></li>
		                <li class="active">{{storeData['config_name']}}</li>
		            </ul>
		        </div>
		    </div>
		    <!-- /.row  -->
		    <div class="row">
		        <!--left column filter ########################-->

		        <!--right column-->
		        <div class="col-lg-12 col-md-12 col-sm-12">
		            <!--/.category-top-->

		            <!--<div class="row subCategoryList clearfix">
		                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
		                    <div class="thumbnail"><a class="subCategoryThumb" href="sub-category.html">
		                    	<img src="/images/catalog/demo/headset/headset.jpg" class="img-rounded " alt="img"> </a> <a class="subCategoryTitle"><span> T shirt </span></a>
		                    </div>
		                </div>
		                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center">
		                    <div class="thumbnail"><a class="subCategoryThumb" href="sub-category.html"><img
		                            src="/images/catalog/demo/headset/headset1.jpg" class="img-rounded " alt="img"> </a> <a
		                            class="subCategoryTitle"><span> Shirt </span></a></div>
		                </div>
		                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center">
		                    <div class="thumbnail"><a class="subCategoryThumb" href="sub-category.html"><img
		                            src="/images/catalog/demo/headset/headset2.jpg" class="img-rounded " alt="img"> </a> <a class="subCategoryTitle"><span> shoes </span></a>
		                    </div>
		                </div>
		                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center">
		                    <div class="thumbnail"><a class="subCategoryThumb" href="sub-category.html"><img
		                            src="/images/catalog/demo/headset/headset3.jpg" class="img-rounded " alt="img"> </a> <a
		                            class="subCategoryTitle"><span> Accessories </span></a></div>
		                </div>
		                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center">
		                    <div class="thumbnail"><a class="subCategoryThumb" href="sub-category.html"><img
		                            src="/images/catalog/demo/headset/headset4.jpg" class="img-rounded  " alt="img"> </a> <a
		                            class="subCategoryTitle"><span> Winter Collection </span></a></div>
		                </div>
		                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center">
		                    <div class="thumbnail"><a class="subCategoryThumb" href="sub-category.html"><img
		                            src="/images/catalog/demo/headset/headset5.jpg" class="img-rounded " alt="img"> </a> <a
		                            class="subCategoryTitle"><span> Fragrances </span></a></div>
		                </div>
		            </div>-->
		            <!--/.subCategoryList-->

		            <div class="w100 productFilter clearfix">
		                <p class="pull-left"> Showing 1–{{page_limit}} of {{total_product}} results </p>

		                <div class="pull-right ">
		                    <div class="change-order pull-right">
		                        <select @change="onChange(filter_name)" v-model="filter_name" class="form-control" name="orderby">
		                            <option selected="selected">Default sorting</option>
		                            <!--<option value="popularity">Sort by popularity</option>
		                            <option value="rating">Sort by average rating</option>
		                            <option value="date">Sort by newness</option>-->
									<option value="name-asc">Sort by name: A to Z</option>
									<option value="name-desc">Sort by name: Z to A</option>
		                            <option value="price-asc">Sort by price: low to high</option>
		                            <option value="price-desc">Sort by price: high to low</option>
		                        </select>
		                    </div>
		                    <div class="change-view pull-right"><a href="#" title="Grid" class="grid-view"> <i
		                            class="fa fa-th-large"></i> </a> <a href="#" title="List" class="list-view "><i
		                            class="fa fa-th-list"></i></a></div>
		                </div>
		            </div>
		            <!--/.productFilter-->
		            <div class="row  categoryProduct xsResponse clearfix">
		                <div>
							<paginate name="getProductByStore" :list="getProductByStore" :per="page_limit" class="_paginate-list">
								<div v-for="product in paginated('getProductByStore')" class="item col-sm-3 col-lg-3 col-md-3 col-xs-6">
									<div class="product">
										<a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
										data-placement="left">
											<i class="glyphicon glyphicon-heart"></i>
										</a>

										<div class="image">
											<div class="quickview">
												<a data-toggle="modal" class="btn btn-xs btn-quickview" href="ajax/product.html"
												data-target="#productSetailsModalAjax">Quick View </a>
											</div>
											<router-link v-bind:to="'/product/product_detail/'+ product.product_id+'/0'"><img v-bind:src="product.image" v-bind:alt="product.name"
																				class="img-responsive"></router-link>

											<!--<div class="promotion"><span class="new-product"> NEW</span> <span
													class="discount">15% OFF</span></div>-->
											<template v-if="product.special != null">
												<div class="promotion"><span class="discount"> PROMOTION</span></div>
											</template>
										</div>
										<div class="description">
											<h4><router-link v-bind:to="'/product/product_detail/'+ product.product_id+'/0'">{{product.name}}</router-link></h4>

											<div class="grid-description">
												<p v-html="product.description"></p>
											</div>
											<div class="list-description">
												<p v-html="product.description"></p>
											</div>
											<!--<span class="size">XL / XXL / S </span>-->
										</div>
										<div class="price">
											<template v-if="product.special == null">
												<span class="price-sales">
													${{product.price}}
												</span>
											</template>
											<template v-else>
												<span class="price-sales">
													${{product.special}}
												</span> 
												<span class="price-standard">
													${{product.price}}
												</span>
											</template>
										</div>
										<div class="action-control"><a @click="AddToCart(product.product_id)" class="btn btn-primary"> <span class="add2cart"><i
												class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
									</div>
								</div>
							</paginate>
		                </div>
		                <!--/.item-->
		            </div>
		            <!--/.categoryProduct || product content end-->

		            <div class="w100 categoryFooter">
		                <div class="pagination pull-left no-margin-top">
		                    <!--<ul class="pagination no-margin-top">-->
								<paginate-links class="pagination no-margin-top" for="getProductByStore" :show-step-links="true"></paginate-links>
		                        <!--<li><a href="#">«</a></li>
		                        <li class="active"><a href="#">1</a></li>
		                        <li><a href="#">2</a></li>
		                        <li><a href="#">3</a></li>
		                        <li><a href="#">4</a></li>
		                        <li><a href="#">5</a></li>
		                        <li><a href="#">»</a></li>-->
		                    <!--</ul>-->
		                </div>
		                <div class="pull-right pull-right col-sm-4 col-xs-12 no-padding text-right text-left-xs">
		                    <p>Showing 1–{{page_limit}} of {{total_product}} results</p>
		                </div>
		            </div>
		            <!--/.categoryFooter-->
		        </div>
		        <!--/right column end-->
		    </div>
		    <!-- /.row  -->
		</div>
		<!-- /main container -->

		<div class="gap"></div>
	</div>
</template>


<style>
	/*#app {
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	font-size: 20px;
	text-align: center;
	color: #2c3e50;
	margin-top: 60px;
	}

	h1,
	h2 {
	font-weight: normal;
	}

	ul {
	list-style-type: none;
	padding: 0;
	}

	li {
	display: inline-block;
	margin: 0 10px;
	}
	.paginate-list {
		display: inline-block;
		padding-left: 0;
		margin: 20px 0;
		margin-top: 20px;
		border-radius: 4px;
	}
	.paginate-list li {
		display: block;
	}
	.paginate-links.items {
		user-select: none;
	}
	a {
		cursor: pointer;
	}
	ul.paginate-links.items li.number.active a {
		color: #f00 !important;
	}
	li.active a {
		font-weight: bold;
	}
	li.next:before {
		content: ' | ';
		margin-right: 13px;
		color: #ddd;
	}
	li.disabled a {
		color: #ccc;
		cursor: no-drop;
	}

	a {
	color: #42b983;
	}*/

</style>

<script type="text/javascript">

  import axios from 'axios'
  import Flash from '../../../../helper/flash'
  import CartAction from '../../../../helper/cart'
  import VueTranslate from 'vue-translate-plugin'
  import VuePaginate from 'vue-paginate'
  import Vue from 'vue'
  Vue.use(VuePaginate)
  Vue.use(VueTranslate)
  var VueCookie = require('vue-cookie')
  Vue.use(VueCookie)
  
  export default{
  	props:['id'],
    data(){
      return{
		getProductByStore:[],
		page_limit:5,
		items: ['Item One', 'Item Two', 'Item Three', 'Item Four', 'Item Five', 'Item Six', 'Item Seven', 'Item Eight', 'Item Nine', 'Item Ten', 'Item Eleven', 'Item Twelve', 'Item Thirteen'],
    	paginate: ['getProductByStore'],
        isActive: false,
        loading:false,
		category_info:'',
        total_product: null,
		session_id : this.$cookie.get('session_id'),
        storeData:null,
        getProductByStore:null,
        getCategoryFilters:[],
        filter_name:''
      }
    },
    beforeUpdate(){
        $('#search-list').slideUp(100)
        $('.search-full').hide(100)
    },
    watch:{
        '$route.params.id': function (id) {
            this.getStoreData(id,this.filter_name);
            this.isActive = !this.isActive
        }
    },
    created() {
       this.getStoreData(this.id,this.filter_name)
       this.isActive = !this.isActive
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
    methods:{
		onChange:function(filter_name){
			this.getStoreData(this.id,filter_name)
			this.isActive = !this.isActive
        },
		collapseGroup(id,flag) {
			var value = '';
			if(flag==1){
				value = ["#collapseGroup"+id]
			}else{
				value = ["collapseGroup"+id]
			}
			return value.join(' ')
		},
        getStoreData(id,filter_name){
			axios.get('/api/store/getStoreData?store_id='+id+'&filter_name='+filter_name).then(res=>{
                this.total_product = res.data['total_product']
			    this.storeData=res.data['store']
                this.getProductByStore=res.data['getProductByStore']
			    this.isActive = !this.isActive
			})
		},
		AddToCart(product_id,qty=1){
            CartAction.AddToCart(product_id,qty,this.session_id)
            Flash.setSuccess(qty+' Item added to your cart.')
            window.scrollTo(100,0)
        }
    }
  }
</script>