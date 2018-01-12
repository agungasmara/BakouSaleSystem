<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BackEnd\User\User;
use Intervention\Image\ImageManagerStatic as Image;
//this controller use for create any validation function
//currently it have one function to validate data if exist or not yet exist
//then return the json to pass to axios.get() in veujs
/*
    this function there are 3 parameter(tablename,fieldname,value)
        - tablename: table that we want to check
        - fieldname: field of that table we want to filter
        - value: value of field we want to check
*/
use App\Http\Controllers\Backend\commons\ValidateDataController;

class UsersController extends Controller
{
    public function list()
    {
<<<<<<< HEAD
    	$users=DB::table('user')
    			  ->join('user_group','user_group.user_group_id','=','user.user_group_id')
    			  ->select('user_id as id','username','user_group.name as group','firstname','lastname','email','user.code as code','image','status','date_added')
    			  ->get('id');
        // $users=User::AllUser();
    	return response()->json($users);
    }
    public function checkIfExisted($field,$value){
=======

        $Users = User::get();
        $data = array();
        foreach ($Users as $User) {
            $data[] = array(
                'name'=>$User->username,
                'user_group'=>$User->UserGroup->name,
            );
        }
        return $data;
    }

    public function checkUser($username){
        
        $existed=false;

        $count = User::where('username', $username)->count();
>>>>>>> 1564b7cccb099c7102afdb680110f1cdd8869aa8

        //instant the object
        $validate=new ValidateDataController;
        if($field=="username"){
            //return data json to vuejs when axios request
            return $validate->CheckDataExist('user','username',$value);    
        }elseif($field=="email"){
            //return data json to vuejs when axios request
            return $validate->CheckDataExist('user','email',$value);
        }
        
    }
    public function store(Request $request)
    {
    	$success=false;
        $image="Test";
      //     if( preg_match('/data:image/', $request->userImage) ){                
      //     preg_match('/data:image\/(?<mime>.*?)\;/', $request->userImage , $groups);
      //     $mimetype = $groups['mime'];
                       
      //     $image='images/TestImage.'.$mimetype;
      //     $image = Image::make($request->userImage)
      //       ->fit(400, 500) 
      //       ->encode($mimetype, 100) 
      //       ->save(public_path($image));                
      // }
        
      
    	$saved=User::create([
    		'username'=>$request->username,
			'firstname'=>$request->fname,
			'lastname'=>$request->lname,
			'user_group_id'=>$request->userGroup,
			'image'=>'',
			'email'=>$request->email,
			'password'=>bcrypt($request->password),
			'code'=>$request->code,
			'status'=>$request->status,
			'ip'=>$request->ip(),
			'salt'=>'xy390xz',
			'date_added'=>date('Y-m-d H:i:s')
    	]);
return $request->all();
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
        $user=User::select('*')->where('user_id',$id);
        $user->delete();
        return response()->json([
            'deleted'=>true,
            'user'=>User::all()
        ]);
    }
    public function update(Request $request,$id)
    {
    	if( preg_match('/data:image/', $request->userImage) ){             
          preg_match('/data:image\/(?<mime>.*?)\;/', $request->userImage , $groups);
          $mimetype = $groups['mime'];
                       
          $firstname='images/testpost.'.$mimetype;
          $image = Image::make($request->userImage)
            // ->fit(400, 500) 
            ->encode($mimetype, 100) 
            ->save(public_path($firstname));                
        } 
    	User::where('user_id',$id)->update([
    		'user_group_id'=>$request->userGroup,
    		'username'=>$request->username,
			'firstname'=>$request->fname,
			'lastname'=>$request->lname,
			'email'=>$request->email,
			'password'=>bcrypt($request->password),
			'code'=>$request->code,
			'image'=>$firstname,
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
