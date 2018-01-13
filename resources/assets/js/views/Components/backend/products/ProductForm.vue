<!-- <template>
  <v-tabs fixed centered>
    <v-toolbar color="cyan">
      <v-text-field
        solo
        label="Search"
        append-icon="keyboard_voice"
        prepend-icon="search"
      ></v-text-field>
      <v-tabs-bar color="transparent" slot="extension" dark>
        <v-tabs-slider color="yellow"></v-tabs-slider>
        <v-tabs-item
          v-for="i in 3"
          :key="i"
          :href="'#tab-' + i"
        >
          Item {{ i }}
        </v-tabs-item>
      </v-tabs-bar>
    </v-toolbar>
    <v-tabs-items>
      <v-tabs-content
        v-for="i in 3"
        :key="i"
        :id="'tab-' + i"
      >
        <v-card flat>
          <v-card-text>{{ text }}</v-card-text>
        </v-card>
      </v-tabs-content>
    </v-tabs-items>
  </v-tabs>
</template> -->
<template>
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
			    	<router-link to="/admin/Products/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Cancel</v-btn></router-link>

			     	<router-link to="/admin/attributes/list" replace><v-btn @click="submit(1)" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Save</v-btn></router-link>
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
					    	<v-tabs>
					    		<v-tabs-bar>
						      	<!-- <v-tabs-bar dark color="cyan"> -->
						        	<v-tabs-slider color="green"></v-tabs-slider>
							        <v-tabs-item
							          v-for="i in tabs"
							          :key="i.name"
							          :href="'#tab-' + i.name"
							        >
							           	{{ i.name }}
							        </v-tabs-item>
						      	</v-tabs-bar>
						      	<v-tabs-items>
						        	<v-tabs-content
							          v-for="i in tabs"
							          :key="i.name"
							          :id="'tab-' + i.name"
							        >
							          	<v-card flat>
							            	<v-card-text>
							            		<v-container grid-list-md offset-s3>
							              			<v-layout wrap>
							              				<v-flex v-for="input in i.group" :key="input.key" :class="input.class">
							              					<div v-if="input.type=='select'">
																<v-select :label="input.key" v-model="input.Value" :items="input.items" required></v-select>
							              					</div>
							              					<div v-else>
																<v-text-field :label="input.key" v-model="input.value" :counter="10" required></v-text-field>
							              					</div>

														</v-flex>
												    </v-layout>
												</v-container>
							            	</v-card-text>
							          	</v-card>
						        	</v-tabs-content>
						      	</v-tabs-items>
						    </v-tabs>
					    	
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
	import ImageUpload from '../commons/image/ImageUpload.vue'

	export default{
		components: {
			ImageUpload
		},
		data(){
			return{
				valid: true,
				
				status:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],
				weight_class:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],
				length_class:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],
				subtract_stock:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],
				stock_status:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],
				tax_class:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],
				manufacturer:[
					{	Value:1,	text:'Enable'},
					{	Value:0,	text:'Disable'}
				],

				
				tabs:[
						{
							name:'General', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'description',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'tag',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_title',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_description',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_keyword',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 Value:''},
							]
						},
						{
							name:'Data', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'model',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'manufacturer_id',	type:'select',	 Value:''	,items:this.manufacturer},
								{	class:'xs12 sm6 md6',	 key:'sku',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'upc',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'ean',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'jan',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'isbn',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'mpn',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'location',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'quantity',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'stock_status_id',	type:'select',	 Value:'',	items:this.stock_status},
								{	class:'xs12 sm6 md6',	 key:'price',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'minimum',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'subtract',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'shipping',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'points',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'tax_class_id',	type:'select',	 Value:'',	items:this.tax_class},
								{	class:'xs12 sm6 md6',	 key:'date_available',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'weight',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'weight_class_id',	type:'select',	 Value:'',	items:this.weight_class},
								{	class:'xs4 sm2',	 key:'length',	type:'text',	 Value:''},
								{	class:'xs4 sm2',	 key:'width',	type:'text',	 Value:''},
								{	class:'xs4 sm2',	 key:'height',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'length_class_id',	type:'select',	 Value:'',	items:this.length_class},
								{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'status',	type:'select',	Value:'',	items:this.status	},

							]
						},
						// {
						// 	name:'Links', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'',	Value:'',	items:[]}
						// 	]
						// },
						// {
						// 	name:'Attribute', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						// {
						// 	name:'Option', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						// {
						// 	name:'Recurring', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						// {
						// 	name:'Discount', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						// {
						// 	name:'Special', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						{
							name:'Image', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'image',	type:'text',	 Value:''},
							]
						},
						// {
						// 	name:'Reward Points', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						// {
						// 	name:'SEO', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
						// {
						// 	name:'Design', 
						// 	group:[
						// 		{	class:'',	 key:'',	type:'', Value:'',	}
						// 	]
						// },
					],
				
			    // code: '',
			    // codeRules: [
			    //   (v) => !!v || 'Code is required',
			    //   (v) => v && v.length <= 10 || 'Code must be less than 10 characters'
			    // ],
			    // key: '',
			    // keyRules: [
			    //   (v) => !!v || 'Key is required',
			    //   (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
			    // ],
			    // value: '',
			    // valueRules: [
			    //   (v) => !!v || 'Value is required',
			    //   (v) => v && v.length <= 10 || 'Value must be less than 10 characters'
			    // ],
			    // select: null,
			    // items: [],
			    breadcrumbs: [
			        {
			          text: 'Dashboard',
			          disabled: false
			        },
			        {
			          text: 'Products',
			          disabled: false
			        },
			        {
			          text: 'Form',
			          disabled: true
			        }
		      	],
				flash:Flash.state
			}
		},
		created(){
			this.getCategories()
		},
		methods:{
			getCategories(){
				axios.get('admin/api/categories/list').then((res)=>{
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