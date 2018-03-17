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
					                      		<div>
					                      			<div class="chip-box" :class="{'current':show=='general'}" @click="showGeneral">General</div>
					                      			<div class="chip-box" @click="addAddress">Add Address</div>
					                      			<div class="chip-box" v-for="(addr,index) in addressItem" :key="index" :class="{'current':show==index}">
											            <span @click="show = index">
											            	{{addr.addr1}}
											                
											            </span>
											            <v-icon color="red" dark right @click="removeOpt(index)" style="cursor: pointer;">remove_circle</v-icon>
													</div>
					                      		</div>
					                      		<v-flex xs12 sm12 md12 l12>
													<div v-for="(addr,index) in addressItem" :key="index">
											          	<div v-if="show==index">
												          	<v-form v-model="valid" ref="formFilter" lazy-validation>
												          		<v-layout row wrap v-for="(addField,i) in addr.form" :key="i">
												          			<v-flex xs12 sm6 md6>
												          				<v-text-field v-model="addField.firstname" label="First Name" required :rules="[(v) => !!v || 'First Name is required']">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm6 md6>
												          				<v-text-field v-model="addField.lastname" label="Last Name" required :rules="[(v) => !!v || 'Last Name is required']">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm12 md12>
												          				<v-text-field v-model="addField.company" label="Company">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm12 md12>
												          				<v-text-field v-model="addField.address_1" label="Address 1" required :rules="[(v) => !!v || 'Address 1 is required']">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm12 md12>
												          				<v-text-field v-model="addField.address_2" label="Address 2">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm6 md6>
												          				<v-text-field v-model="addField.city" label="City" required :rules="[(v) => !!v || 'City is required']">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm6 md6>
												          				<v-text-field v-model="addField.passcode" label="Passcode">
												          				</v-text-field>
												          			</v-flex>
												          			<v-flex xs12 sm6 md6>
												          				<v-select :items="countries" @change="fetchZone(addField.country_id)" v-model="addField.country_id" required :rules="[(v) => !!v || 'Country is required']" label="Country">
												          				</v-select>
												          			</v-flex>
												          			<v-flex xs12 sm6 md6>
												          				<v-select :disabled="validZone" :items="zones"  v-model="addField.zone_id" required :rules="[(v) => !!v || 'Zone is required']" label="Zone">
												          				</v-select>
												          			</v-flex>
												          		</v-layout>
												          	</v-form>
											          	</div>
											          	
										          	</div>
										          	<div v-if="show=='general'">
									          			<form-group
													
														v-bind:form-items="group[item.form]"
														v-bind:form-rules="rules"
														v-bind:form-datas="data[item.form]"
														v-bind:select-items="select"
														
														></form-group>
										          	</div>
										      	</v-flex>
												</v-container>
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
	// import normalForm from '../commons/form/normalForm.vue'
	import formGroup from '../commons/form/formGroup.vue'
	export default{
		components:{
			formGroup
		},
		data(){
			return{
				url:'/api/customers/',
				e1:true,
				valid: true,
				section:[
					{
						info_title:'Customer',
						info_description:'Setup your customer here. ',
						title:'General',
						icon:'info_outline',
						form:'general',
					},
				],
				group:{
					general:[
				    	{	class:'xs12 sm12 md12',	 key:'customer_group_id',	type:'select',	 text:'Group',items:'customergroup'	},
						{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name'	},
						{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',text:'Last Name'},
						{	class:'xs12 sm6 md6',	 key:'email',	type:'text',	 text:'Email',	},
						{	class:'xs12 sm6 md6',	 key:'telephone',	type:'text',	 text:'Telephone',	},
						{	class:'xs12 sm6 md6',	 key:'password',	type:'password',	 text:'Password',	},
						{	class:'xs12 sm6 md6',	 key:'confrimpassword',	type:'password',	 text:'Confirm Password',	},
						{	class:'xs12 sm12 md12',	 key:'newsletter',	type:'select',	 text:'Newsletter',items:'newsletterItem'	},
						{	class:'xs12 sm12 md12',	 key:'status',	type:'select',	 text:'Status',items:'statusItem'	},
						{	class:'xs12 sm12 md12',	 key:'safe',	type:'select',	 text:'Safe',items:'safeItem'	},
					],
					address:[
						{class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name'	},
					]
				},
				rules:{
					firstname: [
				      (v) => !!v || 'First Name is required'
				    ],
				    lastname:[
				      (v) => !!v || 'Last Name is required'
				    ],
				    customer_group_id:[
				      (v) => !!v || 'Group is required'
				    ],
				    email:[
				      (v) => !!v || 'Email is required'
				    ],
				    telephone:[
				      (v) => !!v || 'Telephone is required'
				    ],
				    password:[
				      (v) => !!v || 'Password is required'
				    ],
				    confrimpassword:[
				      (v) => !!v || 'Confirm Password is required'
				    ]
				},
				data:{
					general:{
						safe:1,
						newsletter:1,
						status:1
					},
				},
				select:{
					customergroup:[],
					safeItem:[{text:'Yes',value:1},{text:'No',value:0}],
					statusItem:[{text:'Enable',value:1},{text:'Disable',value:0}],
					newsletterItem:[{text:'Enable',value:1},{text:'Disable',value:0}]
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
			    back:'/admin/customers/list',
			    addressItem:[],
			    opt:'text',
				show:'general',
				a:1,
				countries:[],
				zones:[],
				validZone:false
			}
		},
		created(){
			this.getLanguage()
			this.fetchGroup()
		},
		watch:{
		},
		methods:{
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			},
			fetchGroup(){
                axios.get('/api/getSelectList/1').then(res=>{
                    this.select.customergroup=res.data.customerGroups
                    this.countries=res.data.countryies
                    this.zones=res.data.zones
                    console.log(res.data)
				})
			},
			fetchZone(cid=1){
				this.validZone=true
				axios.get('/api/getSelectList/'+cid).then(res=>{
                    this.zones=res.data.zones
                    this.validZone=false
				})
			},
			addAddress(){
				
				this.addressItem.push({
					addr1:'Address '+this.a,form:[
							{
								firstname:'',
								lastname:'',
								company:'',
								address_1:'',
								address_2:'',
								city:'',
								postcode:'',
								country_id:1,
								zone_id:'',
								custom_field:''
							}
						]
					});
				this.a=this.a+1;
			},
			showGeneral(){
				this.show='general';
			},
			removeOpt:function(index){
				var vm=this
				this.addressItem.splice(index,1)
				vm.show=index-1
				if(this.addressItem.length==0){
					vm.show='general'
				}
			}
		}
	}
</script>
<style type="text/css">
	.current{
		background-color: #b3d4fc;
	}
	table.chk-tbl{
		background-color: #FFFFFF !important;
		border-radius:2px;
		border-collapse:collapse;
		border-spacing:0;
		table-layout:fixed;
		width: 100%;
		max-width: 100%;
	}
	table.chk-tbl tr th{
		border: solid 1px #d9dbdd;
		text-align: center;
		padding: 0 3px !important;
	}
	table.chk-tbl tr.chk-row td{
		background-color: #edeff2;
	}
	table.chk-tbl tr td{
		padding: 0px !important;
	}
	table.chk-tbl tr td{
		border: solid 1px #d9dbdd;
	}
	.chip-box{
		display: inline-block;
		width: auto;
		padding: 3px 3px 3px 3px;
		border-radius: 2px;
		top: 10px !important;
		margin-bottom: 2px !important;
		margin-right: 3px !important;
		border: solid 1px #42c0ff;
		cursor: pointer;
	}
</style>