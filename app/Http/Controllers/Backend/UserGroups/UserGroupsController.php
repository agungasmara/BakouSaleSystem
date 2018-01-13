<?php

namespace App\Http\Controllers\Backend\UserGroups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\User\User;
use App\Http\Models\BackEnd\UserGroup\UserGroup;
use Illuminate\Support\Facades\DB;
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

class UserGroupsController extends Controller
{
    public function list()
    {
        //$UserGroup=UserGroup::select('user_group_id as id','name','group_type','permission')->get();
        $UserGroup=DB::select('select user_group_id as id,name,group_type,
            case 
                when length(permission)>0 then concat(substr(permission,1,50),\'...\')
            end as permission 
            from sg_user_group');
        
        return response()->json($UserGroup);
    }
    public function getPermission()
    {

    }
    public function getUsers()
    {
        $users=User::select(['user_id as value','username as text'])->get();
        $userGroup=UserGroup::select(['user_group_id as value','name as text'])->get();
        return response()->json([
            'users'=>$users,
            'groups'=>$userGroup
        ]);
    }
    public function store(Request $request)
    {
        $success=false;
        $saved=UserGroup::create([
            'name'=>$request->groupName,
            'group_type'=>$request->groupType,
            'permission'=>$request->permissions
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
    public function checkIfExisted($field,$value)
    {
        //instant the object
        $validate=new ValidateDataController;
        //return data json to vuejs when axios request
        return $validate->CheckDataExist('user_group',$field,$value);
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
