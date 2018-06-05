<template id="{{ $route.params.id }}">
	<section id="content">
		<!--breadcrumbs start-->
		<div id="breadcrumbs-wrapper">
			<!-- Search for small screen -->
			<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
			  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
			</div>
			<div class="container">
			  <div class="row">
			    <div class="col s10 m6 l6">
			      <h5 class="breadcrumbs-title">Forms</h5>
			      <!-- <ol class="breadcrumbs">
			        <li><a href="index.html">Dashboard</a>
			        </li>
			        <li><a href="#">Forms</a>
			        </li>
			        <li class="active">Forms Layouts</li>
			      </ol> -->
			      	<v-breadcrumbs>
			        	<v-icon slot="divider">/</v-icon>
		        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
		          			{{ item.text }}
		        		</v-breadcrumbs-item>
		      		</v-breadcrumbs>
			    </div>
			    <div class="col s2 m6 l6">
			      	<router-link to="/admin/attributes/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Cancel</v-btn></router-link>

			     	<v-btn @click="submit(id,1)" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Update</v-btn>
			    </div>
			  </div>
			</div>
		</div>
		<!--breadcrumbs end-->
		<div id="basic-form" class="section">
			<div class="container">
				<v-app id="inspire">
					<v-card>

						<!-- <v-card-title>	
							<v-breadcrumbs>
					        	<v-icon slot="divider">forward</v-icon>
				        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
				          			{{ item.text }}
				        		</v-breadcrumbs-item>
					      	</v-breadcrumbs>
						</v-card-title> -->
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

							      	<!-- <v-btn @click="submit(id,1)" :disabled="!valid">
								        Update
								    </v-btn>
								    <v-btn @click="submit(id,2)" :disabled="!valid">
								        Update & Close
								    </v-btn>
								    <router-link to="/admin/settings/list"><v-btn>
								        Cancele
								    </v-btn>
								    </router-link> -->
							    </v-layout>
							</v-container>
					    </v-form>
					</v-card>
				</v-app>
			</div>
		</div>
	</section>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'

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
			    breadcrumbs: [
			        {
			          text: 'Dashboard',
			          disabled: false
			        },
			        {
			          text: 'Attributes',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
		      	],
				flash:Flash.state
			}
		},
		created(){
			this.fetchSetting(this.id)
			this.getStore()
		},
		methods:{
			getStore(){
				axios.get('/admin/api/getStore').then((res)=>{
					this.items=res.data
				})
			},
			fetchSetting(id){
				axios.get('/admin/api/setting/getsettingbyid/'+id).then(res=>{
					this.code=res.data.code
					this.key=res.data.key
					this.value=res.data.value
					this.select=res.data.store_id
				});
			},
			submit (id,opt) {
				debugger;
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.put('/admin/api/setting/update/'+id, {
		          store: this.select,
		          code: this.code,
		          key: this.key,
		          value: this.value
		        }).then((res)=>{
		        	debugger;
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