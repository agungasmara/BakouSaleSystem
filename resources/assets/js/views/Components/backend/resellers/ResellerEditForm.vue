<template id="{{ $route.params.id }}">
	<v-app id="inspire">
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
				    	<v-btn @click.prevent="submit(1)" :disabled="!valid" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">
			     		Save
			     	</v-btn>
				    </div>
				  </div>
				</div>
			</div>
			<!--breadcrumbs end-->
			<div id="basic-form" class="section">
	            <div class="row col s12">
	            	<v-alert color="success" value='true' v-if="flash.success">
			          	{{flash.success}}
			      	</v-alert>
			      	<v-alert color="error" value='true' v-if="flash.error">
			          	{{flash.error}}
			      	</v-alert>
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
										      		<v-text-field label="Owner" v-model="config.config_owner"/></v-text-field>
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
										      		<v-select label="Country" v-model="config.config_country_id" :items="countryItem" required autocomplete @change="loadProvince"></v-select>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-select label="Province" v-model="resellerInfo.province" :items="provinceItem" autocomplete required></v-select>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-select label="City" :items="cityItem" v-model="resellerInfo.city" required></v-select>
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
				                    	<div class="row">
				                    		<h4 class="header">
					                    	<center> Upload Image </center>
					                    	</h4>
							                    		
					                    	<div>
												<input type="file" id="fileInput"  style="display:none" ref="fileInput" accept="image/*" @change="onFilePicked">
												<v-layout align-center justify-center >
													<label for="fileInput" style="width: auto;min-width:200px;max-width:500px;min-height:200px;height:auto;max-height: 300px;" >
														
															<v-card style="height: auto;max-height: 200px;padding: 10px;" v-if="resellerInfo.image" @click="onPickFile">
																<v-badge color="red" overlap v-if="resellerInfo.image">
																	<v-btn  style="border-radius: 0px; margin-right: -20px; margin-top: -15px; height: 25px; width:50px; position: absolute; cursor: pointer; position: relative; opacity: 0.7; font-size: 8px;" @click="clearImage">
																		Remove
																	</v-btn>
																</v-badge>

																<v-layout align-center justify-center>
																	<img :src="resellerInfo.image" style="height:auto;max-height:200px;width: auto;margin-right:-110px;margin-top:-10px;"  @click="onPickFile">
																</v-layout>
															</v-card>
															
															<v-flex style="height: 200px;" v-if="!resellerInfo.image" @click="onPickFile">
																<v-layout align-center justify-center >
																	<img class="image-dummy" width="200px" :src="'/images/icon/Antu_folder-camera.svg.png'">
																</v-layout>
															</v-flex>

													</label>
												</v-layout>
											</div>
						                </div>
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
										      		<v-text-field label="Password" type="password" v-model="resellerInfo.password"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Confirm Password" type="password" v-model="confirmPassword"/></v-text-field>
										      		<span v-if="error" style="color:#ff3300">Password did not matched</span>
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
										      		<v-text-field label="Store Name" v-model="config.config_name"/></v-text-field>
										      	</v-flex>
										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Currency" v-model="config.config_currency"/></v-text-field>
										      	</v-flex>
										    	<!-- <v-flex xs6 sm6 md6>
										      		<v-text-field label="Display Price With Tax"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field label="Use Store Tax Address"/></v-text-field>
										      	</v-flex>

										      	<v-flex xs6 sm6 md6>
										      		<v-text-field v-model="config.config_tax_customer" label="Use Customer Tax Address"/></v-text-field>
										      	</v-flex> -->

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
				config:{
					
				},
				resellerInfo:
				{
					username:'',
					firstname: '',
					lastname: '',
					email:'',
					email_2:'',
					company:'',
					website:'',
					image:'',
					code:'',
					city:'',
					telephone_1:'',
					telephone_2:'',
					address_1:'',
					address_2:'',
					user_group_id:5,
					password:''
				},
				storeInfo:{

				},
				selects:{
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					userGroupItems:[]
				},
			    error:false,
			    confirmPassword:'',
		    	message:[],
			    select: null,
			    items: [],
			    cid:1,
			    selectGroup:null,
			    groups:[],
			    countryItem:[],
			    provinceItem:[],
			    cityItem:[
			    	{text:'Phnom Penh',value:1},
			    	{text:'Steung Sen',value:2}
			    ],
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
			this.getUserGroup()
			this.getSelectList(this.cid)
			this.fetchData(this.id)
			// this.config.config_url=this.resellerInfo.website;
			// this.config.config_email=this.resellerInfo.email;
			// this.storeInfo.name=this.config.config_name;
			// this.storeInfo.url=this.resellerInfo.website;
		},
		watch:{
			confirmPassword:function(){
				this.checkPasswordConfirmed()
			},
			resellerInfo:{
				handler:function(v,ov){
					var vm=this
					vm.config.config_url=v.website;
					vm.config.config_email=v.email;
					vm.storeInfo.url=v.website;
				},deep:true
			},
			config:{
				handler:function(v,ov){
					var vm=this
					vm.storeInfo.name=v.config_name;
				},deep:true
			}
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
			loadProvince(cid){
				axios.get('/api/getSelectList/'+cid).then(res=>{
					this.provinceItem=res.data.zones
				})
			},
			getSelectList(cid){
				axios.get('/api/getSelectList/'+cid).then(res=>{
					this.countryItem=res.data.countryies
					this.provinceItem=res.data.zones
				})
			},
		    checkPasswordConfirmed(){
	    		if(this.resellerInfo.password===this.confirmPassword){
		        	this.error=false
		        	this.valid=true
		        }else{
		        	if(this.confirmPassword===""){
		        		this.error=true
		        		this.valid=false
		        	}else{
		        		this.error=true
		        		this.valid=false
		        	}
		        }
		        return this.error
		    },
			fetchData(id){
				axios.get(this.url+id+'/edit').then((res)=>{
					this.resellerInfo=res.data.resellerInfo.original
					this.config=res.data.configItem
					console.log(res.data.configItem.config_url)
					this.storeInfo.url=res.data.configItem.config_url
				})
			},
		    submit (opt) {
		    	debugger;
		      	if (this.$refs.form.validate()) {
			        // Native form submission is not yet supporte
		        	axios.put(this.url+this.id,
			          {
			          	user:this.resellerInfo,
			          	config:this.config,
			          	storeInfo:this.storeInfo
			          }
			        ).then((res)=>{
			        	debugger;
			        	console.log(res.data)
			        	if(res.data.success==true){
			        		Flash.setSuccess(res.data.message)
			        	}else{
			        		Flash.setError(res.data.message)
			        	}
			        })
			        .catch((err) => {
                      	if(err.response.status === 422) {
                          	this.error = err.response.message
						}
						Flash.setError('Error while saving data')
                  	})
		      	}
		    },
		    onPickFile() {
				

		    	this.btnImageDisabled=true
		    	this.btnText="Uploading..."
		        
		    },
		    onFilePicked(event){
		    	
		    	
		    	const files=event.target.files
		    	let filename=files[0].name;
		    	if(filename.lastIndexOf('.')<=0){
		    		return alert('Please add a valid file!')
		    	}
		    	const fileReader=new FileReader()
		    	fileReader.addEventListener('load',()=>{
		    		
		    		//this.imageUrl=fileReader.result
					this.btnImageDisabled=false
		    		this.btnText="Upload Image"
		    		this.resellerInfo.image=fileReader.result

		    	
		    	})
		    	fileReader.readAsDataURL(files[0])
		    	
		    },
		    clearImage(){
		    	//this.imageUrl=''
		    	this.resellerInfo.image=''
		    	this.$refs.fileInput=''
		    },
		}
	}
</script>
<style type="text/css">
	.image-dummy{
		opacity: 0.5;
		transition: all 0.5s ease;
		-webkit-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
	}
	.image-dummy:hover{
		opacity: 0.8;
		cursor: pointer;
	}
</style>