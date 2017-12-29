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
