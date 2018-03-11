<?php

namespace App\Http\Controllers\FrontEnd\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Category;
use DB;
use Session;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('frontend.category');
        $category_id = 0;
        // $category_info = $this->getCategory($category_id);
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
    public function show($category_id)
    {
        if (isset($_REQUEST['filter'])) {

            $filter = $_REQUEST['filter'];

        } else {

            $filter = '';

        }



        if (isset($_REQUEST['sort'])) {

            $sort = $_REQUEST['sort'];

        } else {

            $sort = 'p.sort_order';

        }



        if (isset($_REQUEST['order'])) {

            $order = $_REQUEST['order'];

        } else {

            $order = 'ASC';

        }



        if (isset($_REQUEST['page'])) {

            $page = $_REQUEST['page'];

        } else {

            $page = 1;

        }



        if (isset($_REQUEST['limit'])) {

            $limit = (int)$_REQUEST['limit'];

        } else {

            $limit = 12;//$this->config->get($this->config->get('config_theme') . '_product_limit');

        }

        $filter_data = array(

                // 'branch' => $branch,

                // 'size' => $size,

                // 'color' => $color,

                'filter_category_id' => $category_id,

                'filter_filter'      => $filter,

                'sort'               => $sort,

                'order'              => $order,

                'start'              => ($page - 1) * $limit,
                // 'product_filter'     => $getProductIdByFilter,
                'limit'              => $limit

            );

        $getProducts = $this->getProducts($filter_data);
        $category_info = Category::getCategory($category_id);
        $getCategoryFilters = Category::getCategoryFilters($category_id);
        return response()->json(['data' => $getProducts,'category_info'=>$category_info,'getCategoryFilters'=>$getCategoryFilters,'success' => true, 'message' => 'Success', 'lang'=>Session::get('applangId')]);           
    }

    public function getProducts($data = array()){
        // dd($data['filter_category_id']);
        $sql = DB::table('product')
                ->select('product_to_category.category_id','product.product_id',DB::raw('(SELECT AVG(rating) AS total FROM sg_review r1 
                WHERE r1.product_id = sg_product.product_id AND r1.status = 1 
                GROUP BY r1.product_id) AS rating'),DB::raw('(SELECT price FROM sg_product_discount pd2 WHERE pd2.product_id = sg_product.product_id 
                AND pd2.customer_group_id = 1 AND pd2.quantity = 1  AND ((pd2.date_start = 0000-00-00
                OR pd2.date_start < NOW()) 
                AND (pd2.date_end = 0000-00-00 OR pd2.date_end > NOW())) 
                ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) 
                AS discount'),DB::raw('(SELECT price FROM sg_product_special ps WHERE ps.product_id = sg_product.product_id AND ps.customer_group_id = 1 AND ((ps.date_start = 0000-00-00 OR ps.date_start < NOW()) AND (ps.date_end = 0000-00-00 OR ps.date_end > NOW())) 
                ORDER BY ps.priority ASC
                , ps.price ASC LIMIT 1) AS special'))
                ->leftJoin('product_description','product.product_id','=','product_description.product_id')
                ->leftJoin('product_to_store','product.product_id','=','product_to_store.product_id')
                // ->join('product_to_category as p2c','p2c.category_id','=',$data['filter_category_id'])
                 ->join('product_to_category','product.product_id','=','product_to_category.product_id')
                ->where('product_description.language_id',1)
                ->where('product.status',1)
                ->where('product.date_available','<=',Carbon::today())
                ->where('product_to_store.store_id',0)
                ->where('product_to_category.category_id',$data['filter_category_id'])
                ->groupBy('product_description.name')
                ->groupBy('product_to_category.category_id')
                ->groupBy('product.product_id');
                // ->limit(4);
                // ->get();

        if (isset($data['limit'])) {
            $sql->Limit($data['limit']);
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql->OrderBy("product_description.name","DESC");
        } else {
            $sql->OrderBy("product_description.name","ASC");
        }

        $query = $sql->get();

        $product_data = array();
        foreach ($query as $result) {

            $product_data[] = $this->getProduct($result->product_id,$result->category_id);
        }        
        return $product_data;
                
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
