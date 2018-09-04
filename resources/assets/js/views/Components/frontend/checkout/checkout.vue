<template>
	<div>
		<div class="container main-container headerOffset">
		    <div class="row">
		        <div class="breadcrumbDiv col-lg-12">
		            <ul class="breadcrumb">
		                <li><a href="">Home</a></li>
		                <li><a href="">Cart</a></li>
		                <li class="active"> Checkout</li>
		            </ul>
		        </div>
		    </div>
		    <!--/.row-->

		    <div class="row">
		        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs">
		            <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> Checkout</span></h1>
		        </div>
		        <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar col-xs-6 col-xxs-12 text-center-xs">
		            <h4 class="caps"><a href=""><i class="fa fa-chevron-left"></i> Back to shopping </a></h4>
		        </div>
		    </div>
		    <!--/.row-->
		    
		    <div class="row">
		        <div class="col-lg-9 col-md-9 col-sm-12">
		            <div class="row userInfo">
		                <div class="col-xs-12 col-sm-12">
		                    <div class="w100 clearfix">
								{{get_checkout_address | json}}
								<input type="text" v-model="get_checkout_address['address_id']"/>
		                    	<!-- tabs header -->
		                        <ul class="orderStep orderStepLook2">
		                        	<li v-for="(tab, i) in tabs" :class="{'active':activeTab==i}" @click="activeTab=i">
		                        		<a>
			                        		<i :class="tab.iconDisplay"></i> 
			                            	<span>{{tab.name}}</span>
		                        		</a>
		                        	</li>
		                        </ul>
		                        <!-- tabs header -->

		                        <!--/.orderStep end-->
		                    </div>
		                    <!-- form tabs -->
		                    <div class="w100 clearfix">
		                        <div class="row userInfo" v-for="i in tabs.length" v-show="activeTab==i-1">
		                            <div class="col-lg-12" >
		                                <h2 class="block-title-2"> 
		                                	{{tabs[activeTab].description}}
		                                </h2>
		                            </div>
		          

		                        </div>
		                        <!--/row end-->
		                    </div>
		                    <!-- end form -->
		                    <div>
		                   <!-- Customer address -->
		                    <div class="w100 clearfix" v-show='activeTab==0'>
		                        <div class="row userInfo">
		                        	<div v-for="input in tabs[activeTab].group" :class="input.class" >
		                            	<div v-for="form in input.data">
		                            		
		                            		<div class="form-group required" v-if="form.type=='select'">
		                                        <label :for="form.label">{{form.label}}</label>
		                                        <select v-model="data[form.key]" class="form-control" required aria-required="true" :id="form.label" :name="form.label" @change="onchange(form.change,data[form.key])">
		                                            <option v-for="(option,value) in selectItem[form.item]" :value="option.value">{{option.name}}</option>
		                                        </select>
		                                    </div>
		                                    <div class="form-group" v-else-if="form.type=='textarea'">
			                                    <label for="InputAdditionalInformation">{{form.label}}</label>
			                                    <textarea rows="3" cols="26" name="InputAdditionalInformation" v-model="data[form.key]" class="form-control"
			                                              id="other"></textarea>
			                                </div>
			                            	<div class="form-group required" v-else>
		                                        <label for="InputName">{{form.label}}<sup> * </sup> </label>
		                                        <input required type="text" v-model="data[form.key]" class="form-control" :placeholder="form.Value">
			                            	</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <!--/row end-->
		                    </div>
		                    <!-- Billing address -->
		                    <div class="w100 clearfix" v-show='activeTab==1'>
		                        <div class="row userInfo">
		                        	<div class="col-xs-12 col-sm-12">
		                                <label class="checkbox-inline" for="checkboxes-0">
		                                    <input name="checkboxes" id="checkboxes-0" v-model="data.same_as_shipping" type="checkbox">
		                                    My delivery and billing addresses are the same.=> {{data.same_as_shipping}}</label>
		                                <hr>
		                            </div>
		                        	<div v-for="input in tabs[activeTab].group" :class="input.class" >
		                            	<div v-for="form in input.data">
		                            		
		                            		<div class="form-group required" v-if="form.type=='select'">
		                                        <label :for="form.label">{{form.label}}</label>
		                                        <select v-model="data[form.key]" class="form-control" required aria-required="true" :id="form.label" :name="form.label" @change="onchange(form.change,data[form.key])">
		                                            <option v-for="(option,value) in selectItem[form.item]" :value="option.value">{{option.name}}</option>
		                                        </select>
		                                    </div>
		                                    <div class="form-group" v-else-if="form.type=='textarea'">
			                                    <label for="InputAdditionalInformation">{{form.label}}</label>
			                                    <textarea rows="3" cols="26" name="InputAdditionalInformation" v-model="data[form.key]" class="form-control"
			                                              id="other"></textarea>
			                                </div>
			                            	<div class="form-group required" v-else>
		                                        <label for="InputName">{{form.label}}<sup> * </sup> </label>
		                                        <input required type="text" v-model="data[form.key]" class="form-control" :placeholder="form.Value">
			                            	</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <!--/row end-->
		                    </div>
		                    
		                    <!-- Shipping address -->
		                     
		                    <div class="w100 clearfix" v-show='activeTab==2'>
		                        <div class="row userInfo">
		                            <div class="col-xs-12 col-sm-12">
		                                
		                                        <table style="width:100%" class="table-bordered table tablelook2">
		                                            <tbody>
		                                            <tr>
		                                                <td> Carrier</td>
		                                                <td>Method</td>
		                                                
		                                            </tr>
		                                            
		                                            <tr v-for="shipping in shippingList">
		                                                <td><label class="radio">
		                                                    <input type="radio" v-model="data.shipping_method" name="optionsRadios" id="optionsRadios2"
		                                                           :value="shipping.value">
		                                                    <i class="fa fa-truck fa-2x"></i> </label></td>
		                                                
		                                                <td>{{shipping.label}}</td>
		                                            </tr>
		                                            </tbody>
		                                        </table>
		                                    

		                                <!--/row-->

		                              
		                                <!--/ cartFooter -->

		                            </div>
		                        </div>
		                    </div>
		                    <!-- Payment -->
		                     <div class="w100 clearfix" v-show='activeTab==3'>
		                        <div class="row userInfo">
		                            <div class="col-lg-12">
		                                <p>Please select the preferred shipping method to use on this order.</p>
		                                <hr>
		                            </div>
		                            <div class="col-xs-12 col-sm-12">
		                                <div class="paymentBox">
		                                    <div class="panel-group paymentMethod" id="accordion">
		                                        <div class="panel panel-default">
		                                            <div class="panel-heading panel-heading-custom">
		                                                <h4 class="panel-title"><a class="cashOnDelivery" data-toggle="collapse"
		                                                                           data-parent="#accordion" href="#collapseOne">
		                                                    <span class="numberCircuil">Option 1</span> <strong> Cash on
		                                                    Delivery</strong> </a></h4>
		                                            </div>
		                                            <div id="collapseOne" class="panel-collapse collapse in">
		                                                <div class="panel-body">
		                                                    <p>All transactions are secure and encrypted, and we neverstor To
		                                                        learn more, please view our privacy policy.</p>
		                                                    <br>
		                                                    <label class="radio-inline" for="radios-4">
		                                                        <input name="radios" v-model="data.payment_method" id="radios-4" value="1" type="radio">
		                                                        Cash On Delivery </label>

		                                                    <div class="form-group">
		                                                        <label for="CommentsOrder">Add Comments About Your Order</label>
		                                                        <textarea v-model="data.comment" id="CommentsOrder" class="form-control"
		                                                                  name="CommentsOrder" cols="26" rows="3"></textarea>
		                                                    </div>
		                                                    <div class="form-group clearfix">
		                                                        <label class="checkbox-inline" for="checkboxes-1">
		                                                            <input name="checkboxes" id="checkboxes-1" value="1"
		                                                                   type="checkbox">
		                                                            I have read and agree to the <a
		                                                                href="terms-conditions.html">Terms & Conditions</a>
		                                                        </label>
		                                                    </div>
		                                                    
		                                                </div>
		                                            </div>
		                                        </div>
		                                       
		                                    </div>
		                                </div>

		                                <!--/row-->

		                            </div>
		                        </div>
		                    </div>
		                   
		                    <!--/row end-->
		                    <!-- Order -->
		                     <div class="w100 clearfix" v-show='activeTab==4'>
		                        <div class="row userInfo">
		                            <div class="col-xs-12 col-sm-12">
		                                <div class="cartContent w100 checkoutReview ">
		                                    <table class="cartTable table-responsive" style="width:100%">
		                                        <tbody>
		                                        <tr class="CartProduct cartTableHeader">
					                                <td style="width:15%"> Product</td>
					                                <td style="width:40%">Details</td>
					                                <td style="width:10%">QNT</td>
					                                <td style="width:15%">Total</td>
					                            </tr>

					                            <tr v-for="product in CartProduct.products.data" class="CartProduct" v-if="CartProduct.products.data.length > 0">
					                                <td class="CartProductThumb">
					                                    <div><router-link v-bind:to="'/product/product_detail/'+ product.product_id+'/0'"><img :src="product.image" alt="img"></router-link>
					                                    </div>
					                                </td>
					                                <td>
					                                    <div class="CartDescription">
					                                        <h4><router-link v-bind:to="'/product/product_detail/'+ product.product_id+'/0'">{{product.name}}</router-link></h4>
					                                        <span class="size">12 x 1.5 L</span>

					                                        <div class="price"><span>$ {{product.price*1}}</span></div>
					                                    </div>
					                                </td>
					                                <td class="price">{{product.cart_quantity}}</td>
					                                <td class="price">$ {{product.price * product.cart_quantity}}</td>
					                            </tr>
					                            <tr v-if="!CartProduct.products.data">
					                            	<td colspan="6" align="center">Your shopping cart is empty!</td>
					                            </tr>
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <!--cartContent-->

		                                <div class="w100 costDetails">
		                                    <div class="table-block" id="order-detail-content">
		                                        <table class="std table" id="cart-summary">
		                                            <tr>
		                                                <td>Total products</td>
		                                                <td class="price"> $ {{CartProduct.products.TotalPrices}}</td>
		                                            </tr>
		                                            <tr style="">
		                                                <td>Shipping</td>
		                                                <td class="price"><span class="success">Free shipping!</span></td>
		                                            </tr>
		                                            <tr class="cart-total-price ">
		                                                <td>Total (tax excl.)</td>
		                                                <td class="price"> $ {{CartProduct.products.TotalPrices}}</td>
		                                            </tr>
		                                            <tr>
		                                                <td>Total tax</td>
		                                                <td id="total-tax" class="price">0.00</td>
		                                            </tr>
		                                            <tr>
		                                                <td> Total</td>
		                                                <td id="total-price" class="price"> $ {{CartProduct.products.TotalPrices}}</td>
		                                            </tr>
		                                            <tbody>
		                                            </tbody>
		                                        </table>
		                                    </div>
		                                </div>
		                                <!--/costDetails-->


		                                <!--/row-->


		                            </div>
		                        </div>
		                    </div>
		                    
		                    <!--/row end-->
		                    </div>
		                    <div class="cartFooter w100">
		                        <div class="box-footer">

		                            <div class="pull-left">
		                                <a class="btn btn-default" @click="activeTab=activeTab-1">
		                                	<span v-if="activeTab - 1 < 0">
				                            	<router-link :to="{ path: '/'}" replace>
				                                	<i class="fa fa-arrow-left"></i>
					                                &nbsp; Back to Shop 
				                            	</router-link>	
		                                	</span>
		                                	<span v-else>
		                                		<i class="fa fa-arrow-left"></i>
			                                    &nbsp; {{tabs[activeTab-1].button}}
		                                	</span>
										</a>
		                            </div>
		                            <div class="pull-right">
		                                	<span v-if="activeTab + 1 > tabs.length-1">
		                                		<a class="btn btn-primary btn-small" @click="Submit()">
				                                    &nbsp; Confirm Order
				                                    <i class="fa fa-arrow-circle-right"></i> 
		                                		</a>
		                                	</span>
		                                	<span v-else>
			                                	<a class="btn btn-primary btn-small" @click="activeTab=activeTab+1">
				                                    &nbsp; {{tabs[activeTab+1].button}}
				                                	<i class="fa fa-arrow-circle-right"></i> 
			                             		</a>
		                                	</span>
		                            </div>
		                        </div>
		                    </div>

		                </div>
		            </div>
		            <!--/row end-->

		        </div>
		        <div class="col-lg-3 col-md-3 col-sm-12 rightSidebar">
		            <div class="w100 cartMiniTable">
		                <table id="cart-summary" class="std table">
		                    <tbody>
		                    <tr>
		                        <td>Total products</td>
		                        <td class="price"> $ {{CartProduct.products.TotalPrices}}</td>
		                    </tr>
		                    <tr style="">
		                        <td>Shipping</td>
		                        <td class="price"><span class="success">Free shipping!</span></td>
		                    </tr>
		                    <tr class="cart-total-price ">
		                        <td>Total (tax excl.)</td>
		                        <td class="price"> $ {{CartProduct.products.TotalPrices}}</td>
		                    </tr>
		                    <tr>
		                        <td>Total tax</td>
		                        <td class="price" id="total-tax">$0.00</td>
		                    </tr>
		                    <tr>
		                        <td> Total</td>
		                        <td class=" site-color" id="total-price"> $ {{CartProduct.products.TotalPrices}}</td>
		                    </tr>
		                    </tbody>
		                    <tbody>
		                    </tbody>
		                </table>
		            </div>
		            <!--  /cartMiniTable-->

		        </div>
		        <!--/rightSidebar-->

		    </div>
		    <!--/row-->

		    <div style="clear:both"></div>
		</div>
		<!-- /.main-container-->
		<div class="gap"></div>
	</div>
</template>

<script type="text/javascript">
import axios from 'axios'
import Flash from '../../../../helper/flash'
import Common from '../../../../helper/common'
import {post} from '../../../../helper/api'
import CartAction from '../../../../helper/cart'

export default {
    data() {
        return {
             	CartProduct: CartAction.data,
             	shippingList:{},
				zoneList:{},
             	activeTab: 0,
             	get_checkout_address:[],
             	rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 16 || 'Username must be less than 16 characters'
				    ],
					store_id:[
						(v) => !!v.length > 0 || 'Store is required'
					],
					tax_rules_group_id:[
						(v) => !!v || 'Tax Class is required'
					],
					
					delay: [
				      (v) => !!v || 'Transmit time is required'
				    ],
					
				   
				},
             	selectItem:{
             		country:{},
             		shipping_zone:{},
             		payment_zone:{},
             	},
             	data:{
     //         		firstname:'',
					// lastname:'',
					// email:'',
					// telephone:'',
					// fax:'',
					// custom_field:'',


					shipping_firstname:'',
					shipping_lastname:'',
					shipping_company:'',
					shipping_email:'',
					shipping_telephone:'',
					shipping_address_1:'',
					shipping_address_2:'',
					shipping_country:'',
					shipping_city:'',
					shipping_zone:'',
					shipping_postcode:'',
					shipping_custom_field:'',
					shipping_address_format:'',
					shipping_country_id:'',
					shipping_zone_id:'',
					shipping_method:'',
					shipping_code:'',

					same_as_shipping:true,
					payment_firstname:'',
					payment_lastname:'',
					payment_company:'',
					payment_email:'',
					payment_telephone:'',
					payment_address_1:'',
					payment_address_2:'',
					payment_country:'',
					payment_city:'',
					payment_zone:'',
					payment_postcode:'',
					payment_custom_field:'',
					payment_address_format:'',
					payment_country_id:'',
					payment_zone_id:'',
					payment_method:'',
					payment_code:'',
					comment:'',


					total:'',
					


					affiliate_id:'',
					commission:'',
					marketing_id:'',
					tracking:'',
					currency_id:'',
					currency_code:'',
					currency_value:'',
					order_status_id:'',
					ip:'',
					forwarded_ip:'',
					user_agent:'',
					language_id:'',
					accept_language:'',
					
             	},
             	tabs:[{
					name:'ADDRESS', 
					description:'TO ADD A NEW ADDRESS, PLEASE FILL OUT THE FORM BELOW.',
					button:'Customer address',
					class:'',
					iconDisplay:'fa fa-map-marker',
					group:[{
							class:'col-xs-12 col-sm-6',
							data:[
								{key:'payment_firstname',type:'text',label:'First Name',Value:'First Name'},
								{key:'payment_lastname',type:'text',label:'Last Name',Value:'Last Name'},
								{key:'payment_company',type:'text',label:'Company',Value:'Company'},
								{key:'payment_email',type:'text',label:'Mobile phone',Value:'Mobile phone'},
								{key:'payment_telephone',type:'text',label:'Email',Value:'Email '},
								{key:'payment_address_1',type:'text',label:'Address',Value:'Address'},
								{key:'payment_address_2',type:'text',label:'Address (Line 2)',Value:'Address'},
							]
						},
						{
							class:'col-xs-12 col-sm-6',

							data:[
								{key:'payment_country_id',type:'select',label:'Country',value:'Select Country',item:'country',change:'payment_zone'},
								{key:'payment_city',type:'text',label:'City',value:'City'},
								{key:'payment_zone_id',type:'select',label:'State',value:'Select State',item:'payment_zone'},
								{key:'payment_postcode',type:'text',label:'Zip / Postal Code',Value:'Zip / Postal Code'},
								{key:'payment_custom_field',type:'textarea',label:'Additional information',Value:'Additional information'},
								{key:'payment_address_format',type:'text',label:'Please assign an address title for future reference.',Value:'My address'},
							],
						}
					],
				},
				{
					name:'BILLING', 
					description:'To add a billing address, please fill out the form below.',
					button:'Billing address',
					class:'',
					iconDisplay:'fa fa-envelope',
					group:[{
							class:'col-xs-12 col-sm-6',
							data:[
								{key:'shipping_firstname',type:'text',label:'First Name',Value:'First Name'},
								{key:'shipping_lastname',type:'text',label:'Last Name',Value:'Last Name'},
								{key:'shipping_company',type:'text',label:'Company',Value:'Company'},
								{key:'shipping_email',type:'text',label:'Mobile phone',Value:'Mobile phone'},
								{key:'shipping_telephone',type:'text',label:'Email',Value:'Email '},
								{key:'shipping_address_1',type:'text',label:'Address',Value:'Address'},
								{key:'shipping_address_2',type:'text',label:'Address (Line 2)',Value:'Address'},
							]
						},
						{
							class:'col-xs-12 col-sm-6',
							data:[
								{key:'shipping_country',type:'select',label:'Country',value:'Select Country',item:'country',change:'shipping_zone'},
								{key:'shipping_city',type:'text',label:'City',value:'City'},
								{key:'shipping_zone',type:'select',label:'State',value:'Select State',item:'shipping_zone'},
								{key:'shipping_postcode',type:'text',label:'Zip / Postal Code',Value:'Zip / Postal Code'},
								{key:'shipping_custom_field',type:'textarea',label:'Additional information',Value:'Additional information'},
								{key:'shipping_address_format',type:'text',label:'Please assign an address title for future reference.',Value:'My address'},
							],
						}
					],
				},
				{
					name:'SHIPPING', 
					description:'Choose your delivery method',
					button:'Shipping address',
					class:'',
					iconDisplay:'fa fa-truck',
					
				},
				{
					name:'PAYMENT', 
					description:'Payment method',
					button:'Payment Method',
					iconDisplay:'fa fa-money',
				},
				{
					name:'ORDER', 
					description:'Review Order',
					button:'Order',
					class:'',
					iconDisplay:'fa fa-check-square',
				},
			],
				
        }
    },
    components:{

    },
    mounted(){
    	axios.get('/api/getLocations/').then(response => this.selectItem.country=response.data);
    	axios.get('/api/getShipping/').then(response => this.shippingList=response.data);
		axios.get('/api/getGeoZone/').then(response => this.zoneList=response.data);
    	// render dom select
    	// $('select.form-control').select2();
    	// The currently active tab, init as the 1st item in the tabs array
		this.activeTabName = this.tabs[1].name;
    },
    ready() {
       
    },
    created() {
    	this.getCheckoutAddress()
    },
    methods: {
    	getCheckoutAddress() {
            axios.get(`/api/get_checkout_address`)
	        .then(response => {
	            this.get_checkout_address = response.data['data']
	            this.isActive = !this.isActive
	        })
	        .catch(e => {
	          this.errors.push(e)
	        })
        },
    	Submit() {
	      axios.post('/checkout',this.data)
			 .catch(function (error) { console.log(error); });
	    },
	    onchange(item,id){
	    	if (item) {
		    	axios.get('/api/getLocations/'+id).then(response => this.selectItem[item]=response.data);
	    	}
	    },
	    test(t){
	    	alert(t)
	    }
	    
    },
    
}
</script>