<!-- <template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="dataID"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="selects"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-card>
</v-app>
</template> -->
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
				      <h5 class="breadcrumbs-title">Resellers</h5>
				      	<v-breadcrumbs>
				        	<v-icon slot="divider">/</v-icon>
			        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
			          			{{ item.text }}
			        		</v-breadcrumbs-item>
			      		</v-breadcrumbs>
				    </div>
				    <div class="col s2 m6 l6">
				     	<router-link to="/admin/reseller/list" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Back</v-btn></router-link>
				    	<router-link to="/admin/reseller/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Save</v-btn></router-link>
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
				                    		<h4 class="header">Store</h4>
				                    		<div>
				                    			This store in available for owner and has full priviledge.
				                    		</div>
			                    		</div>
			                    	</div>
			                    	<div class="col s12 m12 l6">
				                      
				                      <div class="row">
				                      	<v-container grid-list-md>
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Reseller Information</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="First Name" v-model="resellerInfo.firstname"/></v-text-field>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Last Name" v-model="resellerInfo.lastname"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Owner" v-model="resellerInfo.owner"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Company" v-model="resellerInfo.company"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Primary Email" v-model="resellerInfo.email"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Secondary Email" v-model="resellerInfo.email_2"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Website" v-model="resellerInfo.website"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Telephone 1" v-model="resellerInfo.telephone_1"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Telephone 2" v-model="resellerInfo.telephone_2"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-select label="Country" v-model="resellerInfo.country" required></v-select>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-select label="Province" v-model="resellerInfo.province" required></v-select>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-select label="City" v-model="resellerInfo.city" required></v-select>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Code" v-model="resellerInfo.code"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Address 1" v-model="resellerInfo.address_1"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Address 2" v-model="resellerInfo.address_2"/></v-text-field>
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
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Store Owner Login</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs12 sm12 md12>
										      		<v-text-field label="Email" v-model="resellerInfo.email"/></v-text-field>
										      	</v-flex>

										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Password" v-model="resellerInfo.password"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Confirm Password" v-model="resellerInfo.password"/></v-text-field>
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
				                      		<h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Configuration Store</h4>
				                      		<div class="divider"></div>
										    <v-layout row wrap>
										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Store Name" v-model="storeInfo.config_name"/></v-text-field>
										      	</v-flex>
										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Currency" v-model="storeInfo.config_currency"/></v-text-field>
										      	</v-flex>
										    	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Display Price With Tax"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Use Store Tax Address"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Use Customer Tax Address"/></v-text-field>
										      	</v-flex>

										      	<!-- <v-flex xs12 sm12 md12>
										      		<v-checkbox :label="`Checkbox 1: ${checkbox.toString()}`"
												      v-model="checkbox"></v-checkbox>
										      	</v-flex> -->
										    </v-layout>
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
				url:'/api/resellers/',
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
				resellerInfo:'',
				storeInfo:'',
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
			    breadcrumbTitle:'Edit Reseller',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Reseller',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/reseller/list',
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
				axios.get('/api/users_group').then((res)=>{
					this.selects.userGroupItems=res.data
				})
			},
			fetchData(id){
				axios.get(this.url+id+'/edit').then((res)=>{
					this.resellerInfo = res.data['resellerData']
					this.storeInfo = res.data['store']
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