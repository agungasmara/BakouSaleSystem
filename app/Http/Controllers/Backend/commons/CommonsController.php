<?php

namespace App\Http\Controllers\BackEnd\commons;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class CommonsController extends Controller
{
    public function getLanguage()
    {

        $languages=DB::table('language')->select(['language_id as value','name as text'])->get();

        return response()->json($languages);

    }
    public function getCreditType()
    {

        $creditType=DB::table('credit_type')->select(['credit_type_id as value','name as text'])->get();

        return response()->json($creditType);

    }
}
