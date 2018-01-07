<?php

namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Product;
class ProductController extends Controller
{
    // public function GetProduct($num)
    // {
    // 	return Product::take($num)->get();
    // }

    public function index($id){
    	
		$product_info = $this->getProduct($id);
		return response()->json(['data' => $product_info,'success' => true, 'message' => 'Success']);
    }

}
