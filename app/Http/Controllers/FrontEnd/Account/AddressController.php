<?php

namespace App\Http\Controllers\FrontEnd\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Account\Address;
use Carbon\Carbon;
use DB;
use Auth;
use Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the BestSeller Create On 01-02-2018
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth:account');
    }
        
    public function index(){
    	if(Auth::guard('account')->id()){
            $sec_user_id = Auth::guard('account')->id();
            $Address = Address::getAddress($sec_user_id);
            return response()->json(['data'=>$Address,'success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId')]);
        }else{
          	return response()->json(['success' => false, 'message' => 'Unauthorise'],404);
        }
    }

    public function getCheckoutAddress(){
        $sec_user_id = Auth::guard('account')->id();
        $Address = Address::getCheckoutAddress($sec_user_id);
        return response()->json(['success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId'),'data'=>$Address]);
    }

}