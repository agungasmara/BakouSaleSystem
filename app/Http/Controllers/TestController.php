<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\BackEnd\Setting\Setting;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {

        $condition=['key'=>'123'];

        $count = DB::table('setting')->orWhere($condition)->count();
        $msg="";
        $n=0;
        $and="";
        foreach($condition as $key=>$feild){
            if($n>0){
                $and='and';
            }
            $msg=$msg.' '.$and.' '.$key;
            $n=$n+1;
        }
        return response()->json(['n'=>$count,'msg'=>$msg]);
    }
}
