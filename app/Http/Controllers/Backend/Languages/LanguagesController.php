<?php

namespace App\Http\Controllers\Backend\Languages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Language\Language;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages=Language::AllLanguages();
        return response()->json($languages);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $data=[

            'name'=>$request->name,
            'code'=>$request->code,
            'locale'=>$request->local,
            'directory'=>$request->directory,
            'sort_order'=>$request->sort_order,
            'image'=>$request->image,
            'status'=>$request->status

        ];

        return (new DataAction)->StoreData(Language::class,$data);

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {

        return (new DataAction)->EditData(Language::class,$id);

    }

    public function update(Request $request, $id)
    {

        $data=[

            'name'=>$request->name,
            'code'=>$request->code,
            'locale'=>$request->local,
            'directory'=>$request->directory,
            'sort_order'=>$request->sort_order,
            'image'=>$request->image,
            'status'=>$request->status

        ];
        
        return (new DataAction)->UpdateData(Language::class,$data,'language_id',$id);

    }

    public function destroy($id)
    {

        return (new DataAction)->DeleteData(Language::class,$id);

    }
}
