<template>
	<v-app id="inspire">
		<!--breadcrumbs start-->
		<div id="breadcrumbs-wrapper">
			<!-- Search for small screen -->
			<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
			  <input type="text" class="header-search-input z-depth-2" placeholder="Explore Materialize">
			</div>
			<div class="container">
			  <div class="row">
			    <div class="col s10 m6 l6">
			      <h5 class="breadcrumbs-title">{{ breadcrumbTitle }}</h5>
			      	<v-breadcrumbs>
			        	<v-icon slot="divider">/</v-icon>
		        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
		          			{{ item.text }}
		        		</v-breadcrumbs-item>
		      		</v-breadcrumbs>
			    </div>
			  </div>
			</div>
		</div>
		<v-stepper v-model="e1">
	      <v-stepper-header>
	        <v-stepper-step step="1" :complete="e1 > 1">Customer Detail</v-stepper-step>
	        <v-divider></v-divider>
	        <v-stepper-step step="2" :complete="e1 > 2">Products</v-stepper-step>
	        <v-divider></v-divider>
	        <v-stepper-step step="3" :complete="e1 > 3">Payment Detail</v-stepper-step>
	        <v-divider></v-divider>
	        <v-stepper-step step="4" :complete="e1 > 4">Shiping Details</v-stepper-step>
	        <v-divider></v-divider>
	        <v-stepper-step step="5" :complete="e1 > 5">Total</v-stepper-step>
	      </v-stepper-header>
	      <v-stepper-items>
	        <v-stepper-content step="1">
	          	
	          	<full-screen-form
					v-bind:url="url"
					v-bind:id="0"
					v-bind:form-items="customer"
					v-bind:form-rules="rules"
					v-bind:form-datas="data"
					v-bind:select-items="select"
					v-bind:back-url="backUrl"
				></full-screen-form>

	          <v-divider></v-divider>
	          <v-btn color="primary" @click.native="e1 = 2" style="float: right;" :disabled="!valid">Continue</v-btn>
	        </v-stepper-content>
	        <v-stepper-content step="2">
	          	<v-form v-model="valid" ref="formProduct" lazy-validation>
	          		<table class="table datatable">
	          			<thead>
	          				<tr>
	          					<th>Product</th>
	          					<th>Model</th>
	          					<th>Quantity</th>
	          					<th>Unit Price</th>
	          					<th>Total</th>
	          					<th>Action</th>
	          				</tr>
	          			</thead>
	          			<tbody>
	          				<tr v-for="(product,index) in selectedProducts">
	          					<td>

	          					</td>
	          					<td></td>
	          					<td></td>
	          					<td></td>
	          					<td></td>
	          					<td></td>
	          				</tr>
	          			</tbody>
	          		</table>
	          		<v-container grid-list-md>
	          			<v-layout row wrap>
		          			<v-flex xs12 sm3 md3>
		          				<v-select label="Product"  :rules="[(v) => !!v || 'Product is required']" v-model="product" :items="productlists" required autocomplete></v-select>
		          			</v-flex>
		          			<v-flex xs12 sm3 md3>
		          				<v-text-field v-model="quantity" label="Quantity" :rules="[(v) => !!v || 'Product quantity is required']" required></v-text-field>
		          			</v-flex>
		          		</v-layout>
		          		<v-divider></v-divider>
		          		<v-layout row wrap v-if="showOption">
		          			<v-flex xs12 sm12 md12>
			          			<h5>Choose Option(s)</h5>
			          			<v-divider></v-divider>
			          		</v-flex>
			          		<v-flex xs12 sm12 md12>
				          		<v-layout row wrap>
				          			<v-flex xs6 sm3 md3>
				          				Checkbox
				          			</v-flex>
				          			<v-flex xs6 ms3 md3>
				          				<v-checkbox label="Checkbox 1"></v-checkbox>
				          				<v-checkbox label="Checkbox 2"></v-checkbox>
				          			</v-flex>
				          		</v-layout>
				          	</v-flex>
			          		<v-divider></v-divider>
			          		<v-flex xs12 sm12 md12>
				          		<v-layout row wrap>
				          			<v-flex xs12 sm12 md12>
				          				<v-select label="Select"  :rules="[(v) => !!v || 'Select is required']" v-model="selectedItem.select" :items="selectItems" required></v-select>
				          			</v-flex>
				          			<v-flex xs12 sm12 md12>
				          				<v-text-field label="Textarea" v-model="selectedItem.textarea" textarea></v-text-field>
				          			</v-flex>
				          			<v-flex xs12 sm3 md3>
				          				<v-select label="Radio"  :rules="[(v) => !!v || 'Radio is required']" v-model="selectedItem.select" :items="selectItems" required></v-select>
				          			</v-flex>
				          			<v-flex xs12 sm3 md3>
				          				<v-text-field v-model="selectedItem.text" label="Text"></v-text-field>
				          			</v-flex>
				          			<v-flex xs12 sm3 md3>
				          				<v-menu
								          lazy
								          :close-on-content-click="false"
								          v-model="menu"
								          transition="scale-transition"
								          offset-y
								          full-width
								          :nudge-right="40"
								          max-width="290px"
								          min-width="290px"
								        >
								          <v-text-field
								            slot="activator"
								            label="Date"
								            v-model="selectedItem.date"
								            prepend-icon="event"
								            readonly
								          ></v-text-field>
								          <v-date-picker v-model="selectedItem.date" no-title scrollable actions>
								            <template slot-scope="{ save, cancel }">
								              <v-card-actions>
								                <v-spacer></v-spacer>
								                <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
								                <v-btn flat color="primary" @click="save">OK</v-btn>
								              </v-card-actions>
								            </template>
								          </v-date-picker>
								        </v-menu>
				          			</v-flex>
			          			</v-layout>
			          		</v-flex>
			          		<v-flex xs12 sm12 md12 class="text-lg-right">
			          			<v-btn color="primary">Add Product</v-btn>
			          		</v-flex>
		          		</v-layout>
	          		</v-container>
	          	</v-form>
	          <v-btn color="primary" @click.native="e1 = 3" style="float: right;">Continue</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	        <v-stepper-content step="3">
	          <v-card color="grey lighten-1" class="mb-5" height="200px"></v-card>
	          <v-btn color="primary" @click.native="e1 = 4" style="float: right;">Continue</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	        <v-stepper-content step="4">
	          <v-card color="grey lighten-1" class="mb-5" height="200px">
	          	<v-flex xs12 sm12 md12>
	          		<h1>4</h1>
	          	</v-flex>
	          </v-card>
	          <v-btn color="primary" @click.native="e1 = 5" style="float: right;">Continue</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	        <v-stepper-content step="5">
	          <v-card color="grey lighten-1" class="mb-5" height="200px"></v-card>
	          <v-btn color="primary" @click="saveSale()" style="float: right;">Save</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	      </v-stepper-items>
	    </v-stepper>
	</v-app>
</template>
	
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import fullScreenForm from '../commons/form/fullScreenForm.vue'
	export default{
		props:['id'],
		components:{
			'fullScreenForm':fullScreenForm
		},
		data(){
			return {
				back:'/admin/sale_order/list',
				url:'/admin/api/sale_order/',
				data:{},
				valid:true,
				e1:0,
				menu:null,
				customer:[
			    	{	class:'xs12 sm3 md3',	 key:'store_id',	type:'select',	 text:'Store',items:'stores'	},
					{	class:'xs12 sm3 md3',	 key:'currency_id',	type:'select',text:'Currency',items:'currencies'	},
					{	class:'xs12 sm3 md3',	 key:'customer_id',	type:'text',  text:'Customer'	},
					{	class:'xs12 sm3 md3',	 key:'customer_group_id',	type:'select',text:'Customer Group',items:'customergroups'	},
					{	class:'xs12 sm3 md3',	 key:'first_name',	type:'text',	 text:'First Name'},
					{	class:'xs12 sm3 md3',	 key:'last_name',	type:'text',text:'Last Name'	},
					{	class:'xs12 sm3 md3',	 key:'email',	type:'text',  text:'Email'	},
					{	class:'xs12 sm3 md3',	 key:'telephone',	type:'text',text:'Telephone'},
				],
				selectedProducts:[],
				selectedItem:{},
				productlists:[
					'Camera canon 70D',
					'Camera canon 5D',
					'Camera canon 6D'
				],
				product:'',
				quantity:1,
				showOption:false,
				selectItems:[
					{text:'Small',value:1},
					{text:'Medium',value:2}
				],
				rules:{
					first_name: [
				      (v) => !!v || 'First Name is required',
				    ],
				    last_name:[
				      (v) => !!v || 'Last Name is required'
				    ],
				   	email:[
				      (v) => !!v || 'Email is required'
				    ],
				   	telephone:[
				      (v) => !!v || 'Telephone is required'
				    ]
				},
				data:{
					name:'',
					option_id:'',
					language_id:'',
					sort_order:0,
					optionValues:[]
				},
				select:{
					stores:[
						{text:'Defalt',value:1}
					],
					currencies:[
						{text:'Euro',value:1},
						{text:'USSD',value:2},
						{text:'Pound',value:3}
					],
					customergroups:[
						{text:'Defalt',value:1}
					]
				},
				breadcrumbTitle:'Sale Order',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Sale',
			          disabled: false
			        },
			        {
			          text: 'Add Order',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/options/list',
			}
		},
		created(){
			
		},
		watch:{
			product:function(){
				this.showOption=true;
			}
		},
		methods:{
		    saveSale(){
		    	alert('Successfully saved')
		    },
		    addProduct(){
		    	var itemInfo={
						name:'Camera canon 70D',
						model:'Canon',
						quantity:5,
						unitprice:700,
					};
		    }
		}
	}
</script>