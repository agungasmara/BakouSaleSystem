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
    public function getGeoZone()
    {

        $GeoZone=DB::table('geo_zone')->select(['geo_zone_id as value','name as text'])->get();

        return response()->json($GeoZone);

    }
    public function getTaxRate()
    {

        $TaxRate=DB::table('tax_rate')->select(['tax_rate_id as value','name as text'])->get();

        return response()->json($TaxRate);

    }
    public function getTaxClass()
    {

        $TaxClass=DB::table('tax_class')->select(['tax_class_id as value','title as text'])->get();

        return response()->json($TaxClass);

    }
    public function getCustomerGroup()
    {

        $TaxClass=DB::table('customer_group_description')->select(['customer_group_id as value','name as text'])->get();

        return response()->json($TaxClass);

    }
}
