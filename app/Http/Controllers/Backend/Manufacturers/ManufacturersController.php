<?php

namespace App\Http\Controllers\BackEnd\Manufacturers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Manufacturer\Manufacturer;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class ManufacturersController extends Controller
{
    public function index()
    {
        $Currencies=Manufacturer::AllManufacturers();
        return response()->json($Currencies);
    }
    public function store(Request $request)
    {
        $data=$request['data'];
        
        $condition=[
            'title'=>$data['title']
        ];

        return (new DataAction)->StoreData(Manufacturer::class,$condition,"",$data);
        //return response()->json($data);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $Weights=Manufacturer::ManufacturerEdit($id);
        foreach($Weights as $weight){
        	$weightArr=$weight;
        }
        return response()->json($weightArr);
    }
    public function update(Request $request,$id)
    {
         $data=$request['data'];
         return (new DataAction)->UpdateData(Manufacturer::class,$data,'Manufacturer_id',$id);
    }
    public function destroy($id)
    {
        return (new DataAction)->DeleteData(Manufacturer::class,'Manufacturer_id',$id);
    }
}
