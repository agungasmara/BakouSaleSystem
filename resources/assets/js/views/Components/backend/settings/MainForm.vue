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
			    <v-form v-model="valid" ref="form" lazy-validation>
			    	<v-container grid-list-md>
              			<v-layout wrap>

					    	<v-flex xs12 sm6 md6>
					      		<v-select label="Select Store" v-model="select" autocomplete :items="stores" :rules="[v => !!v || 'Item is required']" required></v-select>
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
			    breadcrumbTitle:'Settins',
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
		      	backUrl:'/admin/settings/list',
				flash:Flash.state
			}
		},
		components:{
			'breadcrumb3button':breadcrumb3button
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
			submit:function (opt) {
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
		        			this.$router.push(this.backUrl)
		        		}
		        	}
		        })
		      }
		    }
		}
	}
</script>