<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FrontEnd\Order\OrderModel;
use App\Http\Models\FrontEnd\Order\OrderProduct;
use App\Http\Models\FrontEnd\Order\OrderHistory;
use App\Http\Models\BackEnd\OrderStatus\OrderStatus;
use App\Http\Models\BackEnd\CustomerGroup\CustomerGroupDescription\CustomerGroupDescription;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderModel::all();
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
        $data=OrderModel::find($id);
        $data->customer_group_name=CustomerGroupDescription::find($data->customer_group_id)->value('name');
        $result['data']=$data;
        $result['order_history']=OrderHistory::where('order_id',$data->order_id)->get();
        $result['order_status']=OrderStatus::where('language_id',1)->pluck('name','order_status_id');
        $result['select_status']=OrderStatus::where('language_id',1)->select(['order_status_id as value','name as text'])->get();
        $result['products']=OrderProduct::where('order_id',$data->order_id)->get();
        $result['sub_total']=OrderProduct::where('order_id',$data->order_id)->sum('total');
        $result['tax']=OrderProduct::where('order_id',$data->order_id)->sum('tax');
        $result['total']=OrderProduct::where('order_id',$data->order_id)->sum('total')+OrderProduct::where('order_id',$data->order_id)->sum('tax');
        return $result;
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
