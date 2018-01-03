<?php

namespace App\Http\Controllers\Backend\Settings;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Setting\Setting;

class SettingsController extends Controller
{
    public function getStore()
    {
    	$stores=DB::table('store')->select(['store_id as value','name as text'])->get();
    	return response()->json($stores);
    }

    public function store(Request $request)
    {
    	$success=false;
    	$saved=Setting::create([
    		'store_id'=>$request->store,
			'code'=>$request->code,
			'key'=>$request->key,
			'value'=>$request->value,
			'serialized'=>0
    	]);

    	if($saved){
    		$success=true;
    	}else{
    		$success=false;
    	}

    	return response()->json([
    		'success'=>$success,
    		'message'=>'Data successfully saved.'
    	]);
    }

    public function list()
    {
    	$settings=DB::table('setting')
    			  ->join('store','store.store_id','=','setting.store_id')
    			  ->select('setting_id','name','code','key','value','serialized')
    			  ->get();
    	return response()->json($settings);
    }
    
    public function getSettingByID($id)
    {
    	$setting=Setting::get()->where('setting_id',$id);
    	foreach ($setting as $key => $value) {
    		return response()->json([
	    		'code'=>$value->code,
	    		'key'=>$value->key,
	    		'value'=>$value->value,
	    		'store_id'=>$value->store_id
	    	]);
    	}
    	
    }
    public function destroy($id)
    {
        //$id=226;
        $setting=Setting::select('*')->where('setting_id',$id);
        $setting->delete();
        return response()->json([
            'deleted'=>true,
            'settings'=>Setting::all()
        ]);
    }
    public function ppdate(Request $request,$id)
    {
    	
    	Setting::where('setting_id',$id)->update([
    		'store_id'=>$request->store,
    		'code'=>$request->code,
			'key'=>$request->key,
			'value'=>$request->value,
			'serialized'=>0
    	]);
    	return response()->json([
    		'success'=>true,
    		'message'=>'Data successfully updated.'
    	]);
    }
}