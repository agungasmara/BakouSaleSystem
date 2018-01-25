<template>
	<div>
		
	    <table >
	        <tbody >

	        	<!-- {{CartProduct.products.data.length}} -->
	        <tr v-if="!CartProduct.products.data.length">
	        	<v-footer class="pa-3">
				    <v-spacer></v-spacer>
				    <center>Your shopping cart is empty!</center>
				  </v-footer>
		    </tr>
	        <tr v-for="product in CartProduct.products.data" v-else  class="miniCartProduct">
	            <router-link v-bind:to="'/product/product_detail/'+ product.product_id">
		            <td style="width:20%" class="miniCartProductThumb">
		                <div><a> <img :src="product.image" alt="img"> </a> </div>
		            </td>
		            <td style="width:20%">
		                <div class="miniCartDescription">
		                    <h4>
		                    		{{product.name}}
		                    </h4>
		                    <span class="size"> <!-- {{product.name}} --> </span>
		                    <div class="price"><span>$ {{product.price*1}} </span></div>
		                </div>
		            </td>
				</router-link>
	            <td style="width:15%" class="miniCartQuantity"><a> X {{product.cart_quantity}} </a></td>
	            <td style="width:20%" class="miniCartSubtotal"><span>$ {{product.price * product.cart_quantity}} </span></td>
	            <td style="width:5%" class="delete"><a @click="RemoveFromCart(product.product_id)"><i class="glyphicon glyphicon-trash"></i></a></a></td>
	        </tr>
	        
	        </tbody>
	    </table>

	     <div class="miniCartFooter text-right" v-if="CartProduct.products.TotalPrices">
	        <h3 class="text-right subtotal"> Total: $ {{CartProduct.products.TotalPrices}} </h3>
	        <router-link to="/cart/cartview" class="btn btn-sm btn-danger">
              <i class="fa fa-shopping-cart"> </i> VIEW CART 
            </router-link>	  
             <router-link to="/cart/checkout" class="btn btn-sm btn-primary">
               CHECKOUT
            </router-link>	        
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