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
use App\Http\Controllers\Backend\commons\ImageMaker;
class ManufacturersController extends Controller
{
    public function index()
    {
        $Currencies=Manufacturer::all();
        return response()->json($Currencies);
    }
    public function store(Request $request)
    {

    	$data=(new Manufacturer)->getFillable();
        $data=$request->only($data);
        $data['image']=(new ImageMaker)->base64ToImage('images\\icon',$data['image']);
        $condition=[
            'name'=>$data['name']
        ];

        return (new DataAction)->StoreData(Manufacturer::class,$condition,"",$data);
        //return response()->json($data);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        return (new DataAction)->EditData(Manufacturer::class,$id);
    }
    public function update(Request $request,$id)
    {
        $data=(new Manufacturer)->getFillable();
        $data=$request->only($data);
        $data['image']=(new ImageMaker)->base64ToImage('images\\icon',$data['image']);
        
        return (new DataAction)->UpdateData(Manufacturer::class,$data,'manufacturer_id',$id);
    }
    public function destroy($id)
    {
    	$image = Manufacturer::find($id);
        (new ImageMaker)->deleteFile($image->image);
        return (new DataAction)->DeleteData(Manufacturer::class,'manufacturer_id',$id);
        //return response()->json(['image'=>$file,'filename'=>$filename]);
    }
    public function getManufacturers()
    {
        return Manufacturer::select('name as text','manufacturer_id as value')->orderBy('sort_order')->get();
    }
}
