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
				      <h5 class="breadcrumbs-title">Products</h5>
				      	<v-breadcrumbs>
				        	<v-icon slot="divider">/</v-icon>
			        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
			          			{{ item.text }}
			        		</v-breadcrumbs-item>
			      		</v-breadcrumbs>
				    </div>
				    <div class="col s2 m6 l6">
				     	<router-link to="/admin/Products/list" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Back</v-btn></router-link>
				    	<router-link to="/admin/Products/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Save</v-btn></router-link>
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
				                    		<h4 class="header">Products</h4>
				                    		<div>
				                    			Setup your product here. 
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; General</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Product Name" v-model="product_name" :rules="codeRules"></v-text-field>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Meta Tage Title" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Meta Tage Keyword" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Product Tage" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Description" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Meta Tage Description" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>
										      	
										    </v-layout>
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3">
				                    	<img src="/images/NoPicture.png"/>
				                    </div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->

		                    	<!-- /start -->
		                    	<div class="row">
			                    	<div class="col s12 m12 l3">
			                    		<div class="row">
				                    		<h4 class="header"></h4>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Product Data</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Price" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<v-select label="Select Model" v-model="select"  :items="items"  :rules="[v => !!v || 'Item is required']" required></v-select>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="SKU" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="UPC" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="JAN" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Tax Class" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Quantity" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Minimum Order" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Requires Shipping" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Date Available" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Status" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Sort Order" v-model="code" :rules="codeRules"></v-text-field>
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
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Product Links</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<v-select label="Manufacturer" v-model="select"  :items="items"  :rules="[v => !!v || 'Item is required']" required></v-select>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Categories" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Filter" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Stores" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Downloads" v-model="code" :rules="codeRules"></v-text-field>
										      	</v-flex>

										      	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Related Products" v-model="code" :rules="codeRules"></v-text-field>
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
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Product Attributes</h4>
				                      		<div class="divider"></div>
										    <!-- <v-layout row wrap> -->
									    	<v-flex xs12 sm12 md12>
									      		<v-text-field label="Categories" v-model="code" :rules="codeRules"></v-text-field>
									      	</v-flex>
										      	
										    <!-- </v-layout> -->
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
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Product Optiion</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Categories" v-model="code" :rules="codeRules"></v-text-field>
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
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Discount</h4>
				                      		<div class="divider"></div>
										    <!-- <v-layout row wrap> -->
										    	<!-- list order products -->
						                    	<div id="striped-table">
									                <div class="row">
									                  <div class="col s12">
									                    <table class="striped">
									                      <thead>
									                        <tr>
									                          <th data-field="id">Customer Group</th>
									                          <th data-field="name">Quantity</th>
									                          <th data-field="name">Priority</th>
									                          <th data-field="name">Percentage</th>
									                          <th data-field="name">Price</th>
									                          <th data-field="name">Date Start</th>
									                          <th data-field="name">Date End</th>
									                        </tr>
									                      </thead>
									                      <tbody>
									                      	<tr>
									                      		<td>Customer Group</td>
									                      		<td>Quantity</td>
									                      		<td>Priority</td>
									                      		<td>Percentage</td>
									                      		<td>12222</td>
									                      		<td>Date Start</td>
									                      		<td>Date End</td>
									                      	</tr>

									                      	<tr>
									                      		<td>Customer Group</td>
									                      		<td>Quantity</td>
									                      		<td>Priority</td>
									                      		<td>Percentage</td>
									                      		<td>12222</td>
									                      		<td>Date Start</td>
									                      		<td>Date End</td>
									                      	</tr>

									                      	<tr>
									                      		<td>Customer Group</td>
									                      		<td>Quantity</td>
									                      		<td>Priority</td>
									                      		<td>Percentage</td>
									                      		<td>12222</td>
									                      		<td>Date Start</td>
									                      		<td>Date End</td>
									                      	</tr>

									                      	<tr>
									                      		<td>Customer Group</td>
									                      		<td>Quantity</td>
									                      		<td>Priority</td>
									                      		<td>Percentage</td>
									                      		<td>12222</td>
									                      		<td>Date Start</td>
									                      		<td>Date End</td>
									                      	</tr>
									                      </tbody>
									                    </table>
									                  </div>
									                </div>
									              </div>
						                    	<!-- .*/end -->
										      	
										    <!-- </v-layout> -->
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
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Special</h4>
				                      		<div class="divider"></div>
										    <!-- <v-layout row wrap> -->
									    	<!-- list order products -->
					                    	<div id="striped-table">
								                <div class="row">
								                  <div class="col s12">
								                    <table class="striped">
								                      <thead>
								                        <tr>
								                          <th data-field="id">Customer Group</th>
								                          <th data-field="name">Priority</th>
								                          <th data-field="name">Price</th>
								                          <th data-field="name">Date Start</th>
								                          <th data-field="name">Date End</th>
								                        </tr>
								                      </thead>
								                      <tbody>
								                      	<tr>
								                      		<td>Group1</td>
								                      		<td>1</td>
								                      		<td>100</td>
								                      		<td>2017-02-22</td>
								                      		<td>2017-02-22</td>
								                      	</tr>

								                      	<tr>
								                      		<td>Group1</td>
								                      		<td>1</td>
								                      		<td>100</td>
								                      		<td>2017-02-22</td>
								                      		<td>2017-02-22</td>
								                      	</tr>

								                      	<tr>
								                      		<td>Group1</td>
								                      		<td>1</td>
								                      		<td>100</td>
								                      		<td>2017-02-22</td>
								                      		<td>2017-02-22</td>
								                      	</tr>
								                      </tbody>
								                    </table>
								                  </div>
								                </div>
								              </div>
					                    	<!-- .*/end -->
										      	
										    <!-- </v-layout> -->
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
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Gallary</h4>
				                      		<div class="divider"></div>
										    <!-- <v-layout row wrap> -->
									    	<!-- list order products -->
					                    	<div id="striped-table">
								                <div class="row">
								                  <div class="col s12">
								                    <table class="striped">
								                      <thead>
								                        <tr>
								                          <th data-field="id">Additional Images</th>
								                          <th data-field="name">Sort Order</th>
								                        </tr>
								                      </thead>
								                      <tbody>
								                      	<tr>
								                      		<td>image 1</td>
								                      		<td>1</td>
								                      	</tr>
								                      	<tr>
								                      		<td>image 1</td>
								                      		<td>1</td>
								                      	</tr>
								                      	<tr>
								                      		<td>image 1</td>
								                      		<td>1</td>
								                      	</tr>
								                      </tbody>
								                    </table>
								                  </div>
								                </div>
								            </div>
					                    	<!-- .*/end -->
										    <!-- </v-layout> -->
										</v-container>
				                      </div>
				                    </div>
				                    <div class="col s12 m12 l3"></div>
				                </div>
		                      	<div class="clearfix"></div>
		                    	<!-- */end  -->
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
	.layout.row.wrap{padding-top:10px !important;}
	.text-left{float: left;padding-top:5px;}
	.row{margin-bottom:0 !important;}
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
			    breadcrumbTitle:'View Products',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Products',
			          disabled: false
			        },
			        {
			          text: 'View',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/Products/list',
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