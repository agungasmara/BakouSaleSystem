<template>
	<v-app id="inspire">

		<v-card>
			<!--breadcrumbs start-->
				<breadcrumb3button
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:breadcrumb-title="breadcrumbTitle"
				v-bind:submit="submit"
				v-bind:is-valid="valid"
				v-bind:back-url="backUrl"
				></breadcrumb3button>
			<!--breadcrumbs end-->
			<div class="flash flash__success" v-if="flash.success">
				<v-alert color="success" icon="check_circle" value="true">
	            	{{flash.success}}
	            </v-alert>
          	</div>
			<v-form v-model="valid" ref="formUserGroup" lazy-validation>
		    	<v-container grid-list-md>
		  			<v-layout wrap>

				    	<v-flex xs12 sm6 md6>
				      		<v-text-field label="Group Name" v-model="groupName" ref="groupName" :rules="groupNameRules" :counter="16" required></v-text-field>
				      		<small v-show="isCheckingName" style="color:green">
				      			{{ checkNameMessage }}
				      		</small>
				      		<small v-show="validName" style="color:blue">
				      			{{ checkNameMessage }}
				      		</small>
				      		<div class="input-group__details" v-show="errorName">
								<div class="input-group__messages">
									<small :class="errorName ? 'input-group__error slide-y-transition-enter-to error--text':'input-group__error slide-y-transition-enter-to'">
										{{ checkNameMessage }}
									</small>
								</div>
							</div> 
				      	</v-flex>
				      	<v-flex xs12 sm6 md6>
				      		<v-text-field label="Group Type" v-model="groupType" :rules="groupTypeRules" :counter="100" required></v-text-field>
				      	</v-flex>
				      	<v-flex xs12 sm12 md12>
				      		<v-select label="Sermissions" autocomplete :loading="loading" multiple cache-items chips required :items="states" :rules="[() => permissions.length > 0 || 'You must choose at least one']" :search-input.sync="search" v-model="permissions"></v-select>
				      	</v-flex>
				    </v-layout>
				</v-container>
		    </v-form>
   	</v-card>
</v-app>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import breadcrumb3button from '../commons/breadcrumb/breadcrumb3button.vue'
	export default{
		data(){
			return{
				valid:true,
			    loading: false,
		      	search: null,
      			states: ['Product Attribute','Product Price'],
			    groupName: '',
			    groupNameRules: [
			      (v) => !!v || 'Group Name is required',
			      (v) => v && v.length <= 16 || 'Group Name must be less than 16 characters'
			    ],
			    groupType: '',
			    groupTypeRules: [
			      (v) => !!v || 'Group Type is required',
			      (v) => v && v.length <= 100 || 'Group Type must be less than 100 characters'
			    ],
			    permissions: [],
			    breadcrumbTitle:'Users',
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
		      	backUrl:'/admin/users_group/list',
		      	errorName:false,
		    	checkNameMessage:'',
		    	validName:false,
		    	isCheckingName:false,
				flash:Flash.state
			}
		},
		components:{
			'breadcrumb3button':breadcrumb3button
		},
		watch: {
			search (val) {
			  val && this.querySelections(val)
			},
			groupName(){
				if(this.$refs.groupName.validate()){
					if(this.groupName!==""){
						this.isCheckingName=true
						this.errorName=false
						this.validName=false
						this.checkNameMessage='Checking Group Name...'
						axios.get('/api/users_group/checkIfExisted/name/'+this.groupName).then((res)=>{
							if(res.data.Existed==true){
								this.valid=false
								this.errorName=true
								this.isCheckingName=false
								this.validName=false
								this.checkNameMessage='Group Name already exist'
								
							}else if(res.data.Existed==false){
								this.valid=true
								this.isCheckingName=false
								this.errorName=false
								this.validName=true
								
								this.checkNameMessage='Group Name can use'
							}else{
								this.isCheckingName=false
								this.errorName=false
								this.validName=false
							}
						})
					}else if(this.groupName==""){
						this.errorName=false
						this.isCheckingName=false
						this.validName=false
					}
				}else{
					this.valid=true
					this.isCheckingName=false
					this.errorName=false
					this.validName=false
				}
			}
		},
		methods:{
			submit (opt) {
		      	if (this.$refs.formUserGroup.validate()) {
			        // Native form submission is not yet supported
			        axios.post('/api/users_group/save', {
			          groupName: this.groupName,
			          groupType: this.groupType,
			          permissions: '{"access":["'+this.permissions.join('","')+'"]}'
			        }).then((res)=>{
			        	if(res.data.success==true){
			        		Flash.setSuccess(res.data.message)
			        		if(opt==1){
			        			this.$refs.formUserGroup.reset()
			        		}
			        		else if(opt==2){
			        			this.$router.push('/admin/users_group/list')
			        		}
			        	}
			        	console.log(res.data)
			        })
		      	}
		    },
		    querySelections (v) {
				this.loading = true
					// Simulated ajax query
					setTimeout(() => {
					this.items = this.states.filter(e => {
					return (e || '').toLowerCase().indexOf((v || '').toLowerCase()) > -1
				})
					this.loading = false
				}, 500)
		    }
		}
	}
</script>