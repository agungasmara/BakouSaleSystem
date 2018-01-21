<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Category\CategoryModel;
class CategoryController extends Controller
{
    public function index()
    {
        return CategoryModel::getAllCategories()->toArray();
    }

    public function show($id){
        return response()->json([]);
    }

    public function store(Request $request)
    {

        $data=$request->all();

        $condition=[

            'key'=>$request->key,
            'code'=>$request->code

        ];

        return (new DataAction)->StoreData(Setting::class,[],'',$data);

    }

    public function edit($id)
    {
        return (new DataAction)->EditData(Setting::class,'setting_id',$id);
        
    }

    public function update(Request $request,$id)
    {
        
        $data=$request->all();

        return (new DataAction)->UpdateData(Setting::class,$data,'setting_id',$id);

    }

    public function destroy($id)
    {

        return (new DataAction)->DeleteData(Setting::class,'setting_id',$id);
        
    }
    public function menu()
    {
        return CategoryModel::getAllCategories()->groupBy('type')->toArray();
    }
}
