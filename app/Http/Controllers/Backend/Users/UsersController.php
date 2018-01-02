<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BackEnd\User\User;

class UsersController extends Controller
{
    public function list()
    {
    	$users=DB::table('user')
    			  ->join('user_group','user_group.user_group_id','=','user.user_group_id')
    			  ->select('user_id','user_group.name as group','username','firstname','lastname','email','image','code','status','date_added')
    			  ->get();
    	return response()->json($users);
    }
    public function store(Request $request)
    {
    	$success=false;
    	$saved=User::create([
    		'username'=>$request->username,
			'firstname'=>$request->fname,
			'lastname'=>$request->lname,
			'user_group_id'=>$request->userGroup,
			'image'=>$request->userImage,
			'email'=>$request->email,
			'password'=>bcrypt($request->password),
			'code'=>$request->code,
			'status'=>$request->status,
			'ip'=>$request->ip(),
			'salt'=>'xy390xz',
			'date_added'=>date('Y-m-d H:i:s')
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
    public function getUserByID($id)
    {
    	$suers=User::get()->where('user_id',$id);
    	foreach ($suers as $key => $value) {
    		return response()->json([
	    		'username'=>$value->username,
	    		'group'=>$value->user_group_id,
	    		'firstname'=>$value->firstname,
	    		'lastname'=>$value->lastname,
	    		'email'=>$value->email,
	    		'code'=>$value->code,
	    		'image'=>$value->image,
	    		'date_added'=>$value->date_added,
	    		'status'=>$value->status
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
    public function update(Request $request,$id)
    {
    	
    	User::where('user_id',$id)->update([
    		'user_group_id'=>$request->userGroup,
    		'username'=>$request->username,
			'firstname'=>$request->fname,
			'lastname'=>$request->lname,
			'email'=>$request->email,
			'password'=>bcrypt($request->password),
			'code'=>$request->code,
			'image'=>$request->userImage,
			'status'=>$request->status,
			'ip'=>$request->ip(),
			'salt'=>'xy390xz',
			'date_added'=>date('Y-m-d H:i:s')
    	]);
    	return response()->json([
    		'success'=>true,
    		'message'=>'Data successfully updated.'
    	]);
    }
}
