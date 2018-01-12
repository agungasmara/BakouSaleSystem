<?php

namespace App\Http\Controllers\FrontEnd\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RegisterController extends Controller
{
    /**
     * Display Register Account
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $input = $request->all();

        dd($input);

         return response()->json(['data' =>'Helloworld','success' => true, 'message' => 'Success']);
    }

    

}
