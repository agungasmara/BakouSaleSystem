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
		                        <ul class="orderStep orderStepLook2">
		                        	<li v-for="(tab, i) in tabs" :class="{'active':activeTab==i}" @click="activeTab=i">
		                        		<a>
			                        		<i :class="tab.iconDisplay"></i> 
			                            	<span>{{tab.name}}</span>
		                        		</a>
		                        	</li>
		                          
		                        	
		                        </ul>
		                        <!--/.orderStep end-->
		                    </div>
		                    <!-- form tabs -->
		                    <div class="w100 clearfix">
		                        <div class="row userInfo" v-for="i in tabs.length">
		                            <div class="col-lg-12" v-show="activeTab==i-1">
		                                <h2 class="block-title-2"> 
		                                	{{tabs[i-1].description}}
		                                </h2>
		                            
		                            </div>
		                        </div>
		                        <!--/row end-->
		                    </div>
		                    <!-- end form -->
		                    
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
			                                    &nbsp; {{tabs[activeTab-1].name}}
		                                	</span>
										</a>
		                            </div>
		                            <div class="pull-right">
		                                <a class="btn btn-primary btn-small" @click="activeTab=activeTab+1">
		                                	<span v-if="activeTab + 1 > tabs.length-1">
		                                		<a @click="Submit()">
				                                    &nbsp; Submit
				                                    <i class="fa fa-arrow-circle-right"></i> 
		                                		</a>
		                                	</span>
		                                	<span v-else>
			                                    &nbsp; {{tabs[activeTab+1].name}}
			                                	<i class="fa fa-arrow-circle-right"></i> 
		                                	</span>
		                             	</a>
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
		                        <td class="price">$216.51</td>
		                    </tr>
		                    <tr style="">
		                        <td>Shipping</td>
		                        <td class="price"><span class="success">Free shipping!</span></td>
		                    </tr>
		                    <tr class="cart-total-price ">
		                        <td>Total (tax excl.)</td>
		                        <td class="price">$216.51</td>
		                    </tr>
		                    <tr>
		                        <td>Total tax</td>
		                        <td class="price" id="total-tax">$0.00</td>
		                    </tr>
		                    <tr>
		                        <td> Total</td>
		                        <td class=" site-color" id="total-price">$216.51</td>
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
             	// List here all available tabs
             	activeTab: 0,
             	tabs:[
						{
							name:'ADDRESS', 
							description:'ADDRESS ADDRESS ADDRESS ADDRESS',
							class:'',
							iconDisplay:'fa fa-map-marker',
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
							],
						},
						{
							name:'BILLING', 
							description:'BILLING BILLING BILLING BILLING',
							class:'',
							iconDisplay:'fa fa fa-envelope',
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
							],
						},
						{
							name:'SHIPPING', 
							description:'SHIPPING SHIPPING SHIPPING SHIPPING',
							class:'',
							iconDisplay:'fa fa-truck',
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
							],
						},
						{
							name:'PAYMENT', 
							description:'PAYMENT PAYMENT PAYMENT PAYMENT',
							class:'',
							iconDisplay:'fa fa-money',
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
							],
						},
						{
							name:'ORDER', 
							description:'ORDER ORDER ORDER ORDER',
							class:'',
							iconDisplay:'fa fa-check-square',
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
							],
						},
					],
				
            }
        },
        components:{

        },
        mounted(){
        	 // The currently active tab, init as the 1st item in the tabs array
    			this.activeTabName = this.tabs[1].name;
        },
        ready() {
           
        },
        methods: {
        	Submit() {
		      alert('Submit');
		    },
		    
        }
    }
</script>