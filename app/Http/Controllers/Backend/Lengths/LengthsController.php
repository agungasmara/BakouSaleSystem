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
        $length=(new Length)->getFillable();
        $length=$request->only($length);
        $lengthDesc=(new LengthDescription)->getFillable();
        $lengthDesc=$request->only($lengthDesc);
        
        $lenCond=[
            'value'=>$length['value']
        ];
        
        $saveLength = (new DataAction)->StoreData(Length::class,$lenCond,"",$length,"length_class_id");

        if($saveLength['success']==true){//check if data save success
            $lengthDesc['length_class_id'] = $saveLength['length_class_id'];//get id from from child array(data)
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
