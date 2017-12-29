<template>
	<div>
		
		<v-app id="inspire">
			<v-card flat>
				
				<div class="flash flash__success" v-if="flash.success">
					<v-alert color="success" icon="check_circle" value="true">
		            	{{flash.success}}
		            </v-alert>
	          	</div>
				<v-tabs v-model="active">
			        <v-tabs-bar class="cyan" dark>
			          	<v-tabs-item v-for="tab in tabs" :key="tab" :href="'#' + tab" ripple>
			            	 {{ tab }}
			          	</v-tabs-item>
			          	<v-tabs-slider color="yellow"></v-tabs-slider>
			        </v-tabs-bar>
			        <v-tabs-items>
			          	<v-tabs-content id="create-user">
			            	<v-card flat>
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
									      	


									      	<v-flex xs12 sm6 md6>
												<v-text-field label="Password" v-model="password" name="password" :rules="passwordRules" :counter="10" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
											</v-flex>
											<v-flex xs12 sm6 md6>
												<v-text-field  label="Confirm Password" v-model="confirmPassword" name="confirmpassword" :rules="confirmPasswordRules" required :append-icon="e1 ? 'visibility' : 'visibility_off'" :append-icon-cb="() => (e1 = !e1)" :type="e1 ? 'password' : 'text'"></v-text-field>
												<div class="input-group__details" v-show="error">
													<div class="input-group__messages">
														<div :class="error ? 'input-group__error slide-y-transition-enter-to error--text':'input-group__error slide-y-transition-enter-to'">
															Confirm Password does not matched
														</div>
													</div>
												</div> 
											</v-flex>

									      	<v-btn @click="saveUser(1)" :disabled="!valid">
										        Save & New
										    </v-btn>
										    <v-btn @click="saveUser(2)" :disabled="!valid">
										        Save & Close
										    </v-btn>
										    <router-link to="/admin/users/list">
											    <v-btn>
											        Cancele
											    </v-btn>
										    </router-link>
									    </v-layout>
									</v-container>
							    </v-form>
							</v-card>
			        	</v-tabs-content>
			        	<v-tabs-content id='create-user-group''>
			          		<v-form v-model="valid" ref="formUserGroup" lazy-validation>
							    	<v-container grid-list-md>
				              			<v-layout wrap>

									    	<v-flex xs12 sm4 md4>
									      		<v-text-field label="Group Name" v-model="groupName" :rules="groupNameRules" :counter="16" required></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm4 md4>
									      		<v-text-field label="Group Type" v-model="groupType" :rules="groupTypeRules" :counter="3" required></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm12 md12>
									      		<v-checkbox label="Product Variance" v-model="checkbox" :rules="[v => !!v || 'At least one permission selected!']" required></v-checkbox>
									      	</v-flex>

									      	<v-btn @click="saveUserGroup(1)" :disabled="!valid">
										        Save & New
										    </v-btn>
										    <v-btn @click="saveUserGroup(2)" :disabled="!valid">
										        Save & Close
										    </v-btn>
										    <router-link to="/admin/users_group/list">
											    <v-btn>
											        Cancele
											    </v-btn>
										    </router-link>
									    </v-layout>
									</v-container>
							    </v-form>
			        	</v-tabs-content>
			        </v-tabs-items>
			    </v-tabs>
			    <div class="text-xs-center mt-3">
			        <v-btn @click.native="next">next tab</v-btn>
			    </div>
			</v-card>
		</v-app>
	</div>
</template>
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		data(){
			return{
				tabs: ['create-user','create-user-group', 'assign-user-group'],
      active: null,
      text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				e1:true,
				valid: true,
			    code: '',
			    codeRules: [
			      (v) => !!v || 'Code is required',
			      (v) => v && v.length <= 32 || 'Code must be less than 32 characters'
			    ],
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
			    groupName: '',
			    groupNameRules: [
			      (v) => !!v || 'Group Name is required',
			      (v) => v && v.length <= 16 || 'Group Name must be less than 16 characters'
			    ],
			    groupType: '',
			    groupTypeRules: [
			      (v) => !!v || 'Group Type is required',
			      (v) => v && v.length <= 3 || 'Group Type must be less than 3 characters'
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
			          text: 'User',
			          disabled: true
			        }
		      	],
				flash:Flash.state
			}
		},
		created(){
			this.getUser()
		},
		watch:{
	  		confirmPassword:function(){
	  			this.checkPasswordConfirmed()
	  		}
	  	},
		methods:{
			getUser(){
				axios.get('/api/getUsers').then((res)=>{
					this.items=res.data.users
					this.groups=res.data.groups
				})
			},
			saveUser (opt) {
		      	if (this.$refs.formUser.validate()) {
			      	if(this.checkPasswordConfirmed()===false){
				        // Native form submission is not yet supported
				        axios.post('/api/setting/save', {
				          store: this.select,
				          code: this.code,
				          key: this.key,
				          value: this.value
				        }).then((res)=>{
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		if(opt==1){
				        			this.select=""
							        this.code=""
							        this.key=""
							        this.value=""
				        		}
				        		else if(opt==2){
				        			this.$router.push('/admin/settings/list')
				        		}
				        	}
				        })
				    }
		      	}
		    },
		    saveUserGroup (opt) {
		      	if (this.$refs.formUserGroup.validate()) {
			        // Native form submission is not yet supported
			        /*axios.post('/api/setting/save', {
			          store: this.select,
			          code: this.code,
			          key: this.key,
			          value: this.value
			        }).then((res)=>{
			        	if(res.data.success==true){
			        		Flash.setSuccess(res.data.message)
			        		if(opt==1){
			        			this.select=""
						        this.code=""
						        this.key=""
						        this.value=""
			        		}
			        		else if(opt==2){
			        			this.$router.push('/admin/settings/list')
			        		}
			        	}
			        })*/
			        alert(1)
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
		    next () {
			    this.active = this.tabs[(this.tabs.indexOf(this.active) + 1) % this.tabs.length]
			}
		}
	}
</script>