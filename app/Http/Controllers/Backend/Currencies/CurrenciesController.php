<?php

namespace App\Http\Controllers\Backend\Currencies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Currency\Currency;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class CurrenciesController extends Controller
{
    public function index()
    {
        $Currencies=Currency::all();
        return response()->json($Currencies);
    }
    public function store(Request $request)
    {
        $data=(new Currency)->getFillable();
        $data=$request->only($data);
        
        $condition=[
            'title'=>$data['title']
        ];

        return (new DataAction)->StoreData(Currency::class,$condition,"",$data);
        //return response()->json($data);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        return (new DataAction)->EditData(Currency::class,$id);
    }
    public function update(Request $request,$id)
    {
         $data=(new Currency)->getFillable();
        $data=$request->only($data);
         return (new DataAction)->UpdateData(Currency::class,$data,'currency_id',$id);
    }
    public function destroy($id)
    {
        return (new DataAction)->DeleteData(Currency::class,'currency_id',$id);
    }
}
