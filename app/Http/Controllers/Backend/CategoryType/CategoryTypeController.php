<?php
namespace App\Http\Controllers\Backend\CategoryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\CategoryType\CategoryTypeDescription;
use App\Http\Models\BackEnd\CategoryType\CategoryType;
use App\Http\Controllers\Backend\commons\DataAction;
use App\Http\Controllers\Backend\commons\ImageMaker;
class CategoryTypeController extends Controller
{
     public function index()
    {
        $CategoryType=CategoryType::AllCategoryType();
        return response()->json($CategoryType);
    }
    public function show($id){
        return response()->json([]);
    }
    public function store(Request $request)
    {
        $data = (new CategoryType)->getFillable();
        $request['date_added']=date('Y-m-d');
        $request['date_modified']=date('Y-m-d');
        $data = $request->only($data);
        if ($request->has('category_type_id')) {
            CategoryType::find($request['category_type_id'])->update($data);
            $data = (new CategoryTypeDescription)->getFillable();
            $data = $request->only($data);
            return (new DataAction)->UpdateData(CategoryTypeDescription::class,$data,'category_type_id',$request['category_type_id']);
        }else{
            $request['category_type_id']=CategoryType::insertGetId($data); 
            $data = (new CategoryTypeDescription)->getFillable();
            $data = $request->only($data);
            return (new DataAction)->StoreData(CategoryTypeDescription::class,[],'',$data);
        }
    }
     public function edit($id)
    {
        // dd("Hello wrold!");
        $CategoryType = CategoryType::CategoryTypeEdit($id);
        foreach($CategoryType as $value){
            $categoryType=$value;
        }
        return response()->json($categoryType);
    }
    public function update(Request $request,$id)
    {
         //data for Category value
        $Category=(new CategoryType)->getFillable();
        $Category=$request->only($Category);

        //Data for Category description
        $categoryTypeDesc=(new CategoryTypeDescription)->getFillable();
        $categoryTypeDesc=$request->only($categoryTypeDesc);

        $saveInformation = (new DataAction)->UpdateData(CategoryType::class,$Category,'category_type_id',$id);
         (new DataAction)->UpdateData(CategoryTypeDescription::class,$categoryTypeDesc,'category_type_id',$id);

    } 
     public function destroy($id)
    {
        CategoryType::where('parent_id',$id)->update(['parent_id'=>0]);
        return (new DataAction)->DeleteData(CategoryType::class,'category_type_id',$id);
        
    }

}