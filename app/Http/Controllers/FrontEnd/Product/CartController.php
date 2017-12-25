<?php namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Cart;
use App\Http\Models\FrontEnd\Category;
use App\Http\Models\FrontEnd\Customer;
use App\Http\Models\FrontEnd\Product;
use App\Http\Models\FrontEnd\SessionModel;
use Illuminate\Support\Facades\Input;
use DB;
use App\user;
use Carbon\Carbon;
use Auth;
use Session;
use Validator;
use rules;
use Redirect;
use View;

class CartController extends Controller
{	
	public function __construct()
    {   

        
      
    } 

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        return view('frontend.index');
    }

    public function AddToCart(Request $request)
    {
       return Cart::AddToCart($request->all());
    }
    public function RemoveFromCart(Request $request)
    {
       return Cart::RemoveFromCart($request->all());
    }
    public function ProductCart()
    {
        // dd("test");
    	if (Auth::check()) {
    		return $data['MyCart']=Customer::find(Auth::user()->customer_id)->Cart()->get();
    	}else{
    		return $data['MyCart']=SessionModel::find(session()->getId())->Cart()->get();
    	}
    }
}
