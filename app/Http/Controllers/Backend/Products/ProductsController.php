<?php

namespace App\Http\Controllers\Backend\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Product\ProductModel;

class ProductsController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {

        $Products = ProductModel::select('product_id','model','image','price','quantity','sort_order','status')->get();
        foreach ($Products as $Product) {
            $Product->name=$Product->Description()->value('name');
            $Product->id=$Product->product_id;
        }
        // dd($Products);
        return $Products;
    }
   
    public function store(Request $request)
    {
         
        $input=$request->all();
       // return $request->all();
        $input=$request->except(['language_id','description','tag','meta_title','meta_description','meta_keyword','name']);
    return $result=ProductModel::Create($input);

    }
    public function edit($id)
    {
        // dd($id);
        $Product = ProductModel::find($id);
        $Product->description=$Product->getDescription();
        return $Product;
    }
    public function update(Request $request,$id)
    {
        $result=ProductModel::UpdateOrCreate($request->all(),$id);
    }
    public function destroy($id)
    {
        return ProductModel::DeleteProduct($id);
    }
}
