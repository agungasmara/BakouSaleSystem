<?php

namespace App\Http\Controllers\Backend\Weights;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Weight\Weight;
use App\Http\Models\Backend\Weight\WeightDescription;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class WeightsController extends Controller
{
    public function index()
    {
        $Weights=Weight::AllWeights();
        return response()->json($Weights);
    }
    public function store(Request $request)
    {
        $data=$request['data'];
        $weighDesc=$request['data'];
        $weighDesc=array_except($weighDesc,['value']);
        $weight=[
        	'value'=>$data['value']
        ];
        $weiCond=[
            'value'=>$data['value']
        ];
        
        $saveWeight = (new DataAction)->StoreData(Weight::class,$weiCond,"",$weight);

    	$weightID=Weight::where('value',$data['value'])->get(['weight_class_id']);
    	foreach($weightID as $key=>$value){
        	$weighDesc['weight_class_id']=$value->weight_class_id;
        }
    	return (new DataAction)->StoreData(WeightDescription::class,[],"",$weighDesc);  

    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $Weights=Weight::WeightEdit($id);
        foreach($Weights as $weight){
        	$weightArr=$weight;
        }
        return response()->json($weightArr);
    }
    public function update(Request $request,$id)
    {
         $data=$request['data'];
        $weighDesc=$request['data'];
        $weighDesc=array_except($weighDesc,['value']);
        $weight=[
        	'value'=>$data['value']
        ];
        $saveWeight = (new DataAction)->UpdateData(Weight::class,$weight,'weight_class_id',$id);
    	return (new DataAction)->UpdateData(WeightDescription::class,$weighDesc,'weight_class_id',$id);
    } 
    public function destroy($id)
    {
        return (new DataAction)->DeleteData(Weight::class,'weight_class_id',$id);
    }
}
