<?php

namespace App\Http\Controllers\FrontEnd\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Account\Customer;
use DB;
use Carbon\Carbon;
use Session;

class RegisterController extends Controller
{
    /**
     * Display Register Account
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $get = Customer::get();
    }
    public function store(Request $request)
    {
        $success=false;
        $msg = '';
        $data = $request->all();             
        $mail = $this->getMails($request->email);
        if($mail){
            return redirect('account/register');
        }else{
            $mailCol = $data['email'];
        }
        $customer = array(
            'customer_group_id'=>1,
            'store_id'=>0,
            'language_id'=>1,
            'firstname'=>$data['firstname'],
            'lastname'=>$data['lastname'],
            'email'=>$mailCol,
            'telephone'=>$data['telephone'],
            'fax'=>$data['fax'],
            'password'=>bcrypt($data['password']),
            'salt'=>1,
            'cart'=>1,
            'wishlist'=>1,
            'newsletter'=>1,
            'address_id'=>1,
            'custom_field'=>2,
            'ip'=>1,
            'status'=>1,
            'safe'=>1,
            'token'=>1,
            'code'=>1,
            'date_added'=>Carbon::today()
        );
        $saved=Customer::create($customer);
        if($saved){
            $success=true;
            $msg = "Data successfully saved";
        }else{
            $success=false;
            $msg = "Already exist!";
        }
        return response()->json([
            'success'=>$success,
            'message'=>$msg,
            'lang'=>Session::get('applangId')?Session::get('applangId'):config_language
        ]);
    }

    public function getMails($mail){
        $getMail = Customer::select('email')->where('email',$mail)->first();
        return $getMail;
    }

}
