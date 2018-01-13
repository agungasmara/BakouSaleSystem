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
							              				<v-flex xs12 sm6 md6 v-for="input in i.group" :key="input.key" >
															<v-text-field :label="input.key" v-model="input.value" :counter="10" required></v-text-field>
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
	export default{
		data(){
			return{
				valid: true,
				tabs:[
						{
							name:'General', 
							group:[
								{	key:'language_id',	type:'text', Value:''	},
								{	key:'description',	type:'text', Value:''	},
								{	key:'tag',	type:'text', Value:''	},
								{	key:'meta_title',	type:'text', Value:''	},
								{	key:'meta_description',	type:'text', Value:''	},
								{	key:'meta_keyword',	type:'text', Value:''	},
							]
						},
						{
							name:'Data', 
							group:[
								{	key:'name',	type:'text', Value:''},
								{	key:'model',	type:'text', Value:''},
								{	key:'sku',	type:'text', Value:''},
								{	key:'upc',	type:'text', Value:''},
								{	key:'ean',	type:'text', Value:''},
								{	key:'jan',	type:'text', Value:''},
								{	key:'isbn',	type:'text', Value:''},
								{	key:'mpn',	type:'text', Value:''},
								{	key:'location',	type:'text', Value:''},
								{	key:'quantity',	type:'text', Value:''},
								{	key:'stock_status_id',	type:'text', Value:''},
								{	key:'image',	type:'text', Value:''},
								{	key:'manufacturer_id',	type:'text', Value:''},
								{	key:'shipping',	type:'text', Value:''},
								{	key:'price',	type:'text', Value:''},
								{	key:'points',	type:'text', Value:''},
								{	key:'tax_class_id',	type:'text', Value:''},
								{	key:'date_available',	type:'text', Value:''},
								{	key:'weight',	type:'text', Value:''},
								{	key:'weight_class_id',	type:'text', Value:''},
								{	key:'length',	type:'text', Value:''},
								{	key:'width',	type:'text', Value:''},
								{	key:'height',	type:'text', Value:''},
								{	key:'length_class_id',	type:'text', Value:''},
								{	key:'subtract',	type:'text', Value:''},
								{	key:'minimum',	type:'text', Value:''},
								{	key:'sort_order',	type:'text', Value:''},
								{	key:'status',	type:'text', Value:''},

							]
						},
						{
							name:'Links', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Attribute', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Option', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Recurring', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Discount', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Special', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Image', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Reward Points', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'SEO', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
						{
							name:'Design', 
							group:[
								{	key:'',	type:'', Value:''}
							]
						},
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