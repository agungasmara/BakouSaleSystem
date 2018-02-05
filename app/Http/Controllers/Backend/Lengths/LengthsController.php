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
        //data for length value
        $length=(new Length)->getFillable();
        $length=$request->only($length);

        //Data for length description
        $lengthDesc=(new LengthDescription)->getFillable();
        $lengthDesc=$request->only($lengthDesc);
        
        //condition to check if length value is already existed
        $lenCond=[
            'value'=>$length['value']
        ];
        
        //save length value and return length_class_id to insert to length description
        $saveLength = (new DataAction)->StoreData(Length::class,$lenCond,"",$length,"length_class_id");

        //if length value is insert successfull
        if($saveLength['success']){
            
            //get id from child array(data)
            $lengthDesc['length_class_id'] = $saveLength['length_class_id'];

            //return success message if data have been successfully save to database
            return (new DataAction)->StoreData(LengthDescription::class,[],"",$lengthDesc); 

        }else{

            //if data doesn't saved to database this will return success false and message why data not save
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
