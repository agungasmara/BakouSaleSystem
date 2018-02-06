<?php

namespace App\Http\Controllers\FrontEnd\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menu
        // $this->load->model('catalog/category');
        // $this->load->model('catalog/product');
        $cateTypeArr = array();
        $category_type = $this->getTypeCategory();
        foreach ($category_type as $ctype) {
            $cateArr = array();
            $categories = $this->getCategories(0,$ctype->category_type_id);
            foreach ($categories as $category) {
                if ($category->top) {
                    // Level 2
                    $children_data = array();
                    $children = $this->getCategories($category->category_id,$category->category_type_id);
                    foreach ($children as $child) {
                        $filter_data = array(
                            'filter_category_id'  => $child->category_id,
                            'filter_sub_category' => true
                        );

                        $children_data[] = array(
                            'name'  => $child->name,
                            'href'  => '/product/category_product/'.$child->category_id
                            // 'path=' . $category->category_id . '_' . $child->category_id
                        );
                    }

                    // Level 1
                    $cateArr[] = array(
                        'name'     => $category->name,
                        'children' => $children_data,
                        'column'   => $category->column ? $category->column: 1,
                        //'href'     => $this->url->link('product/category', 'path=' . $category->category_id)
                        'href'     => '/product/category_product/' . $category->category_id
                    );
                }
            }

            $cateTypeArr[] = array(
                'name' => $ctype->name,
                'categories' => $cateArr
            );
        }
        
        $data = array('data'=>$cateTypeArr,'success'=>true, 'lang'=>Session::get('applangId'));

        return response()->json($data);
    }

}
