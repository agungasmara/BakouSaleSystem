<?php

    namespace App\Http\Controllers\FrontEnd\Account;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Http\Models\FrontEnd\Account\Address;
    use Carbon\Carbon;
    use DB;
    use Session;

    class AccountController extends Controller
    {
        /**
         * Display a listing of the BestSeller Create On 01-02-2018
         *
         * @return \Illuminate\Http\Response
         */

        public function __construct(){
            $this->middleware('auth:account');
            // $this->middleware('auth:customer', ['except' => ['logout']]);
        }

        public function customer(){
            return view('frontend.index');
            // return redirect("/account/login");
        }

        public function customers(){
            echo "testtest";
        }

        public function login(){
            echo "login";
        }

        public function index(){
            
            return response()->json(['data'=>$products,'success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId')]);

        }

    }