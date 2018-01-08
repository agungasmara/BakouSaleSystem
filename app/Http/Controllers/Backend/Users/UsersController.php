<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BackEnd\User\User;
use Intervention\Image\ImageManagerStatic as Image;
class UsersController extends Controller
{
    public function list()
    {
    	$users=DB::table('user')
    			  ->join('user_group','user_group.user_group_id','=','user.user_group_id')
    			  ->select('user_id as id','username','user_group.name as group','firstname','lastname','email','user.code as code','image','status','date_added')
    			  ->get();
    	return response()->json($users);
    }
    public function checkUser($username){
        
        $existed=false;

        $count = User::where('username', $username)->count();

        if($count>0){
            $existed=true;
        }

        return response()->json([
            'usernameExist'=>$existed
        ]);
    }
    public function checkEmail($email){
        
        $existed=false;

        $count = User::where('email', $email)->count();

        if($count>0){
            $existed=true;
        }

        return response()->json([
            'emailExist'=>$existed
        ]);
    }
    public function store(Request $request)
    {
    	$success=false;
        $image="test";

        /*if( preg_match('/data:image/', $request->userImage) ){                
          preg_match('/data:image\/(?<mime>.*?)\;/', $request->userImage , $groups);
          $mimetype = $groups['mime'];
                       
          $image='images/testpost.'.$mimetype;
          $image = Image::make($request->userImage)
            ->fit(400, 500) 
            ->encode($mimetype, 100) 
            ->save(public_path($image));                
      }*/ 
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
