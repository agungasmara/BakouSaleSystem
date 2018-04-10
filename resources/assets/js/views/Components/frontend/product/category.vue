<template>
	<div v-bind:class="{ active: isActive }" class="loading">	
		<div class="container main-container headerOffset">
		    <!-- Main component call to action -->
		    <div class="row">
		        <div class="breadcrumbDiv col-lg-12">
		            <ul class="breadcrumb">
		                <li><a href="index.html">Home</a></li>
		                <li class="active">{{category_info['name']}}</li>
		            </ul>
		        </div>
		    </div>
		    <!-- /.row  -->
		    <div class="row">
		        <!--left column-->
		        <div v-if="category_filter.length>0" class="col-lg-3 col-md-3 col-sm-12">
		            <div class="panel-group" id="accordionNo">
						<!--filter group ########-->
						<template v-for="gfilter in category_filter">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a data-toggle="collapse" :href="collapseGroup(gfilter.filter_group_id,1)"
															class="collapseWill active ">
										{{gfilter.name}} <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a></h4>
								</div>
								<div :id="collapseGroup(gfilter.filter_group_id,0)" class="panel-collapse collapse in">
									<div class="panel-body smoothscroll maxheight300">
										
										<template v-for="filter in gfilter['filter']">
											<div class="block-element">
												<label>
													<input type="checkbox" name="tour" value="0"/>
													{{filter.name}}
												</label>
											</div>
										</template>
										
									</div>
								</div>
							</div>
						</template>

						<template style="display:none">
							<!--Category-->
							<div style="display:none" class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapseCategory" class="collapseWill active ">
											<span class="pull-left"> <i class="fa fa-caret-right"></i></span>
											Category 
										</a>
									</h4>
								</div>
								<div id="collapseCategory" class="panel-collapse collapse in">
									<div class="panel-body">
										<ul class="nav nav-pills nav-stacked tree">
											<li class="active dropdown-tree open-tree"><a class="dropdown-tree-a"> <span
													class="badge pull-right">42</span> WOMEN COLLECTION </a>
												<ul class="category-level-2 dropdown-menu-tree">
													<li class="dropdown-tree"><a class="dropdown-tree-a" href="sub-category.html">
														Tshirt</a></li>
													<li><a> Shoes</a></li>
													<li><a> Shirt</a></li>
													<li><a>T shirt</a></li>
													<li><a href="sub-category.html"> Shirt</a></li>
													<li><a href="sub-category.html">Fragrances</a></li>
													<li><a href="sub-category.html">Scarf</a></li>
													<li><a href="sub-category.html">Sandal</a></li>
													<li><a href="sub-category.html">Underwear</a></li>
													<li><a href="sub-category.html">Winter Collection</a></li>
													<li><a href="sub-category.html">Men Accessories</a></li>
												</ul>
											</li>
											<li><a href="#"> <span class="badge pull-right">42</span> MEN COLLECTION </a></li>
											<li><a href="#"> <span class="badge pull-right">42</span> Baby & Kids </a></li>
											<li><a href="#"> <span class="badge pull-right">42</span> Home & Kitchen </a></li>
											<li><a href="#"> <span class="badge pull-right">42</span> Baby & Kids </a></li>
											<li><a href="#"> <span class="badge pull-right">42</span> More Stores </a></li>
											<li><a href="#"> <span class="badge pull-right">42</span> Offers Zone </a></li>
										</ul>
									</div>
								</div>
							</div>
							<!--/Category menu end-->

							<div style="display:none" class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a class="collapseWill active " data-toggle="collapse"
															href="#collapsePrice">
										Price <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a> <span
											class="pull-right clearFilter  label-danger"> Clear </span></h4>
								</div>
								<div id="collapsePrice" class="panel-collapse collapse in">
									<div class="panel-body priceFilterBody">
										<!-- -->
										<label>
											<input type="radio" name="agree" value="0"/>
											100$ - 500$</label>
										<br>
										<label>
											<input type="radio" name="agree" value="1"/>
											500$ - 1000$</label>
										<br>
										<label>
											<input type="radio" name="agree" value="2"/>
											1000$ - 1500$</label>
										<br>
										<label>
											<input type="radio" name="agree" value="3"/>
											1500$ - 2000$</label>
										<br>
										<label>
											<input type="radio" name="agree" value="4"/>
											2000$ - 2500$</label>
										<br>
										<label>
											<input type="radio" name="agree" value="5"/>
											2500$ - 3000$</label>
										<br>
										<label>
											<input type="radio" name="agree" value="6" disabled checked/>
											Don't know</label>
										<hr>
										<p>Enter a Price range </p>

										<form class="form-inline " role="form">
											<div class="form-group">
												<input type="text" class="form-control" id="exampleInputEmail2"
													placeholder="2000 $">
											</div>
											<div class="form-group sp"> -</div>
											<div class="form-group">
												<input type="text" class="form-control" id="exampleInputPassword2"
													placeholder="3000 $">
											</div>
											<button type="submit" class="btn btn-default pull-right">check</button>
										</form>
									</div>
								</div>
							</div>
							<!--/price panel end-->

							<div style="display:none" class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a data-toggle="collapse" href="#collapseBrand"
															class="collapseWill active ">
										Brand <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a></h4>
								</div>
								<div id="collapseBrand" class="panel-collapse collapse in">
									<div class="panel-body smoothscroll maxheight300">
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="0"/>
												Armani </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="1"/>
												Gucci </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="2"/>
												Louis Vuitton </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Chanel </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Roberto Cavalli </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Valentino </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Ralph Lauren </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Miu Miu </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												McQueen </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												adidas </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Nike </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Jimmy Choo </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Bottega Veneta </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Donna Karan </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Oscar de la Renta </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Tods </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Burberry </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Michael Kors </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Mulberry </label>
										</div>
										<div class="block-element">
											<label> &nbsp; </label>
											<!-- keep it blank // -->
										</div>
									</div>
								</div>
							</div>
							<!--/brand panel end-->

							<div style="display:none" class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a data-toggle="collapse" href="#collapseColor"
															class="collapseWill active ">
										Color <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a></h4>
								</div>
								<div id="collapseColor" class="panel-collapse collapse in">
									<div class="panel-body smoothscroll maxheight300 color-filter">
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="0"/>
												<small style="background-color:#333333"></small>
												Black <span>(123)</span> </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="1"/>
												<small style="background-color:#1664c4"></small>
												Blue (434) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="2"/>
												<small style="background-color:#c00707"></small>
												Red (338) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#6fcc14"></small>
												Green (253) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#943f00"></small>
												Brown (240) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#ff1cae"></small>
												Pink (212) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#f5f5dc"></small>
												Beige (176) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#adadad"></small>
												Grey (154) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#5d00dc"></small>
												Purple (132) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#f1f40e"></small>
												Yellow (104) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#ffc600"></small>
												Orange (77) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#9b1d00"></small>
												Maroon (76) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#0a43a3"></small>
												Navy Blue (68) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#ede4b2"></small>
												Tan (67) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#ecf1ef"></small>
												Silver (49) </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												<small style="background-color:#f3f1e7"></small>
												Off White (44) </label>
										</div>
										<div class="block-element">
											<label> &nbsp; </label>
										</div>
									</div>
								</div>
							</div>
							<!--/color panel end-->
							<div style="display:none" class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a data-toggle="collapse" href="#collapseThree"
															class="collapseWill active ">
										Discount <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a></h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse in">
									<div class="panel-body">
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Non-Discounted items </label>
										</div>
										<div class="block-element">
											<label>
												<input type="checkbox" name="tour" value="3"/>
												Discounted items </label>
										</div>
									</div>
								</div>
							</div>
							<!--/discount  panel end-->
						</template>
		            </div>
		        </div>

		        <!--right column-->
		        <div class="col-lg-9 col-md-9 col-sm-12">
		            <div class="w100 clearfix category-top">
		                <h2> {{category_info['name']}} </h2>
		                <!--<div class="categoryImage"><img src="/images/site/category.jpg" class="img-responsive" alt="img"></div>-->
		            </div>
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
		            <div class="row categoryProduct xsResponse clearfix">
		                <div v-if="productByCat.length>0">
							<paginate name="productByCat" :list="productByCat" :per="page_limit" class="_paginate-list">
								<div v-for="product in paginated('productByCat')" class="item col-sm-4 col-lg-4 col-md-4 col-xs-6">
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
											<router-link v-bind:to="'/product/product_detail/'+ product.product_id+'/'+category_info.category_id"><img v-bind:src="product.image" v-bind:alt="product.name"
																				class="img-responsive"></router-link>

											<!--<div class="promotion"><span class="new-product"> NEW</span> <span
													class="discount">15% OFF</span></div>-->
											<template v-if="product.special != null">
												<div class="promotion"><span class="discount"> PROMOTION</span></div>
											</template>
										</div>
										<div class="description">
											<h4><router-link v-bind:to="'/product/product_detail/'+ product.product_id+'/'+category_info.category_id">{{product.name}}</router-link></h4>

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
								<paginate-links v-if="productByCat.length>0" class="pagination no-margin-top" for="productByCat" :show-step-links="true"></paginate-links>
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
		filter_name:'',
		productByCat:[],
		total_product:0,
		category_filter:[],
		page_limit:15,
		items: ['Item One', 'Item Two', 'Item Three', 'Item Four', 'Item Five', 'Item Six', 'Item Seven', 'Item Eight', 'Item Nine', 'Item Ten', 'Item Eleven', 'Item Twelve', 'Item Thirteen'],
    	paginate: ['productByCat'],
        isActive: true,
		category_info:'',
        loading:true,
        response: null,
		session_id : this.$cookie.get('session_id')
      }
    },
    watch:{
        '$route.params.id': function (id) {
            this.productByCategory(id,'')
            this.isActive = !this.isActive
        }
    },
    created() {
       this.productByCategory(this.id,'')
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
			this.productByCategory(this.id,filter_name)
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
        productByCategory(id,filter_name){
            axios.get('/api/category?category_id='+this.id+'&filter_name='+filter_name)
	        .then(response => {
				if(response.data['data'].length>0){
					this.response = response.data
					this.productByCat = response.data['data']
					this.category_info = response.data['category_info']
					this.category_filter = response.data['getCategoryFilters']
					this.total_product = response.data['total_product']
					this.isActive = !this.isActive
				}
	        })
	        .catch(e => {
	          this.errors.push(e)
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