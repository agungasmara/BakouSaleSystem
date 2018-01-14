<template id="{{ $route.params.id }}">
	<v-app id="inspire">
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
				      		<v-select label="Select Store" v-model="select" autocomplete :items="stores"  :rules="[v => !!v || 'Item is required']" required></v-select>
				      	</v-flex>

				    	<v-flex xs12 sm6 md6>
				      		<v-select label="Select Code" v-model="code" autocomplete :items="settingCode.text" ></v-select>
				      	</v-flex>

				      	<v-flex xs12 sm6 md6>
				      		<v-select label="Select Key" v-model="key" autocomplete :items="settingKey.text" ></v-select>
				      	</v-flex>

				      	<v-flex xs12 sm6 md6>
				      		<v-select label="Select Value" v-model="value" autocomplete :items="settingValue.text" ></v-select>
				      	</v-flex>
				    </v-layout>
				</v-container>
		    </v-form>
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
				settingCode:[],
				settingKey: [],
				settingValue:[],
			    select: 0,
			    stores: [],
				flash:Flash.state,
				breadcrumbTitle:'Edit Settings',
				breadcrumbs: [
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
			    ],
			    backUrl:'/admin/settings/list'
			}
		},
		components:{
			'breadcrumb3btn':breadcrumb3btn
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
				axios.get('/api/settings/getsettingbyid/'+id).then(res=>{
					this.code=res.data.code
					this.key=res.data.key
					this.value=res.data.value
					this.select=res.data.store_id
				});
			},
			fetchSettingItem(){
				axios.get('/api/settings/item/').then((res)=>{
					this.settingCode=res.data.code
					this.settingKey=res.data.key
					this.settingValue=res.data.value
				})
			},
			submit (opt) {
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.put('/api/settings/update/'+this.id, {
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