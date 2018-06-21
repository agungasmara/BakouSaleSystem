<?php

namespace App\Http\Controllers\Backend\Carriers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Carrier\Carrier;
use App\Http\Models\Backend\Carrier\CarrierShop;
use App\Http\Models\Backend\Carrier\CarrierZone;
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
        $dir='/images/carrier';
        $image=$request['image'];
        $data['image']=$this->ImageMaker($dir,$image);
        $id = (new DataAction)->StoreData(Carrier::class,[],"",$data,'id');
        foreach ($request['store_id'] as $key => $value) {
            $data=['carrier_id'=>$id['id'],'store_id'=>$value];
            // return $data;
           $response=(new DataAction)->StoreData(CarrierShop::class,[],"",$data);
        }
        
        return $response;
        //return response()->json($data);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $data=Carrier::find($id)->toArray();
        $data['store_id']=CarrierShop::where('carrier_id',$id)->pluck('store_id')->toArray();
        return $data;
    }
    public function update(Request $request,$id)
    {
         $data=(new Carrier)->getFillable();
        $data=$request->only($data);
            $image=$request['image'];
        if ($image) {
            $dir='/images/carrier';
            $data['image']=$this->ImageMaker($dir,$image);
        }
        (new DataAction)->UpdateData(Carrier::class,$data,'carrier_id',$id);
        (new DataAction)->DeleteData(CarrierShop::class,'carrier_id',$id);
        foreach ($request['store_id'] as $key => $value) {
            $data=['carrier_id'=>$id,'store_id'=>$value];
            $deleted=['deleted'=>true,'active'=>false];
           $response=(new DataAction)->StoreData(CarrierShop::class,[],"",$data);
        }
        
        return $response;
    }
    public function destroy($id)
    {
        return (new DataAction)->DeleteData(Carrier::class,'carrier_id',$id);
    }
}
