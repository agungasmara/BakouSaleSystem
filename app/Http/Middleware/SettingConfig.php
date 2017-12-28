<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use App;

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
        // SettingConfig
        $store_id=isset($store_id) ? $store_id : 0 ;
        $SettingConfig = DB::table('setting')->where('store_id',$store_id)->get(); 
        foreach ($SettingConfig as $key => $value) {
            define($value->key, $value->value);
        }
       return $next($request);
       
    }
}
