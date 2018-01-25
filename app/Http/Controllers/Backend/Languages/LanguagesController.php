<?php

namespace App\Http\Controllers\Backend\Languages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Language\Language;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Backend\commons\ImageMaker;
/*
    this controller use for create any validation function
    currently it have one function to validate data if exist or not yet exist
    then return the json to pass to axios.get() in veujs
    this function there are 3 parameter(tablename,fieldname,value)
        - tablename: table that we want to check
        - fieldname: field of that table we want to filter
        - value: value of field we want to check
*/
use App\Http\Controllers\Backend\commons\ValidateDataController;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class LanguagesController extends Controller
{
    public function index()
    {
        $Languages = Language::all();
        return response()->json($Languages);
    }
    public function store(Request $request)
    {
        $data=$request['data'];
        
        $condition=[
            'name'=>$data['name']
        ];

        return (new DataAction)->StoreData(Language::class,$condition,"",$data);
    }
    public function show($id)
    {

    }
    public function edit($id)
    {

    }
    public function update(Request $request,$id)
    {

    }
    public function destroy($id)
    {
    	return (new DataAction)->DeleteData(Language::class,'language_id',$id);
    }
}
