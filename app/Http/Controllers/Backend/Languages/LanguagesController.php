<?php

namespace App\Http\Controllers\Backend\Languages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Language\Language;
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
        $success=false;
        $saved=Language::create([
            'name'=>$request->name,
            'code'=>$request->code,
            'locale'=>$request->local,
            'directory'=>$request->directory,
            'sort_order'=>$request->sort_order,
            'image'=>$request->image,
            'status'=>$request->status
        ]);
        if($saved){
            $success=true;
        }else{
            $success=false;
        }

        return response()->json([
            'success'=>$success,
            'message'=>'Data successfully saved.'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
