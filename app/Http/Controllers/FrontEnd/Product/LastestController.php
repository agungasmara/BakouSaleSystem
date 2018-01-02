<?php

namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LastestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $filter_data = array(
            'sort'  => 'p.date_added',
            'order' => 'DESC',
            'start' => 0,
            'limit' => 4
            // 'limit' => $setting['limit']
        );

        $results = $this->getProducts($filter_data);
        // dd($results);
        $products = array();
        if($results){
            foreach ($results as $p) {
                // $products = array();
                // foreach($rs as $p){
                    $products[] = array(
                        'product_id'  => $p->product_id,
                        'thumb'       => $p->image,
                        'name'        => $p->name,
                        // 'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
                        'description' => $p->description,
                        'price'       => $p->price,
                        'special'     => $p->special,
                        // 'tax'         => $p->tax,
                        'rating'      => $p->rating,
                        // 'href'        => $this->url->link('product/product', 'product_id=' . $p->product_id)
                    );
                // }   
            }

        }
        // dd($products);
        return response()->json(['data' => $products,'success' => true, 'message' => 'Success']);
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
