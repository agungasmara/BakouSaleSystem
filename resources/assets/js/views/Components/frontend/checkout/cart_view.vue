<template>
	<div v-bind:class="{ active: isActive }" class="loading">
		<div class="container main-container headerOffset">
		    <div class="row">
		        <div class="breadcrumbDiv col-lg-12">
		            <ul class="breadcrumb">
		                <li><router-link to="/">Home</router-link></li>
		                <li class="active">Cart</li>
		            </ul>
		        </div>
		    </div>
		    <!--/.row-->

		    <div class="row">
		        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs">
		            <h1 class="section-title-inner">
		            	<span>
		            		<i class="glyphicon glyphicon-shopping-cart"></i> Shopping cart 
		            	</span>
		            </h1>
		        </div>
		        <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar col-xs-6 col-xxs-12 text-center-xs">
		            <h4 class="caps">
		            	<a href=""><i class="fa fa-chevron-left"></i> Back to shopping</a>
		            </h4>
		        </div>
		    </div>
		    <!--/.row-->

		    <div class="row">
		        <div class="col-lg-9 col-md-9 col-sm-7">
		            <div class="row userInfo">
		                <div class="col-xs-12 col-sm-12">
		                    <div class="cartContent w100">
		                        <table class="cartTable table-responsive" style="width:100%">
		                            <tbody>

		                            <tr class="CartProduct cartTableHeader">
		                                <td style="width:15%"> Product</td>
		                                <td style="width:40%">Details</td>
		                                <td style="width:10%" class="delete">&nbsp;</td>
		                                <td style="width:10%">QNT</td>
		                                <td style="width:10%">Discount</td>
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
		                                <td class="delete"><a @click="RemoveFromCart(product.product_id)" title="Delete"> <i class="glyphicon glyphicon-trash fa-2x"></i></a></td>
		                                <td><input class="quanitySniper" type="text" v-model="product.cart_quantity" name="quanitySniper" @keyup="UpdateCart(product.product_id,product.cart_quantity)"></td>
		                                <td>0</td>
		                                <td class="price">$ {{product.price * product.cart_quantity}}</td>
		                            </tr>
		                            <tr v-if="!CartProduct.products.data">
		                            	<td colspan="6" align="center">Your shopping cart is empty!</td>
		                            </tr>

		                            </tbody>
		                        </table>
		                    </div>
		                    <!--cartContent-->

		                    <div class="cartFooter w100">
		                        <div class="box-footer">
		                            <div class="pull-left">
		                            	<router-link to="/" class="btn btn-default">
	                                     	<i class="fa fa-arrow-left"></i> 
		                            		&nbsp; Continue shopping 
	                                    </router-link>
		                            </div>
		                            <!-- <div class="pull-right">
		                                <button type="submit" class="btn btn-default">
		                                	<i class="fa fa-undo"></i> &nbsp; Update
		                                    cart
		                                </button>
		                            </div> -->
		                        </div>
		                    </div>
		                    <!--/ cartFooter -->

		                </div>
		            </div>
		            <!--/row end-->

		        </div>
		        <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar">
		            <div class="contentBox">
		                <div class="w100 costDetails">
		                    <div class="table-block" id="order-detail-content">
		                    	<router-link class="btn btn-primary btn-lg btn-block " title="checkout" to="/account/checkout" style="margin-bottom:20px"> 
		                    		Proceed to checkout &nbsp; <i class="fa fa-arrow-right"></i>
		                    	</router-link>

		                        <div class="w100 cartMiniTable">
		                            <table id="cart-summary" class="std table">
		                                <tbody>
		                                <tr>
		                                    <td>Total products</td>
		                                    <td class="price">$ {{CartProduct.products.TotalPrices}}</td>
		                                </tr>
		                                <tr style="">
		                                    <td>Shipping</td>
		                                    <td class="price"><span class="success">Free shipping!</span></td>
		                                </tr>
		                                <tr class="cart-total-price ">
		                                    <td>Total (tax excl.)</td>
		                                    <td class="price">$ {{CartProduct.products.TotalPrices}}</td>
		                                </tr>
		                                <tr>
		                                    <td>Total tax</td>
		                                    <td class="price" id="total-tax">$0.00</td>
		                                </tr>
		                                <tr>
		                                    <td> Total</td>
		                                    <td class=" site-color" id="total-price">$ {{CartProduct.products.TotalPrices}}</td>
		                                </tr>
		                                <tr>
		                                    <td colspan="2">
		                                        <div class="input-append couponForm">
		                                            <input class="col-lg-8" id="appendedInputButton" type="text"
		                                                   placeholder="Coupon code">
		                                            <button class="col-lg-4 btn btn-success" type="button">Apply!</button>
		                                        </div>
		                                    </td>
		                                </tr>
		                                </tbody>
		                                <tbody>
		                                </tbody>
		                            </table>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <!-- End popular -->
		        </div>
		        <!--/rightSidebar-->

		    </div>
		    <!--/row-->

		    <div style="clear:both"></div>
		</div>
		<!-- /.main-container -->
		<div class="gap"></div>
	</div>
</template>
<script>
import Flash from '../../../../helper/flash'
import CartAction from '../../../../helper/cart'
export default {
	data() {
	    return {
	    	isActive: false,
	    	CartProduct: CartAction.data,
	    }
	},
	components:{
	    
	},
	created(){
	    // CartAction.MyProduct();
	    // console.log(CartAction.data);
	},
	methods: {
		RemoveFromCart(product_id){
			CartAction.RemoveFromCart(product_id)
		},
		AddToCart(product_id,qty=1){
            CartAction.AddToCart(product_id,qty)
            // window.scrollTo(100,100)
        },
        UpdateCart(product_id,qty){
            CartAction.UpdateCart(product_id,qty)
            // window.scrollTo(100,100)
        }
	},
	
  
}
</script>