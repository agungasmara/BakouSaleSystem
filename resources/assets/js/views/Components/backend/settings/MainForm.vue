<template>
	<div>
		
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
			    <v-form v-model="valid" ref="form" lazy-validation>
			    	<v-container grid-list-md>
              			<v-layout wrap>

					    	<v-flex xs12 sm6 md6>
					      		<v-select label="Select Store" v-model="select" :items="items" :rules="[v => !!v || 'Item is required']" required></v-select>
					      	</v-flex>

					    	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Code" v-model="code" :rules="codeRules" :counter="10" required></v-text-field>
					      	</v-flex>

					      	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Key" v-model="key" :rules="keyRules" :counter="10" required></v-text-field>
					      	</v-flex>

					      	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Value" v-model="value" :rules="valueRules" :counter="10" required></v-text-field>
					      	</v-flex>

					      	<v-btn @click="submit(1)" :disabled="!valid">
						        Save & New
						    </v-btn>
						    <v-btn @click="submit(2)" :disabled="!valid">
						        Save & Close
						    </v-btn>
						    <router-link to="/admin/settings/list">
							    <v-btn>
							        Cancele
							    </v-btn>
						    </router-link>
					    </v-layout>
					</v-container>
			    </v-form>
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
				valid: true,
			    code: '',
			    codeRules: [
			      (v) => !!v || 'Code is required',
			      (v) => v && v.length <= 10 || 'Code must be less than 10 characters'
			    ],
			    key: '',
			    keyRules: [
			      (v) => !!v || 'Key is required',
			      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
			    ],
			    value: '',
			    valueRules: [
			      (v) => !!v || 'Value is required',
			      (v) => v && v.length <= 10 || 'Value must be less than 10 characters'
			    ],
			    select: null,
			    items: [],
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
			this.getStore()
		},
		methods:{
			getStore(){
				axios.get('/api/getStore').then((res)=>{
					this.items=res.data
				})
			},
			submit (opt) {
		      if (this.$refs.form.validate()) {
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
		}
	}
</script>