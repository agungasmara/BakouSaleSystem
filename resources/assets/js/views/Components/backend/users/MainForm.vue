<template>
<v-app id="inspire">
	<breadcrumb v-bind:breadcrumb-item="items"></breadcrumb>
		<div class="flash flash__success" v-if="flash.success">
			<v-alert color="success" icon="check_circle" value="true">
            	{{flash.success}}
            </v-alert>
      	</div>
		<v-form v-model="valid" ref="formUser" lazy-validation>
	    	<v-container grid-list-md>
	  			<v-layout wrap>

			    	<v-flex xs12 sm6 md6>
			      		<v-text-field label="Username" v-model="username" :rules="usernameRules" :counter="16" required></v-text-field>
			      		<small v-show="isCheckingUsername" style="color:green">
			      			{{ checkUserMessage }}
			      		</small>
			      		<small v-show="validUsername" style="color:blue">
			      			{{ checkUserMessage }}
			      		</small>
			      		<div class="input-group__details" v-show="errorUsername">
							<div class="input-group__messages">
								<small :class="errorUsername ? 'input-group__error slide-y-transition-enter-to error--text':'input-group__error slide-y-transition-enter-to'">
									{{ checkUserMessage }}
								</small>
							</div>
						</div> 
			      	</v-flex>

			    	<v-flex xs12 sm6 md6>
			      		<v-select label="Select Group" v-model="selectGroup" :items="groups" :rules="[v => !!v || 'Group is required']" required></v-select>
			      	</v-flex>
			      	<v-flex xs12 sm6 md6>
			      		<v-text-field label="First Name" v-model="fname" :rules="fnameRules" :counter="16" required></v-text-field>
			      	</v-flex>
			      	<v-flex xs12 sm6 md6>
			      		<v-text-field label="Last Name" v-model="lname" :rules="lnameRules" :counter="16" required></v-text-field>
			      	</v-flex>
			      	<v-flex xs12 sm3 md3>
						<v-text-field label="Password" v-model="password" name="password" :rules="passwordRules" :counter="10" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-text-field  label="Confirm Password" v-model="confirmPassword" name="confirmpassword" :rules="confirmPasswordRules" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
						<div class="input-group__details" v-show="errorPassword">
							<div class="input-group__messages">
								<div :class="errorPassword ? 'input-group__error slide-y-transition-enter-to error--text':'input-group__error slide-y-transition-enter-to'">
									Confirm Password does not matched
								</div>
							</div>
						</div> 
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-text-field label="Code" v-model="code" :rules="codeRules" :counter="8" required></v-text-field>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Status" v-model="selectStatus" :items="status" :rules="[v => !!v || 'Status is required']" required></v-select>
					</v-flex>
					<v-flex xs12 sm6 md6>
			      		<v-text-field label="Email*" ref="email" v-model="email" :rules="emailRules" :counter="16" required></v-text-field>
			      		<small v-show="isCheckingEmail" style="color:green">
			      			{{ checkEmailMessage }}
			      		</small>
			      		<small v-show="validEmail" style="color:blue">
			      			{{ checkEmailMessage }}
			      		</small>
			      		<div class="input-group__details" v-show="errorEmail">
							<div class="input-group__messages">
								<small :class="errorEmail ? 'input-group__error slide-y-transition-enter-to error--text':'input-group__error slide-y-transition-enter-to'">
									{{ checkEmailMessage }}
								</small>
							</div>
						</div> 
			      	</v-flex>
					<v-flex xs12 sm6 md6>

						<input type="file"  style="display:none" ref="fileInput" accept="image/*" @change="onFilePicked">
						<v-layout align-center justify-center >
						<v-badge color="indigo" v-if="imageUrl">
							<span slot="badge" style="cursor:pointer;" @click="clearImage">
								x
							</span>
							<img  :src="imageUrl" style="width:auto; max-width:300px;" @click="onPickFile">
						</v-badge>
							<div v-if="!imageUrl" style="width:90%;height:100px; cursor:pointer;">
								<v-alert outline color="info" :value="true" @click="onPickFile">{{ btnText }}
								</v-alert>
							</div>
						</v-layout>
					</v-flex>
			      	<v-btn @click="saveUser(1)" :disabled="!valid" color="primary">
				        Save
				    </v-btn>
				    <v-btn @click="saveUser(2)" :disabled="!valid" color="primary">
				        Save & Close
				    </v-btn>
				    <router-link to="/admin/user/list">
					    <v-btn color="red" dark>
					        Cancele
					    </v-btn>
				    </router-link>
			    </v-layout>
			</v-container>
	    </v-form>
</v-app>
</template>
	
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import breadcrumb from '../commons/breadcrumb/breadcrumb.vue'
	export default{
		data(){
			return {
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    fname: 'dga',
			    fnameRules: [
			      (v) => !!v || 'First Name is required',
			      (v) => v && v.length <= 10 || 'First Name must be less than 10 characters'
			    ],

			    lname: 'dga',
			    lnameRules: [
			      (v) => !!v || 'Last Name is required',
			      (v) => v && v.length <= 10 || 'Last Name must be less than 10 characters'
			    ],
			    username: '',
			    usernameRules: [
			      (v) => !!v || 'Username is required',
			      (v) => v && v.length <= 16 || 'Username must be less than 16 characters'
			    ],
			    password:'123',
			    passwordRules: [
			      (v) => !!v || 'Password is required',
			      (v) => v && v.length <= 32 || 'Password must be less than 32 characters'
			    ],

			    confirmPassword:'123',
			    confirmPasswordRules: [
			      (v) => !!v || 'Confirm Password is required',
			      (v) => v && v.length <= 32 || 'Confirm Password must be less than 32 characters'
			    ],
			    email:'',
			    emailRules: [
			      (v) => !!v || 'E-mail is required',
			      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
			    ],
			    code: '',
			    codeRules: [
			      (v) => !!v || 'Code is required',
			      (v) => v && v.length <= 8 || 'Code must be less than 8 characters'
			    ],
			    selectStatus:1,
			    status:[
			    	{text:'Active',value:1},
			    	{text:'Inactive',value:2}
			    ],
		    	errorUsername:false,
		    	checkUserMessage:'',
		    	errorPassword:false,
		    	validUsername:false,
		    	isCheckingUsername:false,
		    	errorEmail:false,
		    	checkEmailMessage:'',
		    	validEmail:false,
		    	isCheckingEmail:false,
		    	message:[],
			    select: null,
			    users: [],
			    selectGroup:null,
			    groups:[],
				flash:Flash.state,
				items: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ]
			}
		},
		components:{'breadcrumb':breadcrumb},
		created(){
			this.getUserGroup()
		},
		watch:{
			confirmPassword:function(){
				this.checkPasswordConfirmed()
			},
			password:function(){
				this.checkPasswordConfirmed()
			},
			username:function(){
				if(this.username!==""){
					this.isCheckingUsername=true
					this.errorUsername=false
					this.validUsername=false
					this.checkUserMessage='Checking Username...'
					axios.get('/api/user/checkUser/'+this.username).then((res)=>{
						if(res.data.usernameExist==true){
							this.valid=false
							this.errorUsername=true
							this.isCheckingUsername=false
							this.validUsername=false
							this.checkUserMessage='Username already exist'
							
						}else if(res.data.usernameExist==false){
							this.valid=true
							this.isCheckingUsername=false
							this.errorUsername=false
							this.validUsername=true
							
							this.checkUserMessage='Username can use'
						}else{
							this.isCheckingUsername=false
							this.errorUsername=false
							this.validUsername=false
						}
					})
				}else if(this.username==""){
					this.errorUsername=false
					this.isCheckingUsername=false
					this.validUsername=false
				}
			},
			email:function(){
				if(this.$refs.email.validate()){
					if(this.email!==""){
						this.isCheckingEmail=true
						this.errorEmail=false
						this.validEmail=false
						this.checkEmailMessage='Email Username...'
						axios.get('/api/user/checkEmail/'+this.email).then((res)=>{
							if(res.data.emailExist==true){
								this.valid=false
								this.errorEmail=true
								this.isCheckingEmail=false
								this.validEmail=false
								this.checkEmailMessage='Email already exist'
								
							}else if(res.data.emailExist==false){
								this.valid=true
								this.isCheckingEmail=false
								this.errorEmail=false
								this.validEmail=true
								
								this.checkEmailMessage='Email can use'
							}else{
								this.isCheckingEmail=false
								this.errorEmail=false
								this.validEmail=false
							}
						})
					}else if(this.email==""){
						this.errorEmail=false
						this.isCheckingEmail=false
						this.validEmail=false
					}
				}else{
					this.valid=true
					this.isCheckingEmail=false
					this.errorEmail=false
					this.validEmail=false
				}
			}
		},
		methods:{
			getUserGroup(){
				axios.get('/api/getUsers').then((res)=>{
					this.users=res.data.users
					this.groups=res.data.groups
				})
			},
			saveUser (opt) {
		      	if (this.$refs.formUser.validate()) {
			      	if(this.checkPasswordConfirmed()===false){
				        // Native form submission is not yet supported
				        axios.post('/api/user/save', {
				          username: this.username,
				          fname: this.fname,
				          lname: this.lname,
				          userGroup: this.selectGroup,
				          email:this.email,
				          userImage:this.imageUrl,
				          password:this.password,
				          code:this.code,
				          status:this.selectStatus
				        }).then((res)=>{
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		if(opt==1){                            
				        			this.$refs.formUser.reset()
				        		}
				        		else if(opt==2){
				        			this.$router.push('/admin/user/list')
				        		}
				        	}
				        	/*console.log(res.data)*/
				        })
				    }
		      	}
		    },
		    checkPasswordConfirmed(){
	    		if(this.password===this.confirmPassword){
		        	this.errorPassword=false
		        }else{
		        	if(this.confirmPassword===""){
		        		this.errorPassword=false
		        	}else{
		        		this.errorPassword=true
		        	}
		        }
		        return this.errorPassword
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