<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<!--<normal-form
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
		</v-card>-->
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
								
								<div class="container bootstrap">
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
										<div class="col s12 m12 l9">
											<div class="row">
												<h4 class="header"><i class="material-icons text-left">local_shipping</i> &nbsp; Delivery Information</h4>
												<div class="divider"></div>
												
												<div id="carrier_wizard" class="panel swMain">
													<ul class="steps nbr_steps_4 anchor">
														<li class="selected">
															<a href="#step-1" class="selected" isdone="1" rel="1">
																<span class="stepNumber">1</span>
																<span class="stepDesc">
																	General settings<br>
																							</span>
																<span class="chevron"></span>
															</a>
														</li>
														<li class="disabled">
															<a href="#step-2" class="disabled" isdone="0" rel="2">
																<span class="stepNumber">2</span>
																<span class="stepDesc">
																	Shipping locations and costs<br>
																							</span>
																<span class="chevron"></span>
															</a>
														</li>
														<li class="disabled">
															<a href="#step-3" class="disabled" isdone="0" rel="3">
																<span class="stepNumber">3</span>
																<span class="stepDesc">
																	Size, weight, and group access<br>
																							</span>
																<span class="chevron"></span>
															</a>
														</li>
														<li class="disabled">
															<a href="#step-4" class="disabled" isdone="0" rel="4">
																<span class="stepNumber">4</span>
																<span class="stepDesc">
																	Summary<br>
																							</span>
																<span class="chevron"></span>
															</a>
														</li>
													</ul>
													
													<!--content step-->
													<div class="_stepContainer" style="height: 544px;">
														<div id="_step-1" class="step_container content">
															
															<!--form##################-->
															
															<!--#End Form##############-->
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<!-- */end  -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</v-app>
</template>

<style>

.bootstrap #carrier_wizard li a.disabled {
    color: #777;
    background-color: #ccc;
}

.bootstrap #carrier_wizard li a {
    color: #ccc;
    height: 32px;
    display: block;
    position: relative;
    margin: 0 16px 0 0;
    text-decoration: none;
    outline-style: none;
}
#carrier_wizard {
    position: relative;
    padding: 20px;
    margin-bottom: 20px;
    border: solid 1px #d3d8db;
    background-color: #fff;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
.bootstrap #carrier_wizard {
    position: relative;
    display: block;
	width:100%;
}
.bootstrap #carrier_wizard li a.selected {
    color: #F8F8F8;
    cursor: text;
    background-color: #363A41;
}
.bootstrap #carrier_wizard li a.selected .chevron:after {
    border-left: 14px solid #363A41;
}
.bootstrap #carrier_wizard li a .stepDesc {
    position: relative;
    text-align: left;
    font-size: 13px;
    height: 32px;
    display: table-cell;
    vertical-align: middle;
    line-height: 13px;
}
.bootstrap #carrier_wizard li a .chevron:after {
        border: 16px solid transparent;
    border-left: 14px solid #ccc;
    border-right: 0;
    position: absolute;
    content: "";
    right: -13px;
    top: 0px;
}
.bootstrap #carrier_wizard li a {
    color: #ccc;
    height: 32px;
    display: block;
    position: relative;
    margin: 0 16px 0 0;
    text-decoration: none;
    outline-style: none;
}
.bootstrap .panel, .bootstrap #dash_version, .bootstrap .message-item-initial .message-item-initial-body, .bootstrap .timeline .timeline-item .timeline-caption .timeline-panel {
    margin-bottom: 17px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 3px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
    box-shadow: 0 1px 1px rgba(0,0,0,0.05);
}
.bootstrap * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.bootstrap #carrier_wizard ul.anchor.nbr_steps_4 li {
    width: 25%;
    float: left;
}

.bootstrap #carrier_wizard li {
    position: relative;
    display: block;
    overflow: hidden;
}
.bootstrap #carrier_wizard ul.anchor {
    position: relative;
    display: block;
    float: left;
    list-style: none;
    padding: 0;
    margin: 0 0 10px 0;
    clear: both;
    width: 100%;
}
	.bootstrap #carrier_wizard li a .stepNumber {
		position: relative;
		float: left;
		width: 24px;
		height: 32px;
		margin-right: 3px;
		text-align: center;
		padding: 0 5px;
		font-size: 30px;
		line-height: 32px;
		color: #fff;
	}
	.bootstrap * {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.bootstrap #carrier_wizard li a.selected {
		color: #F8F8F8;
		cursor: text;
		background-color: #363A41;
	}
	.bootstrap #carrier_wizard li a.selected {
		color: #F8F8F8;
		cursor: text;
		background-color: #363A41;
	}
	.bootstrap #carrier_wizard li a {
		color: #ccc;
		height: 32px;
		display: block;
		position: relative;
		margin: 0 16px 0 0;
		text-decoration: none;
		outline-style: none;
	}
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
				url:'/api/carriers/',
				group:[
					{	class:'xs12 sm6 md6',	 key:'username',	type:'text',	 text:'Username'	},
					{	class:'xs12 sm6 md6',	 key:'user_group_id',	type:'select',items:'userGroupItems',	 text:'User Group'	},
					{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name'	},
					{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',	 text:'Last Name'	},
					{	class:'xs12 sm4 md4',	 key:'email',	type:'text',	 text:'Email'	},
					{	class:'xs12 sm4 md4',	 key:'code',	type:'text',	 text:'Code'	},
					{	class:'xs12 sm4 md4',	 key:'status',	type:'select',items:'statusItems',	 text:'Status'	},
					{	class:'xs12 sm12 md12',	 key:'image',	type:'image',	 Value:'Photo'	}
					
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
			    breadcrumbTitle:'Edit Carriers',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Carriers',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/carrier/list',
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