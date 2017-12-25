<?php

namespace App\Http\Controllers\FrontEnd\common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                    $children = $this->getCategories($category->category_id,$ctype->category_type_id);
                    foreach ($children as $child) {
                        $filter_data = array(
                            'filter_category_id'  => $child->category_id,
                            'filter_sub_category' => true
                        );

                        $children_data[] = array(
                            'name'  => $child->name,
                            'href'  => 'product/category', 'path=' . $category->category_id . '_' . $child->category_id
                        );
                    }

                    // Level 1
                    $cateArr[] = array(
                        'name'     => $category->name,
                        'children' => $children_data,
                        'column'   => $category->column ? $category->column: 1,
                        //'href'     => $this->url->link('product/category', 'path=' . $category->category_id)
                        'href'     => 'product/category/' . $category->category_id
                    );
                }
            }

            $cateTypeArr[] = array(
                'name' => $ctype->name,
                'categories' => $cateArr
            );
        }
        
        $data = array('data'=>$cateTypeArr);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
