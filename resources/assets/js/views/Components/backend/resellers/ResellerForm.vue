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
				    	<v-btn @click="submit()" color="primary" class="btn dropdown-settings breadcrumbs-btn right">Save</v-btn>
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
	export default{
		props:['id'],
		components: {
			formGroup
		},
		data(){
			return{
				back:'/admin/reseller/list',
				url:'/admin/api/reseller/',
				valid:true,
				breadcrumbs: [
			        {
			          text: 'Dashboard',
			          disabled: false
			        },
			        {
			          text: 'Reseller',
			          disabled: false
			        },
			        {
			          text: 'Form',
			          disabled: true
			        }
		      	],
				section:[
					{
						info_title:'Store',
						info_description:'Setup your store here. ',
						title:'General',
						icon:'info_outline',
						profile:'profile',
						form:'general',
					},
					{
						info_title:'Information',
						info_description:'Setup your store information',
						title:'Information',
						icon:'info_outline',
						form:'data',
					},
					{
						info_title:'',
						info_description:'',
						title:'Localization',
						icon:'info_outline',
						form:'local',
					},
					{
						info_title:'',
						info_description:'',
						title:'Optiion',
						icon:'info_outline',
						form:'option',
					},
					

				],
				group:{
					profile:[
						{	class:'xs12 sm12',	key:'image',	type:'image',	 Value:''},
						
					],
					general:[
						{	class:'xs12',	 text:'config_url',	key:'config_url',	type:'text',	 Value:''},
						{	class:'xs12',	 text:'config_ssl',	key:'config_ssl',	type:'text',	 Value:''},
						{	class:'xs12',	 text:'config_meta_title',	key:'config_meta_title',	type:'text',	 Value:''},
						{	class:'xs12',	 text:'config_meta_description',	key:'config_meta_description',	type:'textarea',	 Value:''},
						{	class:'xs12',	 text:'config_meta_keyword',	key:'config_meta_keyword',	type:'textarea',	 Value:''},
						{	class:'xs12',	 text:'config_theme',	key:'config_theme',	type:'text',	 Value:''},
						{	class:'xs12',	 text:'config_layout_id',	key:'config_layout_id',	type:'text',	 Value:''},
						
					],
					data:[
						{	class:'xs12 sm6',	 text:'Price',	key:'config_comment',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_open',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_image',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_fax',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_email',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_geocode',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_address',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_owner',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_name',	type:'text',	 Value:''},
						{	class:'xs12 sm6',	 text:'Price',	key:'config_telephone',	type:'text',	 Value:''},
						
					],
					links:[
						{	class:'xs12 sm6',	 text:'Categories',	key:'category_id',	type:'select',	 Value:''	,items:'categories'},
						{	class:'xs12 sm6',	 text:'Filter',	key:'filter_id',	type:'select',	 Value:''	,items:'aaaa'},
						{	class:'xs12 sm6',	 text:'Store',	key:'store_is',	type:'select',	 Value:''	,items:'aaaa'},
						{	class:'xs12 sm6',	 text:'Downloads',	key:'downloads',	type:'select',	 Value:''	,items:'aaaa'},
						{	class:'xs12 sm12',	 text:'Related Product',	key:'related_product',	type:'select',	 Value:''	,items:'aaaa'},

					],
					attributes:[],
					option:[],
					discount:[],
					special:[],
					allary:[],

				},
				rules:{
					
				},
				data:{
					general:{},
					data:{
						image:''
					},
					links:{},
					attributes:{},
					option:[],
					discount:{},
					special:{},
					allary:{},
				},
				select:{
					categories:[],
					manufacturer:[],
					status:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
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
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			submit (opt=1) {
		      	if (this.$refs.form.validate()) {
			        // Native form submission is not yet supporte
			        
			        if(!this.id){
			        	axios.post(this.url,
				          this.data
				        ).then((res)=>{
				        	console.log(res.data)
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		this.$refs.form.reset()
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
			        
		      	}
		    },
		}
	}
</script>