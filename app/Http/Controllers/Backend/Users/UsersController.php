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
    	return response()->json(
    		User::all()
    	);
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
    	/*return response()->json([
    		'username'=>$request->username,
			'first_name'=>$request->fname,
			'last_name'=>$request->lname,
			'user_group_id'=>$request->userGroup,
			'image'=>$request->userImage,
			'email'=>$request->email,
			'password'=>bcrypt($request->password),
			'code'=>$request->code,
			'status'=>$request->status,
			'ip'=>$request->ip(),
			'date_added'=>date('Y-m-d H:i:s')
		]);*/
    }
    public function getUserByID($id)
    {

    }
    public function update(Request $request,$id)
    {

    }
    public function destroy($id)
    {

    }
}
