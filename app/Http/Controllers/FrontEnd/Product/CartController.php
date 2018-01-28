<?php namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Cart;
use App\Http\Models\FrontEnd\Category;
use App\Http\Models\FrontEnd\Customer;
use App\Http\Models\FrontEnd\Product;
use App\Http\Models\FrontEnd\ProductDescription;
use App\Http\Models\FrontEnd\SessionModel;
use App\Http\Models\FrontEnd\Order\OrderModel;
use App\Http\Models\FrontEnd\Order\OrderHistory;
use App\Http\Models\FrontEnd\Order\OrderOption;
use App\Http\Models\FrontEnd\Order\OrderProduct;
use App\Http\Models\FrontEnd\Order\OrderShipment;
use App\Http\Models\FrontEnd\Order\OrderStatus;
use App\Http\Models\FrontEnd\Order\OrderTotal;
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
    public function UpdateCart(Request $request)
    {
        return Cart::UpdateCart($request->all());
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
        $datas['data']=$datas['data']->toArray();
        return $datas;
    }
    public function Checkout(Request $request)
    {
        $request['invoice_no']='00001';
        $request['invoice_prefix']='cc_';
        $request['store_id']=0;
        $request['store_name']='test';
        $request['store_url']='test';
        $request['customer_id']=0;
        $request['customer_group_id']=0;
        $request['order_status_id']=0;
        $request['affiliate_id']=0;
        $request['commission']=0;
        $request['marketing_id']=0;
        $request['tracking']=0;
        $request['language_id']=2;
        $request['currency_id']=1;
        $request['currency_code']='$';
        $request['currency_value']='2';
        $request['name']='test';
        $request['comment']='test';
        $request['ip']=$request->ip();
        $request['forwarded_ip']=$request->ip();
        $request['user_agent']=$request->server('HTTP_USER_AGENT');
        $request['accept_language']=2;
        $request['date_added']=date('Y-m-d');
        $request['date_modified']=date('Y-m-d');
        $request['reward']='8438';
        $request['total']=$this->ProductCart()['TotalPrices'];


        // return $request;

        $order = (new OrderModel)->getFillable();
        $order = $request->only($order);
        $orderId=OrderModel::insertGetId($order);

        $request['order_id']=$orderId;

        $request['order_status_id']=1;

        $data = (new OrderHistory)->getFillable();
        $data = $request->only($data);
        OrderHistory::insert($data);


        foreach ($this->ProductCart()['data'] as $product) {
            foreach ($product as $key => $value) {
                $request[$key]=$value;
            }

            $data = (new OrderProduct)->getFillable();
            $data = $request->only($data);
            $OrderProductId=OrderProduct::insertGetId($data);
            $request['order_product_id']=$OrderProductId;
            $request['product_option_id']=0;
            $request['value']=0;
            $request['type']=0;
                
            $data = (new OrderOption)->getFillable();
            $data = $request->only($data);
            OrderOption::insert($data);
        }

        $data = (new OrderShipment)->getFillable();
        $data = $request->only($data);
        OrderShipment::insert($data);

        $request['code']=0;
        $request['title']=0;

        $data = (new OrderTotal)->getFillable();
        $data = $request->only($data);
        OrderTotal::insert($data);
    }
}
