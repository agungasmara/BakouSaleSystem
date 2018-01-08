<?php

namespace App\Http\Controllers\Backend\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct()
    {
        
    }
    public function list()
    {

    }
   
    public function store(Request $request)
    {
        $result=CategoryModel::UpdateOrCreate($request->all());
    }
    public function edit($id)
    {

    }
    public function update(Request $request,$id)
    {
        $result=CategoryModel::UpdateOrCreate($request->all(),$id);
    }
    public function destroy($id)
    {
    	$result=CategoryModel::DeleteCategory($id);
    }
}
