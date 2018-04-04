<template>
	<v-app id="inspire">
		<!-- <normal-form
			v-bind:url="url"
			v-bind:id="0"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
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
				    	<v-btn @click="submit(1)" :disabled="!valid" color="primary" class="btn dropdown-settings breadcrumbs-btn right">Save</v-btn>
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
		                    	<v-alert color="success" value='true' v-if="flash.success">
							          	{{flash.success}}
							      	</v-alert>
							      	<v-alert color="error" value='true' v-if="flash.error">
							          	{{flash.error}}
							      	</v-alert>
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
												</v-container>
					                      </div>
					                      	<form-group
												v-bind:form-items="group[item.form]"
												v-bind:form-rules="rules"
												v-bind:form-datas="data[item.form]"
												v-bind:select-items="select"
											></form-group>
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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	// import normalForm from '../commons/form/normalForm.vue'
	import formGroup from '../../commons/form/formGroup.vue'
	export default{
		components:{
			formGroup
		},
		data(){
			return{
				url:'/api/returns/',
				e1:true,
				valid: true,
				flash:Flash.state,
				section:[
					{
						info_title:'Customer',
						info_description:'Setup your customer here. ',
						title:'General',
						icon:'info_outline',
						form:'general',
					},
					{
						info_title:'Product Information',
						info_description:'',
						title:'Product Information & Reason for Return',
						icon:'info_outline',
						form:'product_info',
					},
				],
				group:{
					general:[
						{	class:'xs12 sm6 md6',	 key:'order_id',	type:'text',	 text:'Order ID'	},
						{	class:'xs12 sm6 md6',	 key:'order_date',	type:'date',text:'Order Date'},
						{	class:'xs12 sm6 md6',	 key:'customer',	type:'text',	 text:'Customer',	},
						{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name',	},
						{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',	 text:'Last Name',	},
						{	class:'xs12 sm6 md6',	 key:'email',	type:'text',	 text:'Email',	},
						{	class:'xs12 sm12 md12',	 key:'telephone',	type:'text',	 text:'Telephone',	},
					],
					product_info:[
						{	class:'xs12 sm6 md6',	 key:'product_id',	type:'select',	 text:'Product',items:'products'	},
						{	class:'xs12 sm6 md6',	 key:'model',	type:'select',text:'Model',items:'models'},
						{	class:'xs12 sm6 md6',	 key:'quantity',	type:'number',	 text:'Quantity',	},
						{	class:'xs12 sm6 md6',	 key:'return_reason',	type:'select',	 text:'Return Reason',items:'reasons'	},
						{	class:'xs12 sm12 md12',	 key:'opened',	type:'select',	 text:'Opened',	},
						{	class:'xs12 sm12 md12',	 key:'comment',	type:'editor',	 text:'Comment',	},
						{	class:'xs12 sm6 md6',	 key:'return_action',	type:'select',	 text:'Return Action',	items:'returnActions'},
						{	class:'xs12 sm6 md6',	 key:'return_status',	type:'select',	 text:'Return Status',	items:'returnStatus'},
					]
				},
				rules:{
					firstname: [
				      (v) => !!v || 'First Name is required'
				    ],
				    lastname:[
				      (v) => !!v || 'Last Name is required'
				    ],
				    customer:[
				      (v) => !!v || 'Group is required'
				    ],
				    email:[
				      (v) => !!v || 'Email is required'
				    ],
				    telephone:[
				      (v) => !!v || 'Telephone is required'
				    ]
				},
				data:{
					general:{
						safe:1,
						newsletter:1,
						status:1,
						sec_user_id:0,
						language_id:1
					},
			    	product_info:{},
				},
				select:{
					customers:[
						'Test'
					],
					products:[
						'Camera canon 70D',
						'Camera canon 5D',
						'Camera canon 6D'
					],
					models:[
						'Canon 70D',
						'Canon 5D',
						'Canon 6D'
					],
					returnStatus:[
						{text:'Pending',value:1},
						{text:'Awaiting',value:2}
					],
					returnActions:[
						{text:'Credit Issue',value:1},
						{text:'Refund',value:2}
					]
				},

				breadcrumbTitle:'Customer',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Customer',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    back:'/admin/returns/list',
			}
		},
		created(){
			
		},
		watch:{
		},
		methods:{
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
				        		// this.$refs.form.reset()
				        		// if(opt==2){
				        			// this.$router.push(this.back)
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
				        			// this.$router.push(this.back)
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