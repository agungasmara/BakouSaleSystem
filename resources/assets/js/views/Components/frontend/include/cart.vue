<template>
	<div>
		
	    <table >
	        <tbody >

	        <tr v-for="product in CartProduct.products" class="miniCartProduct"  v-if="CartProduct.products.length">
	            <td style="width:20%" class="miniCartProductThumb">
	                <div><a href="product-details.html"> <img src="/assets/frontend/images/product/3.jpg" alt="img"> </a>
	                </div>
	            </td>
	            <td style="width:20%">
	                <div class="miniCartDescription">
	                    <h4><a href="product-details.html"> TSHOP T shirt Black </a></h4>
	                    <span class="size"> {{product.name}} </span>

	                    <div class="price"><span>$ {{product.price}} </span></div>
	                </div>
	            </td>
	            <td style="width:15%" class="miniCartQuantity"><a> X {{product.cart_quantity}} </a></td>
	            <td style="width:20%" class="miniCartSubtotal"><span>$ {{product.price * product.cart_quantity}} </span></td>
	            <td style="width:5%" class="delete"><a @click="RemoveFromCart(product.product_id)"> x </a></td>
	        </tr>
	        <tr v-else>Your shopping cart is empty!</tr>
	        </tbody>
	    </table>
	     <div class="miniCartFooter text-right">
	        <h3 class="text-right subtotal"> Subtotal: $ {{total}} </h3>
	        <a class="btn btn-sm btn-danger" href="/cart"> <i class="fa fa-shopping-cart"> </i> VIEW
	            CART </a><a
	            class="btn btn-sm btn-primary"> CHECKOUT </a>
	    </div>  
	</div>
</template>
<script>
import Flash from '../../../../helper/flash'
import CartAction from '../../../../helper/cart'
export default {
	data() {
	    return {
	    	CartProduct: CartAction.data,
	    	total:0,
	    }
	},
	components:{
	    
	},
	created(){
	    CartAction.MyProduct();
	    // console.log(CartAction.data);
	},
	methods: {
		RemoveFromCart(product_id){
			CartAction.RemoveFromCart(product_id);
		}
	},

  
}
</script>