<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\User\User;
use App\Http\Models\BackEnd\User\UserGroup;
use Illuminate\Support\Facades\DB;

class UserGroupsController extends Controller
{
    public function list()
    {
        return response()->json([
            'success'=>true,
            'mssage'=>'Data Successfully Saved.'
        ]);
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
