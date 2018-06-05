<template id="{{ $route.params.id }}">
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
				      <h5 class="breadcrumbs-title">Shipments</h5>
				      	<v-breadcrumbs>
				        	<v-icon slot="divider">/</v-icon>
			        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
			          			{{ item.text }}
			        		</v-breadcrumbs-item>
			      		</v-breadcrumbs>
				    </div>
				    <div class="col s2 m6 l6">
				     	<router-link to="/admin/shipment/list" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Back</v-btn></router-link>
				    	<router-link to="/admin/shipment/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right"><i class="material-icons">print</i> &nbsp;Print</v-btn></router-link>
				    	<router-link to="/admin/shipment/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right"><i class="material-icons">print</i> &nbsp;Print Shipping</v-btn></router-link>
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
		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header">Delivery</h4>
				                    		<div>
				                    			Change general information for this product. 
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">local_shipping</i> &nbsp; Delivery Information</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">local_shipping</i> &nbsp;Shipping Number</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">local_shipping</i> &nbsp;Courier Express Delivery</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Normal</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Rate Shipping</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">date_range</i> &nbsp;2 to 3 days</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Bus</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;33</span>
										      	</v-flex>
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header">&nbsp;</h4>
				                    		<!-- <div>
				                    			Change general information for this product. 
				                    		</div> -->
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Volumetric Weight</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Height : 12	</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Width : 12	</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Length : 12	</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Total Volumetric : 12	</span>
										      	</v-flex>

										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header">Order Details</h4>
				                    		<div>
				                    			Change general information for this product. 
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">shopping_cart</i> &nbsp; Order Information</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">business_center</i> &nbsp;Bakou Sale System</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">date_range</i> &nbsp;27/12/2017</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">local_shipping</i> &nbsp;Cash Delivery</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Flat Shipping Rate</span>
										      	</v-flex>
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header"> Customer Detail</h4>
				                    		<div>
				                    			Change general information for this product. 
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">supervisor_account</i> &nbsp; Recipient Information</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">account_circle</i> &nbsp;Khove Mengtek</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">supervisor_account</i> &nbsp;Default</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">mail</i> &nbsp;email@gmail.com</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">phone_iphone</i> &nbsp;(+855)81 988 222</span>
										      	</v-flex>
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header">Generate Invoice</h4>
				                    		<div>
				                    			Change general information for this product. 
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">assignment</i> &nbsp; Options</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Bakou Sale System</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;27/12/2017</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Cash Delivery</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Flat Shipping Rate</span>
										      	</v-flex>
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header"></h4>
				                    		<div>
				                    			<!-- Change general information for this product.  -->
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">location_on</i> &nbsp; Payment Address</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Bakou Sale System</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;27/12/2017</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Cash Delivery</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Flat Shipping Rate</span>
										      	</v-flex>
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header"></h4>
				                    		<div>
				                    			<!-- Change general information for this product.  -->
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">attach_money</i> &nbsp; Shipping Address</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Bakou Sale System</span>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;27/12/2017</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Cash Delivery</span>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<span><i style="float: left;" class="material-icons">info_outline</i> &nbsp;Flat Shipping Rate</span>
										      	</v-flex>
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->
		                    	<div class="clearfix"></div>
		                    	<!-- list order products -->
		                    	<div id="striped-table">
					                <h4 class="header"><i class="material-icons text-left">assignment</i> &nbsp; Order #122</h4>
					                <div class="row">
					                  <div class="col s12">
					                    <table class="striped">
					                      <thead>
					                        <tr>
					                          <th data-field="id">Payment Address</th>
					                          <th data-field="name">Shipping Address</th>
					                        </tr>
					                      </thead>
					                      <tbody>
					                        <tr>
					                          <td>Alvin</td>
					                          <td>Eclair</td>
					                        </tr>
					                        <tr>
					                          <td>Alan</td>
					                          <td>Jellybean</td>
					                        </tr>
					                        <tr>
					                          <td>Jonathan</td>
					                          <td>Lollipop</td>
					                        </tr>
					                        <tr>
					                          <td>Shannon</td>
					                          <td>KitKat</td>
					                        </tr>
					                      </tbody>
					                    </table>
					                  </div>
					                </div>
					              </div>
		                    	<!-- .*/end -->

		                    	<div class="clearfix"></div>
		                    	<!-- list order products -->
		                    	<div id="striped-table">
					                <h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Product Details</h4>
					                <div class="row">
					                  <div class="col s12">
					                    <table class="striped">
					                      <thead>
					                        <tr>
					                          <th data-field="id">Product</th>
					                          <th data-field="name">Model</th>
					                          <th data-field="price">Quantity</th>
					                          <th data-field="unit_price">Unit Price</th>
					                          <th data-field="total">Total</th>
					                        </tr>
					                      </thead>
					                      <tbody>
					                        <tr>
					                          <td>Alvin</td>
					                          <td>Eclair</td>
					                          <td>$0.87</td>
					                          <td>$0.87</td>
					                          <td>$0.87</td>
					                        </tr>
					                        <tr>
					                          <td>Alan</td>
					                          <td>Jellybean</td>
					                          <td>$3.76</td>
					                          <td>$0.87</td>
					                          <td>$0.87</td>
					                        </tr>
					                        <tr>
					                          <td>Jonathan</td>
					                          <td>Lollipop</td>
					                          <td>$7.00</td>
					                          <td>$0.87</td>
					                          <td>$0.87</td>
					                        </tr>
					                        <tr>
					                          <td>Shannon</td>
					                          <td>KitKat</td>
					                          <td>$9.99</td>
					                          <td>$0.87</td>
					                          <td>$0.87</td>
					                        </tr>
					                      </tbody>
					                      <tfoot style="border-top:1px solid #d0d0d0;">
					                      	<tr>
					                      		<td colspan="3">&nbsp;</td>
					                      		<td><b>Sub Total</b></td>
					                      		<td>$0.122</td>
					                      	</tr>
					                      	<tr>
					                      		<td colspan="3">&nbsp;</td>
					                      		<td><b>Total</b></td>
					                      		<td>$12.00</td>
					                      	</tr>
					                      </tfoot>
					                    </table>
					                  </div>
					                </div>
					              </div>
		                    	<!-- .*/end -->


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

<style type="text/css">
	.layout.row.wrap{padding-top:30px;}
	.text-left{float: left;padding-top:5px;}
</style>
	
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return {
				dataID:0,
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
				url:'/admin/api/carriers/',
				group:[
					{	class:'xs12 sm6 md6',	 key:'username',	type:'text',	 text:'Username',count:100,	},
					{	class:'xs12 sm6 md6',	 key:'user_group_id',	type:'select',items:'userGroupItems',	 text:'User Group',count:100	},
					{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',	 text:'Last Name',count:100	},
					{	class:'xs12 sm4 md4',	 key:'email',	type:'text',	 text:'Email',count:50	},
					{	class:'xs12 sm4 md4',	 key:'code',	type:'text',	 text:'Code',count:25	},
					{	class:'xs12 sm4 md4',	 key:'status',	type:'select',items:'statusItems',	 text:'Status',count:100	},
					{	class:'xs12 sm12 md12',	 key:'image',	type:'image',	 Value:'Photo',count:0	}
					
				],
				rules:{
					username: [
				      (v) => !!v || 'Username is required',
				      (v) => v && v.length <= 16 || 'Username must be less than 16 characters'
				    ],
					firstname: [
				      (v) => !!v || 'First Name is required',
				      (v) => v && v.length <= 10 || 'First Name must be less than 10 characters'
				    ],
				    lastname: [
				      (v) => !!v || 'Last Name is required',
				      (v) => v && v.length <= 10 || 'Last Name must be less than 10 characters'
				    ],
				    email: [
				      (v) => !!v || 'E-mail is required',
				      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
				    ],
				    code: [
				      (v) => !!v || 'Code is required',
				      (v) => v && v.length <= 8 || 'Code must be less than 8 characters'
				    ]
				},
				data:{
					username:'dgdg',
					firstname: 'dgadg',
					lastname: 'dgdg',
					email:'dgadgad@ddgd.com',
					code: 'dgdag',
					status:0,
					user_group_id:1,
					image:''
				},
				selects:{
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					userGroupItems:[]
				},
			    error:false,
		    	message:[],
			    select: null,
			    items: [],
			    selectGroup:null,
			    groups:[],
			    breadcrumbTitle:'View Shipments',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Shipments',
			          disabled: false
			        },
			        {
			          text: 'View',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/shipment/list',
				flash:Flash.state
			}
		},
		created(){
			this.dataID=this.id
			this.getUserGroup()
			this.fetchData(this.id)
		},
		methods:{
			getImage(event){
				console.log('data after child handle: ', event)
			},
			getUserGroup(){
				axios.get('/admin/api/users_group').then((res)=>{
					this.selects.userGroupItems=res.data
				})
			},
			fetchData(id){
				axios.get(this.url+id+'/edit').then((res)=>{
					// this.data.user_group_id=res.data.user_group_id
					// this.data.username=res.data.username
					// this.data.firstname=res.data.firstname
					// this.data.lastname=res.data.lastname
					// this.data.email=res.data.email
					// this.data.code=res.data.code
					// this.data.status=res.data.status
					// this.data.image=res.data.image
					this.data=res.data
				})
			},
			
		    checkPasswordConfirmed(){
	    		if(this.password===this.confirmPassword){
		        	this.error=false
		        }else{
		        	if(this.confirmPassword===""){
		        		this.error=false
		        	}else{
		        		this.error=true
		        	}
		        }
		        return this.error
		    },
		    onPickFile() {
		    	this.btnImageDisabled=true
		    	this.btnText="Uploading..."
		        this.$refs.fileInput.click()
		    },
		    onFilePicked(event){
		    	
		    		
		    	const files=event.target.files
		    	let filename=files[0].name;
		    	if(filename.lastIndexOf('.')<=0){
		    		return alert('Please add a valid file!')
		    	}
		    	const fileReader=new FileReader()
		    	fileReader.addEventListener('load',()=>{
		    		
		    		this.imageUrl=fileReader.result
					this.btnImageDisabled=false
		    		this.btnText="Upload Image"
		    	
		    	})
		    	fileReader.readAsDataURL(files[0])
		    	
		    },
		    clearImage(){
		    	this.imageUrl=''
		    }
		}
	}
</script>