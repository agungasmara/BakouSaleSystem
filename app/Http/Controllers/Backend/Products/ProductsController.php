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
    public function list()
    {
        $Products = ProductModel::all();
        foreach ($Products as $Product) {
            $Product->name=$Product->Description()->value('name');
        }
        return $Products;
    }
   
    public function store(Request $request)
    {
        $result=ProductModel::UpdateOrCreate($request->all());
    }
    public function edit($id)
    {
        $Product = ProductModel::find($id);
        $Product->description=$Product->getDescription();
        dd($Product);
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
