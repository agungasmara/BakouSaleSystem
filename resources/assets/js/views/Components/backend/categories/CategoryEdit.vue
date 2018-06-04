<template id="{{ $route.params.id }}">

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
									      		<v-select label="Select Category" v-model="data.category_type_id"  :items="select.categoryType"  :rules="[v => !!v || 'Item is required']" required></v-select>
									      	</v-flex>

									    	<v-flex xs12 sm6 md6>
									      		<v-select label="Select CategoryType" v-model="data.parent_id"  :items="filteredData"  :rules="[v => !!v || 'Item is required']" required></v-select>
									      	</v-flex>

									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Sort Order" v-model="data.sort_order" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-select label="Status" v-model="data.status"  :items="select.statusItems"></v-select>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Column" v-model="data.column"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Top" v-model="data.top"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-select label="Choose Language" v-model="data.language_id"  :items="select.language"></v-select>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Name" v-model="data.name" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Description" v-model="data.description" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Meta Title" v-model="data.meta_title" :counter="100"></v-text-field>
									      	</v-flex>
									      		<v-flex xs12 sm6 md6>
									      		<v-text-field label="Meta Keyword" v-model="data.meta_keyword" :counter="100"></v-text-field>
									      	</v-flex>
									      	<v-flex xs12 sm6 md6>
									      		<v-text-field label="Meta Description" v-model="data.meta_description" :counter="100"></v-text-field>
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

				                    	<!-- <form-group
											v-bind:form-items="group[item.profile]"
											v-bind:form-rules="rules"
											v-bind:form-datas="data.data"
											v-bind:select-items="select"
										></form-group>
				                    		 -->
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
				let options = this.select.categoryParent
		       return options.filter(o => o.value == this.data.category_type_id)
		    }
		},
		methods:{
			
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			categoryType(){
				axios.get('/admin/api/getCategories_type').then((res)=>{
					this.select.categoryType=res.data;
				})
				axios.get('/admin/api/getCategories_parent').then((res)=>{
					this.select.categoryParent=res.data
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
		        axios.post('/admin/api/categories/'+ this.id, {
		          category_type_id: this.data.category_type_id,
		          parent_id: this.data.parent_id,
		          sort_order: this.data.sort_order,
		          status: this.data.status,
		          column: this.data.column,
		          top: this.data.top,
		          language_id:this.data.language_id,
		          name:this.data.name,
		          description: this.data.description,
		          meta_title: this.data.meta_title,
		          meta_keyword: this.data.meta_keyword,
		          meta_description: this.data.meta_description

		        }).then((res)=>{
		        	if(res.data.success==true){
		        		Flash.setSuccess(res.data.message)
		        		if(opt==2){
		        			this.$router.push('/admin/api/categories/list')
		        		}
		        	}

		        })
		      }
		    }
			
		}
	}
</script>