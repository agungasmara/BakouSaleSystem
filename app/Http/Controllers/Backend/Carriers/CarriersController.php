<?php

namespace App\Http\Controllers\Backend\Carriers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Carrier\Carrier;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class CarriersController extends Controller
{
    public function index()
    {
        $Carriers=Carrier::where('active',true)->where('deleted',false)->get();
        return response()->json($Carriers);
    }
    public function store(Request $request)
    {
        $data=(new Carrier)->getFillable();
        $data=$request->only($data);
        
        return (new DataAction)->StoreData(Carrier::class,[],"",$data);
        //return response()->json($data);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        return (new DataAction)->EditData(Carrier::class,$id);
    }
    public function update(Request $request,$id)
    {
         $data=(new Carrier)->getFillable();
        $data=$request->only($data);
         return (new DataAction)->UpdateData(Carrier::class,$data,'carrier_id',$id);
    }
    public function destroy($id)
    {
        return (new DataAction)->DeleteData(Carrier::class,'carrier_id',$id);
    }
}
