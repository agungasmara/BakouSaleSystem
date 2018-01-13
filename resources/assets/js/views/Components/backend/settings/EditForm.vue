<template id="{{ $route.params.id }}">
	<section id="content">
		
		<div>
			
			<v-app id="inspire">
				<!--breadcrumbs start-->
					<breadcrumb v-bind:breadcrumb-item="items"></breadcrumb>
				<!--breadcrumbs end-->
					<div class="flash flash__success" v-if="flash.success">
						<v-alert color="success" icon="check_circle" value="true">
			            	{{flash.success}}
			            </v-alert>
		          	</div>
				    <v-form v-model="valid" ref="form" lazy-validation>
				    	<v-container grid-list-md>
	              			<v-layout wrap>
						    	<v-flex xs12 sm6 md6>
						      		<v-select label="Select Store" v-model="select"  :items="stores"  :rules="[v => !!v || 'Item is required']" required></v-select>
						      	</v-flex>

						    	<v-flex xs12 sm6 md6>
						      		<v-select label="Select Code" v-model="code"  :items="settingCode.text" ></v-select>
						      	</v-flex>

						      	<v-flex xs12 sm6 md6>
						      		<v-select label="Select Key" v-model="key"  :items="settingKey.text" ></v-select>
						      	</v-flex>

						      	<v-flex xs12 sm6 md6>
						      		<v-select label="Select Value" v-model="value"  :items="settingValue.text" ></v-select>
						      	</v-flex>

						      	<v-btn @click="submit(id,1)" :disabled="!valid" color="green">
							        Update
							    </v-btn>
							    <v-btn @click="submit(id,2)" :disabled="!valid" color="green">
							        Update & Close
							    </v-btn>
							    <router-link to="/admin/settings/list">
								    <v-btn color="red" dark>
								        Cancele
								    </v-btn>
							    </router-link>
						    </v-layout>
						</v-container>
				    </v-form>
			</v-app>
		</div>
	</section>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'

	import breadcrumb from '../commons/breadcrumb/breadcrumb.vue'

	export default{
		props:['id'],
		data(){
			return{

				valid: true,
			    code: '',
			    codeRules: [
			      (v) => !!v || 'Code is required',
			      (v) => v && v.length <= 100 || 'Code must be less than 100 characters'
			    ],
			    key: '',
			    keyRules: [
			      (v) => !!v || 'Key is required',
			      (v) => v && v.length <= 100 || 'Key must be less than 100 characters'
			    ],
			    value: '',
			    valueRules: [
			      (v) => !!v || 'Value is required',
			      (v) => v && v.length <= 100 || 'Value must be less than 100 characters'
			    ],
				settings:[],
				settingCode:[],
				settingKey: [],
				settingValue:[],
			    select: 0,
			    stores: [],
				flash:Flash.state,
				items: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Settings',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
			    ]
			}
		},
		components:{
			'breadcrumb':breadcrumb
		},
		created(){
			this.fetchSettingByID(this.id)
			this.fetchSettingItem(this.id)
			this.getStore()
		},
		methods:{
			getStore(){
				axios.get('/api/getStore').then((res)=>{
					this.stores=res.data
				})
			},
			fetchSettingByID(id){
				axios.get('/api/setting/getsettingbyid/'+id).then(res=>{
					this.code=res.data.code
					this.key=res.data.key
					this.value=res.data.value
					this.select=res.data.store_id
				});
			},
			fetchSettingItem(id){
				axios.get('/api/setting/item/'+id).then((res)=>{
					this.settingCode=res.data.code
					this.settingKey=res.data.key
					this.settingValue=res.data.value
				})
			},
			submit (id,opt) {
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.put('/api/setting/update/'+id, {
		          store: this.select,
		          code: this.code,
		          key: this.key,
		          value: this.value
		        }).then((res)=>{
		        	if(res.data.success==true){
		        		Flash.setSuccess(res.data.message)
		        		if(opt==2){
		        			this.$router.push('/admin/settings/list')
		        		}
		        	}
		        })
		      }
		    }
		}
	}
</script>