<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use App;
use Auth;

class SettingConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    


    public function __construct()
    {
      
    }


    public function handle($request, Closure $next)
    {  

        // $value = time()+3600;
        // setcookie("TestCookie", $value);
        // setcookie("TestCookie", $value, time()+3600);   expire in 1 hour 
        // setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", 1);

        // dd($_COOKIE["TestCookie"]);

        //**Update Cart Product by customer id Base on Customer Register Or Login** 
        // dd(Auth::guard('account')->id());
        // dd(session()->getId());
        DB::table('cart')->where('session_id',session()->getId())
                         ->update(['customer_id'=>Auth::guard('account')->id()?Auth::guard('account')->id():0]);

        // if(session(['applangId' => 'en']);)
        // SettingConfig
        $store_id=isset($store_id) ? $store_id : 0 ;
        $SettingConfig = DB::table('setting')->where('store_id',$store_id)->get(); 
        foreach ($SettingConfig as $key => $value) {
            define($value->key, $value->value);
        }

        if(!Session::get('applangId')){
            session(['applangId' => config_language]);
        }
       return $next($request);
       
    }
}
