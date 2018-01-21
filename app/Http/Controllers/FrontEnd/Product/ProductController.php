<?php

namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Product;
use DB;
use Carbon\Carbon;
class ProductController extends Controller
{

    public function index($id){
    	// Get Info product Details
		$productInfo = $this->getProduct($id);	
		// Get Discount
		$discounts = $this->getProductDiscounts($id);
		// dd($discounts);
		$discount_arr = array();
		foreach ($discounts as $discount) {
			$discount_arr[] = array(
				'quantity' => $discount->quantity,
				'price' => $discount->price
			);
		}
		return response()->json(['data' => $productInfo,'success' => true, 'message' => 'Success']);
    }
    
    public function getProductDiscounts($product_id) {
		// $query = DB::table('product_discount')
		// 		->where('product_id',$product_id)
		// 		->where('customer_group_id',1)
		// 		->where('quantity','>',1)
		// 		// ->where('date_start','=','0000-00-00','or','date_start','<',Carbon::today())
		// 		// ->where('date_end','=','0000-00-00','or','date_end','<',Carbon::today())	
		// 		->orderBy('quantity','asc')
		// 		->orderBy('priority','asc')
		// 		->orderBy('price','asc')
		// 		->get();
		$query = DB::select("SELECT * FROM ".env('DB_PREFIX')."product_discount 
				WHERE product_id = '".(int)$product_id."'
				AND customer_group_id = '".config_customer_group_id."'
				AND quantity > 1 
				AND ((date_start = '0000-00-00' OR date_start < NOW()) 
				AND (date_end = '0000-00-00' OR date_end > NOW())) 
				ORDER BY quantity ASC, priority ASC, price ASC");
		return $query;
	}

}
