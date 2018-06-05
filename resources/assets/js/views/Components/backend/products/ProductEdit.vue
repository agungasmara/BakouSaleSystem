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
								{	class:'xs12 sm6 md6',	 key:'language_id',	text:'language_id',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'description',	text:'description',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'tag',	text:'tag',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_title',	text:'meta_title',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_description',	text:'meta_description',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_keyword',	text:'meta_keyword',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'name',	text:'name',	type:'text',	 Value:''},
							]
						},
						{
							name:'Data', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'model',	text:'model',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'manufacturer_id',	text:'manufacturer_id',	type:'select',	 Value:''	,items:this.manufacturer},
								{	class:'xs12 sm6 md6',	 key:'sku',	text:'sku',	type:'text',	 Value:''},
								
								{	class:'xs12 sm6 md6',	 key:'location',	text:'location',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'quantity',	text:'quantity',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'stock_status_id',	text:'stock_status_id',	type:'select',	 Value:'',	items:this.stock_status},
								{	class:'xs12 sm6 md6',	 key:'price',	text:'price',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'minimum',	text:'minimum',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'subtract',	text:'subtract',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'shipping',	text:'shipping',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'points',	text:'points',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'tax_class_id',	text:'tax_class_id',	type:'select',	 Value:'',	items:this.tax_class},
								{	class:'xs12 sm6 md6',	 key:'date_available',	text:'date_available',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'weight',	text:'weight',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'weight_class_id',	text:'weight_class_id',	type:'select',	 Value:'',	items:this.weight_class},
								{	class:'xs4 sm2',	 key:'length',	text:'length',	type:'text',	 Value:''},
								{	class:'xs4 sm2',	 key:'width',	text:'width',	type:'text',	 Value:''},
								{	class:'xs4 sm2',	 key:'height',	text:'height',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'length_class_id',	text:'length_class_id',	type:'select',	 Value:'',	items:this.length_class},
								{	class:'xs12 sm6 md6',	 key:'sort_order',	text:'sort_order',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'status',	text:'status',	type:'select',	Value:'',	items:this.status	},
							]
						},
						
						{
							name:'Image', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'image',	text:'image',	type:'text',	 Value:''},
							]
						},
						
					],
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
				axios.get('admin/admin/api/categories/list').then((res)=>{
					this.items=res.data
				})
			},
			submit (opt) {
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.post('/admin/api/setting/save', {
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