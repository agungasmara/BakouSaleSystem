<template id="{{ $route.params.id }}">
	<v-app id="inspire">
	

		<section id="_content">
			<!--breadcrumbs start-->
			<div id="breadcrumbs-wrapper">
				<!-- Search for small screen -->
				<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
				  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
				</div>
				<div class="row container">
				  <div class="container">
				    <div class="col s10 m6 l6">
				      <h5 class="breadcrumbs-title">Orders</h5>
				      	<v-breadcrumbs>
				        	<v-icon slot="divider">/</v-icon>
			        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
			          			{{ item.text }}
			        		</v-breadcrumbs-item>
			      		</v-breadcrumbs>
				    </div>
				    <div class="col s2 m6 l6">
				     	<router-link to="/admin/sale_order/list" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Back</v-btn></router-link>
				    	<router-link to="/admin/sale_order/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right"><i class="material-icons">print</i> &nbsp;Print</v-btn></router-link>
				    	<router-link to="/admin/sale_order/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right"><i class="material-icons">print</i> &nbsp;Print Shipping</v-btn></router-link>
				    </div>
				  </div>
				</div>
			</div>
			<!--breadcrumbs end-->
			<div id="basic-form" class="section">
	            <div class="row col s12">
	            	<div class="container">
		              <!-- Form with placeholder -->
		              <div class="col s12 m12 l12">
		                <div class="_card-panel">
		                  
		                  <div class="container">
		                    <v-form v-model="valid" ref="form" lazy-validation>
			                    <div v-for="item in section">
			                    	
			                    	<div class="row">
				                    	<div class="col s12 m12 l3">
				                    		<div class="row">
					                    		<h4  class="header"> {{item.info_title}} </h4>
					                    		<div>
					                    			{{item.info_description}}
					                    		</div>
				                    		</div>
				                    	</div>
				                    	<div class="col s12 m12 l6">
					                      
					                      <div class="row">
					                      	<v-container grid-list-md>
					                      		<h4 class="header"><i class="material-icons text-left"> {{item.icon}} </i> {{item.title}} </h4>
					                      		<div class="divider"></div>
											    <v-layout row wrap>
											    	 <v-flex v-for="column in rows[item.form]" :class="column.class" :key="column.key">
											      		<span v-if="data.data[column.key]"><i style="float: left;" class="material-icons">{{column.icon}}</i> {{data.data[column.key]}} {{data.data[column.sub]}}</span>
											      	</v-flex>

											    </v-layout>
											    	
											    	
											      	
											    
											</v-container>
					                      </div>
					                    </div>
					                    
					                </div>
			                      	<div class="clearfix"></div>
			                    	
		                    	</div>
		     
		                    	
		                    	

		                    	
		                    

		                    	
		                    	
		                    
		                    	<!-- address -->
		                    	<div id="striped-table">
					                <h4 class="header"><i class="material-icons text-left">assignment</i> &nbsp; Order # {{data.data.order_id}}</h4>
					                <div class="row">
					                  <div class="col s12">
					                    <table class="striped">
					                      <thead>
					                        <tr>
					                          <th data-field="id">Payment Address</th>
					                          <th data-field="name">Shipping Address</th>
					                        </tr>
					                      </thead>
					                      <tbody>
					                        <tr v-for="addr in rows.address" v-show="data.data[addr.payment] || data.data[addr.shipping]">
					                        	<td>{{data.data[addr.payment]}}</td>
					                        	<td>{{data.data[addr.shipping]}}</td>
					                        </tr>
					                      </tbody>
					                    </table>
					                  </div>
					                </div>
					              </div>
		                    	

		                    	<div class="clearfix"></div>
		                    	<!-- list order products -->
		                    	<div id="striped-table">
					                <h4 class="header"><i class="material-icons text-left">info_outline</i> &nbsp; Product Details</h4>
					                <div class="row">
					                  <div class="col s12">
					                    <table class="striped">
					                      <thead>
					                        <tr>
					                          <th data-field="id">Product</th>
					                          <th data-field="name">Model</th>
					                          <th data-field="price">Quantity</th>
					                          <th data-field="unit_price">Unit Price</th>
					                          <th data-field="total">Total</th>
					                        </tr>
					                      </thead>
					                      <tbody>
					                        <tr v-for="product in data.products" >
					                          <td>{{product.name}}</td>
					                          <td>{{product.model}}</td>
					                          <td>{{product.quantity}}</td>
					                          <td>$ {{product.price * 1}}</td>
					                          <td>$ {{product.total * 1}}</td>
					                          
					                        </tr>
					                        
					                      </tbody>
					                      <tfoot style="border-top:1px solid #d0d0d0;">
					                      	<tr>
					                      		<td colspan="3">&nbsp;</td>
					                      		<td><b>Sub Total</b></td>
					                      		<td>$ {{data.sub_total * 1}}</td>
					                      	</tr>
					                      	<tr>
					                      		<td colspan="3">&nbsp;</td>
					                      		<td><b>Tax Total</b></td>
					                      		<td>$ {{data.tax * 1}}</td>
					                      	</tr>
					                      	<tr>
					                      		<td colspan="3">&nbsp;</td>
					                      		<td><b>Total</b></td>
					                      		<td>$ {{data.total * 1}}</td>
					                      	</tr>
					                      </tfoot>
					                    </table>
					                  </div>
					                </div>
					              </div>
		                    	
		                    	
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
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return {
				back:'/admin/sale_order/list',
				url:'/admin/api/sale_order/',
				data:{},

				section:[
					{
						info_title:'Order Details',
						info_description:'Change general information for this product.',
						icon:'shopping_cart',
						title:'Order Information',
						form:'order',
					},
					{
						info_title:'Customer Detail',
						info_description:'Change general information for this product.',
						icon:'supervisor_account',
						title:'Customers Information',
						form:'Customer',
					},
					{
						info_title:'Generate Invoice',
						info_description:'Change general information for this product.',
						icon:'assignment',
						title:'Options',
						form:'invoice',
					},
					// {
					// 	info_title:'',
					// 	info_description:'',
					// 	icon:'location_on',
					// 	title:'Payment Address',
					// 	form:'payment',
					// },
					// {
					// 	info_title:'',
					// 	info_description:'',
					// 	icon:'attach_money',
					// 	title:'Shipping Address',
					// 	form:'Shipping',
					// },
					

				],
				rows:{
					order:[
						{	class:'xs6 sm6',	key:'store_name',		icon:'info_outline'},
						{	class:'xs6 sm6',	key:'date_added',		icon:'schedule'},
						{	class:'xs6 sm6',	key:'payment_method',		icon:'local_shipping'},
						{	class:'xs6 sm6',	key:'shipping_method',		icon:'info_outline'},
					],
					Customer:[
						{	class:'xs6 sm6',	key:'firstname',	sub:'lastname',	icon:'account_circle'},
						{	class:'xs6 sm6',	key:'customer_group_name',		icon:'supervisor_account'},
						{	class:'xs6 sm6',	key:'email',		icon:'mail'},
						{	class:'xs6 sm6',	key:'telephone',		icon:'phone_iphone'},
					],
					invoice:[
						// {	class:'xs6 sm6',	key:'name',		icon:'info_outline'},
						// {	class:'xs6 sm6',	key:'name',		icon:'info_outline'},
						// {	class:'xs6 sm6',	key:'name',		icon:'info_outline'},
						// {	class:'xs6 sm6',	key:'name',		icon:'info_outline'},
					],
					address:[
						{	class:'xs6 sm6',	payment:'payment_company',	shipping:'shipping_company',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_address_1',	shipping:'shipping_address_1',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_address_2',	shipping:'shipping_address_2',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_city',	shipping:'shipping_city',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_zone',	shipping:'shipping_zone',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_country',	shipping:'shipping_country',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_postcode',	shipping:'shipping_postcode',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_code',	shipping:'shipping_code',		icon:'info_outline'},
						{	class:'xs6 sm6',	payment:'payment_address_format',	shipping:'shipping_address_format',		icon:'info_outline'},

					],
					
				}
			}
		},
		created(){
			this.dataID=this.id
			
		},
		methods:{
			
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			
		    checkPasswordConfirmed(){
	    		if(this.password===this.confirmPassword){
		        	this.error=false
		        }else{
		        	if(this.confirmPassword===""){
		        		this.error=false
		        	}else{
		        		this.error=true
		        	}
		        }
		        return this.error
		    },
		    
		}
	}
</script>