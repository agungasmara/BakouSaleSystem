<template>
	<section id="content">

		<v-app id="inspire">
			<v-card>

				<v-card-title>	
					<!--breadcrumbs start-->
						<breadcrumb v-bind:breadcrumb-item="items"></breadcrumb>
					<!--breadcrumbs end-->
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
					      		<v-select label="Select Store" v-model="select" :items="stores" :rules="[v => !!v || 'Item is required']" required></v-select>
					      	</v-flex>

					    	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Code" v-model="code" :rules="codeRules" :counter="50" required></v-text-field>
					      	</v-flex>

					      	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Key" v-model="key" :rules="keyRules" :counter="50" required></v-text-field>
					      	</v-flex>
					      	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Value" v-model="value" :rules="valueRules" :counter="50" required></v-text-field>
					      	</v-flex>
					      	<v-flex xs12 sm12 md12>
						      	<v-btn @click="submit(1)" :disabled="!valid" color="primary">
							        Save & New
							    </v-btn>
							    <v-btn @click="submit(2)" :disabled="!valid" color="primary">
							        Save & Close
							    </v-btn>
							    <router-link to="/admin/settings/list">
								    <v-btn color="red" dark>
								        Cancele
								    </v-btn>
							    </router-link>
							</v-flex>
					    </v-layout>
					</v-container>
			    </v-form>
			</v-card>
		</v-app>
	</section>
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
			      (v) => v && v.length <= 50 || 'Code must be less than 50 characters'
			    ],
			    key: '',
			    keyRules: [
			      (v) => !!v || 'Key is required',
			      (v) => v && v.length <= 50 || 'Key must be less than 50 characters'
			    ],
			    value: '',
			    valueRules: [
			      (v) => !!v || 'Value is required',
			      (v) => v && v.length <= 50 || 'Value must be less than 50 characters'
			    ],
			    select: null,
			    stores: [],
			    items: [
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
					this.stores=res.data
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
		        			this.$refs.form.reset()
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