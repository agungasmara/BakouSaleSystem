<?php

namespace App\Http\Controllers\FrontEnd\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Account\Customer;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Session;

class LoginController extends Controller
{
    /**
     * Display Register Account Login
     *
     * @return \Illuminate\Http\Response
     */

    public function AuthLogin(Request $request){
        $success=false;
        $msg = '';
        $input = $request->all();             
        $getPassword = $this->getPassword(trim($input['email']));
        // if(!empty($getPassword)){
        if(!empty($getPassword) && password_verify(trim($input['password']),$getPassword->password))
        {
            $success=true;
            $msg = "Data successfully Login";
        }else{
            $success=false;
            $msg = "Data not successfully Login!";
        }
        // }else{
        //     $success=false;
        //     $msg = "Data not successfully Login!";
        // }

        return response()->json([
            'success'=>$success,
            'message'=> $msg,
            'param'=> $input['email'],
            'lang'=>Session::get('applangId')
        ]);
    }
    public function getPassword($email){
        $row = Customer::select('password')
                            ->where('email',$email)
                            ->first();

        return $row;

    }   
    public function store(Request $request)
    {
        $success=false;
        $msg = '';
        $input = $request->all();             
        //$getPassword = md5($request->password);
        // $loginSave = $this->getMails($request->email);
        // $password = $this->getPasswordCustomer($getPassword);
        $chkHas = $this->chkCustomer($input['email'],bcrypt($input['password']));
        if($chkHas>0)
        {
            $success=true;
            $msg = "Data successfully Login";
        }else{
            $success=false;
            $msg = "Data not successfully Login!";
        }
        return response()->json([
            'success'=>$success,
            'message'=> $msg,
            'lang'=>Session::get('applangId')
        ]);
    }



    public function getMails($mail){
        $getMail = Customer::select('email')
                   ->where('email',$mail)
                   ->first();
        return $getMail;
    }
    public function getPasswordCustomer(){
        $hash = '$2y$10$FKZT7bMZh90Bx1L0FsKrmu/Q5/rOnnC0FRncmxahzba.Gfakzu8b6';
        $password=md5($hash);
        // dd($password);
        $getPassword = Customer::select(DB::raw('md5("password")'))
                   ->where(DB::raw('md5("password")'),md5($password))
                   ->first();
        return $getPassword;
    }

}
