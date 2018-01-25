<?php

namespace App\Http\Controllers\BackEnd\CreditOptions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\CreditOption\CreditType;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class CreditTypesController extends Controller
{
    public function index()
    {

        $CreditType=CreditType::AllCreditType();

        return response()->json($CreditType);
    }

    public function show($id){
        return response()->json([]);
    }

    public function store(Request $request)
    {

        $data=$request['data'];

        $condition=[
            'name'=>$data['name']
        ];

        return (new DataAction)->StoreData(CreditType::class,$condition,'',$data);

    }

    public function edit($id)
    {
        return (new DataAction)->EditData(CreditType::class,$id);
        
    }

    public function update(Request $request,$id)
    {
        
        $data=$request['data'];

        return (new DataAction)->UpdateData(CreditType::class,$data,'credit_type_id',$id);

    }

    public function destroy($id)
    {

        return (new DataAction)->DeleteData(CreditType::class,'credit_type_id',$id);
        
    }
}
