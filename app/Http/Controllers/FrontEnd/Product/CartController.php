<?php namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Cart;
use App\Http\Models\FrontEnd\Category;
use App\Http\Models\FrontEnd\Customer;
use App\Http\Models\FrontEnd\Product;
use App\Http\Models\FrontEnd\ProductDescription;
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
        // $this->middleware(function ($request, $next) {
        // 	// dd(Auth::check());
        //     SessionModel::AddSession();
        //     $data['MyCart']=SessionModel::find(session()->getId())->Cart()->get();
        //     //dd($data);
        //     View::share($data);
        //     return $next($request);
        // });   
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
        $datas['TotalPrices']=0;
    	if (Auth::check()) {
    		$datas['data']=Customer::find(Auth::user()->customer_id)->Cart()->get();
    	}else{
            $datas['data']=SessionModel::find(session()->getId())->Cart()->get();
        }
        foreach ($datas['data'] as $key => $value) {
            $value->name=ProductDescription::find($value->product_id)->value('name');
            $datas['TotalPrices']+=$value->cart_quantity*$value->price;
        }
        return $datas;
    }
}
