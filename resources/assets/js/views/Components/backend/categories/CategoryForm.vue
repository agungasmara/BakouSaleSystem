<template>

<v-app id="inspire">
	<!-- <normal-form
		v-bind:url="url"
		v-bind:id="0"
		v-bind:breadcrumb-title="breadcrumbTitle"
		v-bind:breadcrumbs="breadcrumbs"
		v-bind:form-items="group"
		v-bind:form-rules="rules"
		v-bind:form-datas="data"
		v-bind:select-items="select"
		v-bind:back-url="backUrl"
	></normal-form> -->
	<section id="_content">
		<!--breadcrumbs start-->
		<!--breadcrumbs start-->
		<breadcrumb3button
		v-bind:breadcrumb-item="breadcrumbs"
		v-bind:breadcrumb-title="breadcrumbTitle"
		v-bind:submit="submit"
		v-bind:is-valid="valid"
		v-bind:back-url="backUrl"
		></breadcrumb3button>
		<!--breadcrumbs end-->
		<!--breadcrumbs end-->

		<div class="flash flash__success" v-if="flash.success">
			<v-alert color="success" icon="check_circle" value="true">
            	{{flash.success}}	
            </v-alert>
      	</div>
  	
		<div id="basic-form" class="section">
            <div class="row col s12">
            	<div class="container">
	              <div class="col s12 m12 l12">
	                <div class="_card-panel">

	                  
	                  <div class="container">
	                    <v-form v-model="valid" ref="form" lazy-validation>

	                    	<div class="row">
		                    	<div class="col s12 m12 l2">
		                    		<div class="row">
			                    		<h4  class="header">CATEGORIES</h4>
			                    		<div>
			                    			Set up your Categories here
			                    		</div>
		                    		</div>
		                    	</div>
		                    	<div class="col s12 m12 l8">
			                      
			                      <div class="row">
			                      	<v-container grid-list-md>
			                      		<v-layout wrap>
				                      		<v-flex xs12 sm6 md6>
									      		<!-- <v-select @change="changedValue" label="Select CategoryType" v-model="category_type_id"  :items="select.categoryType"  :rules="[v => !!v || 'Item is required']" required></v-select> -->
									      		<v-select label="Select CategoryType" v-model="data.category_type_id"  :items="select.categoryType"  :rules="[v => !!v || 'Item is required']" required></v-select>
									      	</v-flex>

									    	<v-flex xs12 sm6 md6>
									      		<!-- <v-select label="Select Category" v-model="parent_id"  :items="select.categoryParent"  :rules="[v => !!v || 'Item is required']" required></v-select> -->
									      		<v-select label="Select Category" v-model="data.parent_id"  :items="filteredData"  :rules="[v => !!v || 'Item is required']" required autocomplete></v-select>
									      	</v-flex>

									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Sort Order" v-model="sort_order" :rules="codeRules" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-select label="Status" v-model="status"  :items="select.statusItems"></v-select>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Column" v-model="column"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Top" v-model="top"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-select label="Choose Language" v-model="language_id"  :items="select.language"></v-select>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Name" v-model="name" :rules="keyName" :counter="100" required></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Description" v-model="description" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Meta Title" v-model="meta_title" :counter="100"></v-text-field>
									      	</v-flex>
									      		<v-flex xs12 sm6 md6>
									      		<v-text-field label="Meta Keyword" v-model="meta_keyword" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Meta Description" v-model="meta_description" :counter="100"></v-text-field>
									      	</v-flex>
								      	</v-layout>
									</v-container>

			                      </div>
			                    </div>
			                    <div class="col s12 m12 l2">
			                    	
		                    		<div class="row" v-for="item in section">
			                    		<h4 class="header">
				                    	<center> Product Image </center>
				                    	</h4>

				                    	<form-group
											v-bind:form-items="group[item.profile]"
											v-bind:form-rules="rules"
											v-bind:form-datas="data.data"
											v-bind:select-items="select"
										></form-group>
				                    		
			                    	</div>
			                    </div>
			                </div>
	                      	<div class="clearfix"></div>

	                    </v-form>
	                  </div>
	                </div>
	              </div>
	            </div>
            </div>
        </div>

	</section>
</v-app>
</template>
	
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	import breadcrumb3button from '../commons/breadcrumb/breadcrumb3button.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		props:['id'],
		data(){
			return {
				url:'/admin/api/categories/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
				breadcrumbTitle:'Users',
				keyName: [
			      (v) => !!v || 'Name is required',
			      (v) => v && v.length <= 100 || 'Name must be less than 100 characters'
			    ],
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
		      	section:[
					{
						info_title:'',
						info_description:'',
						title:'Product Gallary',
						icon:'info_outline',
						form:'gallery',
					}
				],
				group:{
					
				},
				rules:{
				
				},
				rules:{
					
				},
				data:{
					category_type_id:'',
					image:'',
					parent_id:'',
					top:'',
					column:'',
					sort_order:'',
					status:'',
					language_id:'',
					name:'',
					description:'',
					meta_title:'',
					meta_description:'',
					meta_keyword:'',
					//category_type: '',
					data:{
						image:''
					},
					gallery:[]
				},
				select:{
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					categoryType:[],
					categoryParent:[],
					language:[],
				},
				flash:Flash.state,
				breadcrumbTitle:'Categories',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Categories',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/categories/list',
			}
		},
		components:{
			'breadcrumb3button':breadcrumb3button
		},
		created(){
			this.id ? this.fetchData(this.id) : ''
			this.categoryType()
			this.categoryParent()
			this.language()
		},
		computed: {
		    filteredData() {
				let options = this.select.categoryParent;
		       return options.filter(o => o.category_type_id == this.data.category_type_id)
		    }
		},
		methods:{
			// changedValue() {
			//     axios.get('/admin/api/getCategories_parent/'+this.category_type_id).then((res)=>{
			//     	debugger;
			// 		this.select.categoryParent=res.data
			// 	})
			// },
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			categoryType(){
				axios.get('/admin/api/getCategories_type').then((res)=>{
					this.select.categoryType=res.data;
				})
			},
			categoryParent(){
				axios.get('/admin/api/getCategories_parent').then((res)=>{
					this.select.categoryParent=res.data
				})
			},

			language(){
				axios.get('/admin/api/getLanguages').then((res)=>{
					this.select.language=res.data
				})
			},
			submit (opt) {
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.post('/admin/api/categories', {
		          category_type_id: this.data.category_type_id,
		          parent_id: this.parent_id,
		          sort_order: this.sort_order,
		          status: this.status,
		          column: this.column,
		          top: this.top,
		          language_id:this.language_id,
		          name:this.name,
		          description: this.description,
		          meta_title: this.meta_title,
		          meta_keyword: this.meta_keyword,
		          meta_description: this.meta_description

		        }).then((res)=>{
		        	if(res.data.success==true){
		        		Flash.setSuccess(res.data.message)
		        		if(opt==1){
		        			this.$refs.form.reset()
		        		}
		        		else if(opt==2){
		        			this.$router.push('/admin/api/categories/list')
		        		}
		        	}
		        })
		      }
		    }
			
		}
	}
</script>