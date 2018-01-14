<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<v-card>

			<!--breadcrumbs start-->
				<breadcrumb3btn
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:breadcrumb-title="breadcrumbTitle"
				v-bind:submit="submit"
				v-bind:is-valid="valid"
				v-bind:back-url="backUrl"
				></breadcrumb3btn>
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
				      		<v-select label="Select Store" v-model="select"  :items="items"  :rules="[v => !!v || 'Item is required']" required></v-select>
				      	</v-flex>

				    	<v-flex xs12 sm6 md6>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules" :counter="100" required></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm6 md6>
				      		<v-text-field label="Key" v-model="key" :rules="keyRules" :counter="100" required></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm6 md6>
				      		<v-text-field label="Value" v-model="value" :rules="valueRules" :counter="100" required></v-text-field>
				      	</v-flex>

				      	<v-btn @click="submit(id,1)" :disabled="!valid">
					        Update
					    </v-btn>
					    <v-btn @click="submit(id,2)" :disabled="!valid">
					        Update & Close
					    </v-btn>
					    <router-link to="/admin/settings/list"><v-btn>
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
	import breadcrumb3btn from '../commons/breadcrumb/breadcrumb3btn.vue'
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
			    select: 0,
			    items: [],
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
				flash:Flash.state
			}
		},
		components:{
			'breadcrumb3btn':breadcrumb3btn
		},
		created(){
			this.fetchUserGroup(this.id)
		},
		methods:{
			fetchUserGroup(id){
				axios.get('/api/users_group/getuser_groupbyid/'+id).then(res=>{
					this.code=res.data.code
					this.key=res.data.key
					this.value=res.data.value
					this.select=res.data.store_id
				});
			},
			submit (opt) {
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.put('/api/users_group/update/'+this.id, {
		          store: this.select,
		          code: this.code,
		          key: this.key,
		          value: this.value
		        }).then((res)=>{
		        	if(res.data.success==true){
		        		Flash.setSuccess(res.data.message)
		        		if(opt==2){
		        			this.$router.push('/admin/users_group/list')
		        		}
		        	}
		        })
		      }
		    }
		}
	}
</script>