<?php

namespace App\Http\Controllers\Backend\Lengths;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Length\Length;
use App\Http\Models\Backend\Length\LengthDescription;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class LengthsController extends Controller
{
    public function index()
    {
        $Length=Length::AllLengths();
        return response()->json($Length);
    }
    public function store(Request $request)
    {
        $data=$request['data'];
        $lengthDesc=$request['data'];
        $lengthDesc=array_except($lengthDesc,['value']);
        $length=[
        	'value'=>$data['value']
        ];
        $lenCond=[
            'value'=>$data['value']
        ];
        
        $saveLength = (new DataAction)->StoreData(Length::class,$lenCond,"",$length,"length_class_id");

        if($saveLength['success']==true){
            $lengthDesc['length_class_id'] = $saveLength['data']['length_class_id'];
            return (new DataAction)->StoreData(LengthDescription::class,[],"",$lengthDesc); 
        }else{
            return $saveLength;
        }
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $Length=Length::LengthEdit($id);
        foreach($Length as $length){
        	$lengthArr=$length;
        }
        return response()->json($lengthArr);
    }
    public function update(Request $request,$id)
    {
        $data=$request['data'];
        $LengthDesc=$request['data'];
        $LengthDesc=array_except($LengthDesc,['value']);
        $Length=[
        	'value'=>$data['value']
        ];
        $saveLength = (new DataAction)->UpdateData(Length::class,$Length,'length_class_id',$id);
    	return (new DataAction)->UpdateData(LengthDescription::class,$LengthDesc,'length_class_id',$id);
    } 
    public function destroy($id)
    {
        (new DataAction)->DeleteData(Length::class,'length_class_id',$id);
        return (new DataAction)->DeleteData(LengthDescription::class,'length_class_id',$id);
    }
}
