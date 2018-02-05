<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Category\CategoryModel;
use App\Http\Models\BackEnd\Category\CategoryDescription;
use App\Http\Models\BackEnd\Category\CategoryType;
use App\Http\Controllers\Backend\commons\DataAction;
class CategoryController extends Controller
{
    public function index()
    {
        $data=CategoryModel::all();
        foreach ($data as $value) {
            $value->type=$value->CategoryType()->value('name');
            $value->name=$value->Description()->value('name');
            if ($value->parent_id) {
                $value->parent_name=CategoryModel::find($value->parent_id)->Description()->value('name');
            }
        }
        // dd($data->toArray());
        return $data->toArray();
    }

    public function show($id){
        return response()->json([]);
    }

    public function store(Request $request)
    {
        $data = (new CategoryModel)->getFillable();
        return $request['data']->all();
        $data = $request->only($data);
        $request['category_id']=CategoryModel::insertGetId($data);
        $data = (new CategoryDescription)->getFillable();
        $data = $request->only($data);
        return (new DataAction)->StoreData(CategoryDescription::class,[],'',$data);

    }

    public function edit($id)
    {
        return (new DataAction)->EditData(CategoryModel::class,'setting_id',$id);
        
    }

    public function update(Request $request,$id)
    {
        
        $data=$request->all();

        return (new DataAction)->UpdateData(CategoryModel::class,$data,'setting_id',$id);

    }

    public function destroy($id)
    {
        CategoryModel::where('parent_id',$id)->update(['parent_id'=>0]);
        return (new DataAction)->DeleteData(CategoryModel::class,'category_id',$id);
        
    }
    public function getCategoriesType()
    {
        return CategoryType::select('category_type_id as value','name as text')->get();
    }
    public function getCategoriesParent()
    {
        $data=CategoryModel::select('category_id')->get();
        foreach ($data as $value) {
            $value->text=$value->Description()->value('name');
            $value->value=$value->category_id;
        }
        // dd($data->toArray());
        return $data;
    }
    public function menu()
    {
        return CategoryModel::getAllCategories()->groupBy('type')->toArray();
    }
}
