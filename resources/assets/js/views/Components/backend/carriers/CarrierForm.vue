<template>
<!-- 	<v-app id="inspire">
		<multi-group
			
			v-bind:form-items="tabs"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			
		></multi-group>
	</v-app> -->

	<v-app id="inspire">
		<!-- <normal-form
			v-bind:url="url"
			v-bind:id="dataID"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="selects"
			v-bind:back-url="backUrl"
		></normal-form> -->
		

		<section id="_content">
			<!--breadcrumbs start-->
			<div id="breadcrumbs-wrapper">
				<!-- Search for small screen -->
				<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
				  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
				</div>
				<div class="row container">
				  <div class="container">
				    <div class="col s10 m6 l6">
				      <h5 class="breadcrumbs-title">Products</h5>
				      	<v-breadcrumbs>
				        	<v-icon slot="divider">/</v-icon>
			        		<v-breadcrumbs-item  v-for="breadcrumb in breadcrumbs" :key="breadcrumb.text" :disabled="breadcrumb.disabled">
			          			{{ breadcrumb.text }}
			        		</v-breadcrumbs-item>
			      		</v-breadcrumbs>
				    </div>
				    <div class="col s2 m6 l6">
				     	<router-link :to="back" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Back</v-btn></router-link>
				    	<v-btn @click="submit(1)" color="primary" class="btn dropdown-settings breadcrumbs-btn right">Save</v-btn>
				    </div>
				  </div>
				</div>
			</div>
			<!--breadcrumbs end-->
			<div id="basic-form" class="section">
	            <div class="row col s12">
	            	<div class="container">
		              <!-- Form with placeholder -->
		              <div class="col s12 m12 l12">
		                <div class="_card-panel">
		                  
		                  <div class="container">
		                    <v-form v-model="valid" ref="form" lazy-validation>
		                    	<div v-for="item in section">
			                    	<!-- /start -->
			                    	<div class="row">
				                    	<div class="col s12 m12 l2">
				                    		<div class="row">
					                    		<h4  class="header"> {{item.info_title}} </h4>
					                    		<div>
					                    			{{item.info_description}}
					                    		</div>
				                    		</div>
				                    	</div>
				                    	<div class="col s12 m12 l8">
					                      
					                      <div class="row">
					                      	<v-container grid-list-md>
					                      		<h4 class="header"><i class="material-icons text-left"> {{item.icon}} </i> {{item.title}} </h4>
					                      		<div class="divider"></div>
											    
											    	<form-group
				
														v-bind:form-items="group[item.form]"
														v-bind:form-rules="rules"
														v-bind:form-datas="data[item.form]"
														v-bind:select-items="select"
														
													></form-group>
											    <div v-if="item.form=='attributes'">
											    	<pro-attribute v-bind:form-datas="data[item.form]"></pro-attribute>
											    </div>	
											    <div v-if="item.form=='option'">
											    	<pro-option v-bind:form-datas="data[item.form]"></pro-option>
											    </div>	
											    <div v-if="item.form=='discount'">
											    	<discount v-bind:form-datas="data[item.form]"></discount>
											    </div>	
											    <div v-if="item.form=='special'">
											    	<special v-bind:form-datas="data[item.form]"></special>
											    </div>	
											    <div v-if="item.form=='gallery'">
											    	<product-gallery v-bind:form-datas="data[item.form]"></product-gallery>
											    </div>	
											</v-container>
					                      </div>
					                    </div>
					                    <div class="col s12 m12 l2">
					                    	
				                    		<div class="row" v-if="item.profile">
					                    		<h4 class="header">
						                    	<center> Product Image </center>
						                    	</h4>
						                    		
							                    	<form-group
														v-bind:form-items="group[item.profile]"
														v-bind:form-rules="rules"
														v-bind:form-datas="data.data"
														v-bind:select-items="select"
														
													></form-group>
					                    	</div>
					                    </div>
					                </div>
			                      	<div class="clearfix"></div>
			                    	<!-- */end  -->
		                    	</div>

		                    	
		                    </v-form>
		                  </div>
		                </div>
		              </div>
		            </div>
	            </div>
	        </div>
		</section>
	</v-app>
</template>
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import formGroup from '../commons/form/formGroup.vue'
	import proOption from '../product_feilds/product_options/productOptionForm.vue'
	import proAttribute from '../product_feilds/product_attribute/productAttributeForm.vue'
	import discount from '../product_feilds/discount/DiscountForm.vue'
	import special from '../product_feilds/special/SpecialForm.vue'
	import productGallery from '../product_feilds/gallery/ProductGallery.vue'
	import {post} from '../../../../helper/api'
	const es_host = 'http://localhost';
    const es_port = 9200;
    var es = require('elasticsearch');
    var client = new es.Client({
        host: 'localhost:9200',
        log: 'trace',
    });

	export default{
		props:['id'],
		components: {
			formGroup,
			proOption,
			proAttribute,
			discount,
			special,
			productGallery
		},
		data(){
			return{
				back:'/admin/Products/list',
				url:'/admin/api/products/',
				valid:true,
				breadcrumbs: [
			        {
			          text: 'Dashboard',
			          disabled: false
			        },
			        {
			          text: 'Products',
			          disabled: false
			        },
			        {
			          text: 'Form',
			          disabled: true
			        }
		      	],
				section:[
					{
						info_title:'carriers',
						info_description:'Setup your carrier here. ',
						title:'General settings',
						icon:'info_outline',
						profile:'profile',
						form:'general',
					},
					{
						info_title:'',
						info_description:'',
						title:'Shipping locations and costs',
						icon:'info_outline',
						form:'data',
					},
					{
						info_title:'',
						info_description:'',
						title:'Size, weight, and group access',
						icon:'info_outline',
						form:'links',
					},
					

				],
				group:{
					profile:[
						{	class:'xs12 sm12',	key:'image',	type:'image',	 Value:''},
						
					],
					general:[
						{	class:'xs6 sm6',	 text:'Carrier Name',	key:'name',	type:'text',	 Value:''},
						{	class:'xs6 sm6',	 text:'Transit time',	key:'tag',	type:'text',	 Value:''	},
						{	class:'xs6 sm6',	 text:'Speed grade',	key:'meta_title',	type:'text',	 Value:''	},
						{	class:'xs6 sm6',	 text:'Tracking Url',	key:'meta_keyword',	type:'text',	 Value:''	},
						
					],
					data:[
						{	class:'xs12',	 text:'Out-of-rang behavior',	key:'minimum',	type:'select',	 Value:'' ,	items:'tax_class'},
						{	class:'xs12',	 text:'Tax Class',	key:'tax_class_id',	type:'select',	 Value:'',	items:'tax_class'},
						{	class:'xs12',	 text:'Active',	key:'active',	type:'checkbox',	 Value:'1'},
						{	class:'xs12',	 text:'Free shipping',	key:'is_free',	type:'checkbox',	 Value:'1'},
						{	class:'xs12',	 text:'Add handling costs',	key:'shipping_handling',	type:'checkbox',	 Value:'1'},
						
					],
					links:[
						{	class:'xs12 sm6',	 text:'Maximum package width (cm)',	key:'max_width',	type:'number',	 Value:''	},
						{	class:'xs12 sm6',	 text:'Maximum package height (cm)',	key:'max_height',	type:'number',	 Value:''	},
						{	class:'xs12 sm6',	 text:'Maximum package depth (cm)',	key:'max_depth',	type:'number',	 Value:''	},
						{	class:'xs12 sm6',	 text:'Maximum package weight (kg)',	key:'max_weight',	type:'number',	 Value:''	},
						{	class:'xs12 sm12',	 text:'Grade',	key:'grade',	type:'checkbox',	 Value:'1'},







					],
					

				},
				rules:{
					
				},
				data:{
					general:{},
					data:{
						image:''
					},
					links:{},
					attributes:[],
					option:[],
					discount:[],
					special:[],
					gallery:[],
				},
				select:{
					categories:[],
					manufacturer:[],
					status:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					shipping:[
						{text:'Yes',value:1},
						{text:'No',value:0}
					],
					stock_status:[],
				},
			}
		},
		mounted(){
			if(this.id){
			 	this.fetchData(this.id)
			}
		},
		created(){
			this.getCategories()
			this.getManufacturers()
			this.getStore()
			this.getTaxClass()
			this.getStockStatus()
			this.getProductRelates()
			this.getFilter()
		},
		methods:{
			getCategories(){
				axios.get('/admin/api/getCategories').then((res)=>{
					this.select.categories=res.data
				})
			},
			getManufacturers(){
				axios.get('/admin/api/getManufacturers').then((res)=>{
					this.select.manufacturer=res.data
				})
			},
			getStore(){
				axios.get('/admin/api/getStore').then(res=>{
					this.select.store=res.data
				});
			},
			getTaxClass(){
				axios.get('/admin/api/getTaxClass').then(res=>{
					this.select.tax_class=res.data
				});
			},
			
			getStockStatus(){
				axios.get('/admin/api/getStockStatus').then(res=>{
					this.select.stock_status=res.data
				});
			},
			getProductRelates(){
				axios.get('/admin/api/getProductRelates').then(res=>{
					this.select.products=res.data
				});
			},
			getFilter(){
				axios.get('/admin/api/getFilter').then(res=>{
					this.select.filter=res.data
				});
			},
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			initInsertElastic(){
				let params = {
					"id": "28",
					"name": "Headphones & Headsets - In-Ear Headphones",
					"price": "11",
					"status": 1,
					"description": "description product",
					"isCrawler": false,
					"imageUrl": "http://localhost:8000/images/catalog/demo/hp_2.jpg",
					"crawlPrice": "$.332",
					"crawlpriceSpecial": "211",
					"crawldiscountRate": "23",
					"sourceWebsite": "http://www.google.com",
					"productLink": "http://localhost:8000/product/product_detail/42",
					"categories": {
						"cat_id": "1",
						"cat_name": "Headphones & Headsets",
						"cat_alias": "Headphones & Headsets"
					},
					"brand": {
						"brandname": "Petro",
						"image": "http://localhost:8000/images/store/taobao.jpg",
						"brand_id": 1
					},
					"store": {
						"store_id":1,
						"storename": "Bakou Store",
						"image": "http://localhost:8000/images/store/bakou.png"
					},
					"popular": 1
				}
				post(''+es_host+':'+es_port+'/store/product/3333', params).then(response => {
					alert("success")
				},{headers: {'Content-Type': 'application/json','Accept': 'application/json','Access-Control-Allow-Origin': '*','Access-Control-Allow-Headers': 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin'}}, response => {
				})
			},
			submit (opt=1) {

		      	// if (this.$refs.form.validate()) {
			        // Native form submission is not yet supporte
			        
			        if(!this.id){
			        	axios.post(this.url,
				          this.data
				        ).then((res)=>{
				        	console.log(res.data)
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
								this.initInsertElastic()
				        		// this.$refs.form.reset()
				        		// if(opt==2){
				        		this.$router.push(this.back)
				        		// }
				        	}else{
				        		Flash.setError(res.data.message)
				        	}
				        })
				        .catch((err) => {
	      //                 	if(err.response.status === 422) {
	      //                     	this.error = err.response.message
							// }
							Flash.setError('Error while saving data')
	                  	})
			        }else{
			        	console.log(this.formDatas)
			        	axios.put(this.url+this.id,
				          	this.data
				        ).then((res)=>{
				        	console.log(res.data)
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
								this.initInsertElastic()
				        		// if(opt==2){
				        		this.$router.push(this.back)
				        		// }
				        	}else{
				        		Flash.setError(res.data.message)
				        	}
				        })
				        .catch((err) => {
	      //                 	if(err.response.status === 422) {
	      //                     	this.error = err.response.message
							// }
							Flash.setError('Error while updateing data')
	                  	})
			        }
			        
		      	// }
		    },
		}
	}
</script>