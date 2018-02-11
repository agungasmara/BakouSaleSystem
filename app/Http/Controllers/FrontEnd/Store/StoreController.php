<?php

    namespace App\Http\Controllers\FrontEnd\Store;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Http\Models\FrontEnd\Account\Address;
    use App\Http\Models\FrontEnd\Account\Customer;
    use Carbon\Carbon;
    use DB;
    use Auth;
    use Session;

    class StoreController extends Controller
    {
        /**
         * Display a listing of the BestSeller Create On 01-02-2018
         *
         * @return \Illuminate\Http\Response
         */

        public function __construct(){
            // $this->middleware('auth:account');
            // $this->middleware('auth:customer', ['except' => ['logout']]);
        }

        public function index(){
            
        }

        public function show($id){
            $StoreData = DB::table('setting')->Where('store_id',$id)->get();
            $data = [];
            $str = '';
            foreach ($StoreData as $key => $value) {
                define('store_'.$value->key, $value->value);
            }
            $store = array(
                'config_image'=>store_config_image,
                'config_email'=>store_config_email,
                'config_url'=>store_config_url
            );
            return response()->json($store);
        }


        public function edit($id){

        }

        public function destroy(){

        }

        public function store(){

        }

    }