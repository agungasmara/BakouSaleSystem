<?php

namespace App\Http\Controllers\FrontEnd\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Account\Address;
use Carbon\Carbon;
use DB;
use Session;

class WishlistController extends Controller
{
    /**
     * Display a listing of the BestSeller Create On 01-02-2018
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	session_start();
    	if(isset($_SESSION["account_id"])){
            $Address = Address::where('customer_id',$_SESSION["account_id"])->get();

            $Products = DB::table('product')
                    ->select('product.*','product_description.*')
                    ->Join('product_description','product.product_id','=','product_description.product_id')
                    ->Join('customer_wishlist','customer_wishlist.product_id','=','product.product_id')
                    ->Join('product_to_store','product.product_id','=','product_to_store.product_id')
                    ->where('product_description.language_id',1)
                    // ->where('product.status',1)
                    ->where('product_to_store.store_id',0)
                    // ->groupBy('product_description.name')
                    // ->groupBy('customer_wishlist.product_id')
                    ->get();

            $data = array();
            foreach ($Products as $Product) {
                $data[] = array('product_id'=>$Product->product_id,'name'=>$Product->name,'image'=>$Product->image,'price'=>$Product->price);
            }
            // dd($array);
    		return response()->json(['data'=>$data,'success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId')]);
        }else{
          	return response()->json(['success' => false, 'message' => 'Unauthorise']);
        }
    }
}