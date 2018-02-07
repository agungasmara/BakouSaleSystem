import axios from 'axios'
export default{
	data: {
		products:{},
		isActive:true
	},
	AddToCart(product_id,quantity=1,session_id){
		
		axios.post('/AddToCart', { product_id, quantity, session_id})
			 .then(this.MyProduct(session_id))
			 .catch(function (error) { console.log(error); });
				
	},

	UpdateCart(product_id,quantity){
		
		axios.post('/UpdateCart', { product_id, quantity })
			 .then(this.MyProduct(session_id))
			 .catch(function (error) { console.log(error); });
				
	},

	RemoveFromCart(product_id,session_id){
		
		axios.post('/RemoveFromCart', { product_id,session_id })
			 .then(this.MyProduct(session_id))
			 .catch(function (error) { console.log(error); });
				
		
	},
	MyProduct(session_id){
		axios.get('/api/product_cart?session_id='+session_id).then(response => this.data.products=response.data)
		
	},
	
	
}