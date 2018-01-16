<template>
<v-app id="inspire">
	<v-card>

		<v-card-title>	
			<v-breadcrumbs>
	        	<v-icon slot="divider">forward</v-icon>
	        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
	          			{{ item.text }}
	        		</v-breadcrumbs-item>
	      	</v-breadcrumbs>
		</v-card-title>
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
						<div class="input-group__details" v-show="error">
							<div class="input-group__messages">
								<div :class="error ? 'input-group__error slide-y-transition-enter-to error--text':'input-group__error slide-y-transition-enter-to'">
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
			      		<v-text-field label="Email*" v-model="email" :rules="emailRules" :counter="16" required></v-text-field>
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
			      	<v-btn @click="saveUser(id,1)" :disabled="!valid">
				        Update
				    </v-btn>
				    <v-btn @click="saveUser(id,2)" :disabled="!valid">
				        Update & Close
				    </v-btn>
				    <router-link to="/admin/user/list">
					    <v-btn>
					        Cancele
					    </v-btn>
				    </router-link>
			    </v-layout>
			</v-container>
	    </v-form>
	</v-card>
</v-app>
</template>
	
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		props:['id'],
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
			    error:false,
		    	message:[],
			    select: null,
			    items: [],
			    selectGroup:null,
			    groups:[],
				breadcrumbs: [
			        {
			          text: 'Adminstrator',
			          disabled: false
			        },
			        {
			          text: 'Setting',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
		      	],
				flash:Flash.state
			}
		},
		created(){
			this.getUserGroup()
			this.fetchUser(this.id)
		},
		methods:{
			getUserGroup(){
				axios.get('/api/getUsers').then((res)=>{
					this.items=res.data.users
					this.groups=res.data.groups
				})
			},
			fetchUser(id){
				axios.get('/api/users/getuserbyid/'+id).then((res)=>{
					this.selectGroup=res.data.group
					this.username=res.data.username
					this.fname=res.data.firstname
					this.lname=res.data.lastname
					this.email=res.data.email
					this.code=res.data.code
					this.imageUrl=res.data.image
					this.selectStatus=res.data.status
				})
			},
			saveUser (id,opt) {
		      	if (this.$refs.formUser.validate()) {
			      	if(this.checkPasswordConfirmed()===false){
				        // Native form submission is not yet supported
				        axios.put('/api/users/update/'+id, {
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
				        		if(opt==2){
				        			this.$router.push('/admin/users/list')
				        		}
				        	}
				        	/*console.log(res.data)*/
				        })
				    }
		      	}
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