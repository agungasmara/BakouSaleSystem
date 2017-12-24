import axios from 'axios'
export default{
	data: {
		products:{},
		TotalPrice:0
	},
	AddToCart(product_id,quantity=1){
		
		axios.post('/AddToCart', { product_id, quantity })
			 .then(this.MyProduct())
			 .catch(function (error) { console.log(error); });
				
	},

	RemoveFromCart(product_id){
		
		axios.post('/RemoveFromCart', { product_id })
			 .then(this.MyProduct())
			 .catch(function (error) { console.log(error); });
				
		
	},
	MyProduct(){
		axios.get('/api/product_cart').then(response => this.data.products=response.data);

	},
	
	
}