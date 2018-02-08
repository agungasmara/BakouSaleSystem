<?php

namespace App\Http\Controllers\FrontEnd\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Account\Address;
use Carbon\Carbon;
use DB;
use Session;

class AddressController extends Controller
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
    		return response()->json(['data'=>$Address,'success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId')]);
        }else{
          	return response()->json(['success' => false, 'message' => 'Unauthorise']);
        }
    }
}