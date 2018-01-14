<template>
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
					      		<v-text-field label="Name" v-model="name" :rules="nameRules" :counter="50" required></v-text-field>
					      	</v-flex>

					    	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Code" v-model="code" :rules="codeRules" :counter="50" required></v-text-field>
					      	</v-flex>

					      	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Local" v-model="local" :rules="localRules" :counter="50" required></v-text-field>
					      	</v-flex>
					      	<v-flex xs12 sm6 md6>
					      		<v-text-field label="Directory" v-model="directory" :rules="directoryRules" :counter="50" required></v-text-field>
					      	</v-flex>

					      	<v-flex xs12 sm4 md4>
					      		<v-text-field label="Sort Order" v-model="sortOrder" :rules="sortOrderRules" :counter="50" required></v-text-field>
					      	</v-flex>

					    	<v-flex xs12 sm4 md4>
					      		<v-text-field label="Image" v-model="image" :rules="imageRules" :counter="50" required></v-text-field>
					      	</v-flex>

					      	<v-flex xs12 sm4 md4>
								<v-select label="Status" v-model="selectStatus" :items="status" :rules="[v => !!v || 'Status is required']" required></v-select>
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
	import breadcrumb3btn from '../commons/breadcrumb/breadcrumb3btn.vue'
	export default{
		data(){
			return{
				valid: true,
				name: '',
			    nameRules: [
			      (v) => !!v || 'Name is required',
			      (v) => v && v.length <= 50 || 'Name must be less than 50 characters'
			    ],
			    code: '',
			    codeRules: [
			      (v) => !!v || 'Code is required',
			      (v) => v && v.length <= 50 || 'Code must be less than 50 characters'
			    ],
			    local: '',
			    localRules: [
			      (v) => !!v || 'Key is required',
			      (v) => v && v.length <= 50 || 'local must be less than 50 characters'
			    ],
			    directory: '',
			    directoryRules: [
			      (v) => !!v || 'Directory is required',
			      (v) => v && v.length <= 50 || 'Directory must be less than 50 characters'
			    ],
			    sortOrder: '',
			    sortOrderRules: [
			      (v) => !!v || 'Sort Order is required',
			      (v) => v && v.length <= 50 || 'Sort Order must be less than 50 characters'
			    ],
			    image: '',
			    imageRules: [
			      (v) => !!v || 'Image is required',
			      (v) => v && v.length <= 50 || 'Image must be less than 50 characters'
			    ],
			    status: [
			    	{
			    		text:'Active',value:1
			    	},
			    	{
			    		text:'Inactive',value:0
			    	}
			    ],
			    selectStatus: 1,
			    breadcrumbTitle:'Languages',
			    breadcrumbs: [
			        {
			          text: 'Adminstrator',
			          disabled: false
			        },
			        {
			          text: 'Languages',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
		      	],
		      	backUrl:'/admin/languages/list',
				flash:Flash.state
			}
		},
		components:{
			'breadcrumb3btn':breadcrumb3btn
		},
		created(){
			
		},
		methods:{
			submit:function (opt) {
		      	if (this.$refs.form.validate()) {
			        // Native form submission is not yet supported
			        axios.post('/api/languages/save', {
			          name: this.name,
			          code: this.code,
			          local: this.local,
			          image: this.image,
			          directory:this.directory,
			          sort_order:this.sortOrder,
			          status:this.selectStatus
			        }).then((res)=>{
			        	console.log(res.data)
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