<template>
	<v-app id="inspire" xs12 sm10 md10>
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
			    <div class="col s2 m6 l6">
			    	<router-link :to="backUrl" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Cancel</v-btn></router-link>
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
	          	<!--Setp 1 for customer information form-->
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
	        	<!--step to for product information form include quantity to order-->
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
	          				<tr v-for="(pro,index) in selectedProducts">
	          					<td>
	          						<p v-for="item in pro.options">
	          							-{{item}}
	          						</p>
	          					</td>
	          					<td>Canon</td>
	          					<td>
	          						<v-text-field v-model="pro.quantity" type="number"></v-text-field>
	          					</td>
	          					<td>pro.unitprice</td>
	          					<td>{{pro.quantity*pro.unitprice}}</td>
	          					<td>
	          						<span @click="selectedProducts.splice(index,1)"  style="cursor: pointer;"> 
										<v-icon large material-icons color="red darken">indeterminate_check_box</v-icon>
							     	</span>
	          					</td>
	          				</tr>
	          			</tbody>
	          		</table>
	          		<v-divider></v-divider>
	          		<v-container grid-list-md>
	          			<v-layout row wrap>
		          			<v-flex xs12 sm3 md3>
		          				<v-select label="Product"  @change="showOpt" :rules="[(v) => !!v || 'Product is required']" v-model="selectedItem.product" :items="productlists" required autocomplete></v-select>
		          			</v-flex>
		          			<v-flex xs12 sm3 md3>
		          				<v-text-field v-model="selectedItem.quantity" label="Quantity" :rules="[(v) => !!v || 'Product quantity is required']" required></v-text-field>
		          			</v-flex>
		          		</v-layout>
		          		<v-divider></v-divider>
		          		<!--check if product has Option then show the option related to product to order-->
		          		<v-layout row wrap v-if="showOption">
		          			<v-flex xs12 sm12 md12>
			          			<h5>Choose Option(s)</h5>
			          			<v-divider></v-divider>
			          		</v-flex>
			          		<!--this is dynamic base on how many Option related to product-->
			          		<v-flex xs12 sm12 md12>
				          		<v-layout row wrap>
				          			<v-flex xs6 sm3 md3>
				          				Checkbox
				          			</v-flex>
				          			<v-flex xs6 ms3 md3>
				          				<v-checkbox label="Checkbox 1" v-model="selectedItem.checkbox1"></v-checkbox>
				          				<v-checkbox label="Checkbox 2" v-model="selectedItem.checkbox2"></v-checkbox>
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
			          			<v-btn color="primary" @click="addProduct()">Add Product</v-btn>
			          		</v-flex>
		          		</v-layout>
	          		</v-container>
	          	</v-form>
	          <v-btn color="primary" @click.native="e1 = 3" style="float: right;">Continue</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	        <!--step 3 payment information-->
	        <v-stepper-content step="3">
	          <full-screen-form
					v-bind:url="url"
					v-bind:id="0"
					v-bind:form-items="payments"
					v-bind:form-rules="rules"
					v-bind:form-datas="data"
					v-bind:select-items="select"
					v-bind:back-url="backUrl"
				></full-screen-form>
	          <v-btn color="primary" @click.native="e1 = 4" style="float: right;">Continue</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	        <!--step 4 shiping information-->
	        <v-stepper-content step="4">
	          <full-screen-form
					v-bind:url="url"
					v-bind:id="0"
					v-bind:form-items="shiping"
					v-bind:form-rules="rules"
					v-bind:form-datas="data"
					v-bind:select-items="select"
					v-bind:back-url="backUrl"
				></full-screen-form>
	          <v-btn color="primary" @click.native="e1 = 5" style="float: right;">Continue</v-btn>
	          <v-btn flat @click.native="e1=e1 - 1">Back</v-btn>
	        </v-stepper-content>
	        <!--step 5 calculate total ordered product-->
	        <v-stepper-content step="5">
	          <table class="table datatable">
          			<thead>
          				<tr>
          					<th>Product</th>
          					<th>Model</th>
          					<th>Quantity</th>
          					<th>Unit Price</th>
          					<th>Total</th>
          				</tr>
          			</thead>
          			<tbody>
          				<tr v-for="(pro,index) in selectedProducts">
          					<td>
          						<p v-for="item in pro.options">
          							-{{item}}
          						</p>
          					</td>
          					<td>Canon</td>
          					<td>
          						{{pro.quantity}}
          					</td>
          					<td>pro.unitprice</td>
          					<td>{{pro.quantity*pro.unitprice}}</td>
          				</tr>
          				<tr>
          					<td colspan="4" class="text-lg-right">Sub-Total:</td>
          					<td>700</td>
          				</tr>
          				<tr>
          					<td colspan="4" class="text-lg-right">Total:</td>
          					<td>700</td>
          				</tr>
          			</tbody>
          		</table>
          		<v-divider></v-divider>
          		<v-container grid-list-md>
          		<v-layout row wrap>
	          		<v-flex xs12 sm12 md12>
	          			<h5>Choose Option(s)</h5>
	          			<v-divider></v-divider>
	          		</v-flex>
	          		<v-flex xs10 sm10 md10>
	          			<v-select label="Select"  :rules="[(v) => !!v || 'Select is required']" v-model="selectedItem.select" :items="selectItems" required></v-select>
	          		</v-flex>
	          		<v-flex xs2 sm2 md2 class="text-md-center">
	          			<v-btn color="primary">Apply</v-btn>
	          		</v-flex>
	          		<v-flex xs10 sm10 md10>
	          			<v-select label="Select"  :rules="[(v) => !!v || 'Select is required']" v-model="selectedItem.select" :items="selectItems" required></v-select>
	          		</v-flex>
	          		<v-flex xs2 sm2 md2 class="text-md-center">
	          			<v-btn color="primary">Apply</v-btn>
	          		</v-flex>
	          		<v-flex xs10 sm10 md10>
          				<v-text-field label="Coupon" v-model="selectedItem.textarea"></v-text-field>
          			</v-flex>
          			<v-flex xs2 sm2 md2 class="text-md-center">
	          			<v-btn color="primary">Apply</v-btn>
	          		</v-flex>
          			<v-flex xs12 sm10 md10>
          				<v-text-field label="Voucher" v-model="selectedItem.textarea"></v-text-field>
          			</v-flex>
          			<v-flex xs2 sm2 md2 class="text-md-center">
	          			<v-btn color="primary">Apply</v-btn>
	          		</v-flex>
          			<v-flex xs12 sm10 md10>
          				<v-text-field label="Reward" v-model="selectedItem.textarea"></v-text-field>
          			</v-flex>
          			<v-flex xs2 sm2 md2 class="text-md-center">
	          			<v-btn color="primary">Apply</v-btn>
	          		</v-flex>
          			<v-flex xs12 sm3 md3>
          				<v-select label="Status"  :rules="[(v) => !!v || 'Select is required']" v-model="selectedItem.select" :items="select.statusItems" required></v-select>
          			</v-flex>
          			<v-flex xs12 sm12 md12>
          				<v-text-field label="Comment" v-model="selectedItem.textarea" textarea></v-text-field>
          			</v-flex>
          			<v-flex xs12 sm6 md6>
          				<v-text-field label="Affiliate" v-model="selectedItem.textarea"></v-text-field>
          			</v-flex>
	          	</v-layout>
	          	</v-container>
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
				payments:[
					{	class:'xs12 sm12 md12',	 key:'address_id',	type:'select',text:'Choose Address',items:'addressItem'	},
					{	class:'xs12 sm3 md3',	 key:'first_name',	type:'text',	 text:'First Name'},
					{	class:'xs12 sm3 md3',	 key:'last_name',	type:'text',text:'Last Name'	},
					{	class:'xs12 sm3 md3',	 key:'company',	type:'text',text:'Company'	},
					{	class:'xs12 sm3 md3',	 key:'email',	type:'text',  text:'Email'	},
					{	class:'xs12 sm12 md12',	 key:'address_1',	type:'text',text:'Address 1'},
					{	class:'xs12 sm12 md12',	 key:'address_2',	type:'text',text:'Address 2'},
					{	class:'xs12 sm3 md3',	 key:'city',	type:'text',  text:'City'	},
					{	class:'xs12 sm3 md3',	 key:'passcode',	type:'text',  text:'Passcode'	},
					{	class:'xs12 sm3 md3',	 key:'country',	type:'select',text:'Country',items:'countriesItem'	},
					{	class:'xs12 sm3 md3',	 key:'region',	type:'select',text:'Region/State',items:'regionItem'	},
				],
				shiping:[
					{	class:'xs12 sm12 md12',	 key:'address_id',	type:'select',text:'Choose Address',items:'addressItem'	},
					{	class:'xs12 sm3 md3',	 key:'first_name',	type:'text',	 text:'First Name'},
					{	class:'xs12 sm3 md3',	 key:'last_name',	type:'text',text:'Last Name'	},
					{	class:'xs12 sm3 md3',	 key:'company',	type:'text',text:'Company'	},
					{	class:'xs12 sm3 md3',	 key:'email',	type:'text',  text:'Email'	},
					{	class:'xs12 sm12 md12',	 key:'address_1',	type:'text',text:'Address 1'},
					{	class:'xs12 sm12 md12',	 key:'address_2',	type:'text',text:'Address 2'},
					{	class:'xs12 sm3 md3',	 key:'city',	type:'text',  text:'City'	},
					{	class:'xs12 sm3 md3',	 key:'passcode',	type:'text',  text:'Passcode'	},
					{	class:'xs12 sm3 md3',	 key:'country',	type:'select',text:'Country',items:'countriesItem'	},
					{	class:'xs12 sm3 md3',	 key:'region',	type:'select',text:'Region/State',items:'regionItem'	},
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
				    ],
				    address_1:[
				      (v) => !!v || 'Address 1 is required'
				    ],
				    city:[
				      (v) => !!v || 'City is required'
				    ],
				    country:[
				      (v) => !!v || 'City is required'
				    ],
				    region:[
				      (v) => !!v || 'City is required'
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
					],
					addressItem:[
						'--None--'
					],
					countriesItem:[
						'Cambodia',
						'Thai',
						'US'
					],
					regionItem:[
						'Phnom Penh',
						'Bangkok',
						'LA'
					],
					statusItems:[
						'Pending',
						'Canceled'
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
			    backUrl:'/admin/sale_order/list',
			}
		},
		created(){
			
		},
		methods:{
		    saveSale(){
		    	alert('Successfully saved')
		    },
		    showOpt(){
		    	this.showOption=true;
		    },
		    addProduct(){
		    	var itemInfo={
						name:this.selectedItem.name,
						model:'Canon',
						quantity:this.selectedItem.quantity,
						unitprice:700,
						options:this.selectedItem
					};
				this.selectedProducts.push(itemInfo);
		    }
		}
	}
</script>