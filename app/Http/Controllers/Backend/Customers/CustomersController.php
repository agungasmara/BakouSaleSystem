<?php

namespace App\Http\Controllers\Backend\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Customer\Customer;
use App\Http\Models\Backend\Customer\CustomerAddress;
use App\Http\Models\Backend\Customer\CustomerIp;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class CustomersController extends Controller
{
    public function index()
    {
        $Customer=Customer::CustomerList();
        return response()->json($Customer);
    }
    public function store(Request $request)
    {
        //data for Customer Group value
        $fill=(new Customer)->getFillable();
        $Customer=array_only($request['general'],$fill);
        $Customer['date_added']=date('Y-m-d H:i:s'); 
        $Customer['ip']='1'; 
        //save Customer Group value and return customer_id to insert to Customer Group description
       $saveCustomer = (new DataAction)->StoreData(Customer::class,[],"",$Customer,"customer_id");
        //if Customer Group value is insert successfull
        if($saveCustomer['success']){
            $customerIp=['customer_id'=>$saveCustomer['customer_id'],'ip'=>$request->ip(),'date_added'=>date('Y-m-d H:i:s')];
            (new DataAction)->StoreData(CustomerIp::class,[],"",$customerIp);
            //Data for Customer Address
            if(!empty($request['addressItem'])){
                $Address=array();
                foreach($request['addressItem'] as $key=>$form){
                    $Address=$form;
                    $Address['customer_id'] = $saveCustomer['customer_id'];
                    //return success message if data have been successfully save to database
                    $saveAddress=(new DataAction)->StoreData(CustomerAddress::class,[],"",$Address); 
                }
                return $saveAddress;
            }else{
                return $saveCustomer;
            }
        }else{
            //if data doesn't saved to database this will return success false and message why data not save
            return $saveCustomer;
        }
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $customer = Customer::CustomerEdit($id);
        $fill=(new Customer)->getFillable();
        foreach($customer as $key=>$value){
            $customer=$value;
        }
        return response()->json(['general'=>$customer]);
    }
    public function update(Request $request,$id)
    {
        //data for Customer Group value
        $fill=(new Customer)->getFillable();
        $Customer=array_only($request['general'],$fill);
        $Customer['date_added']=date('Y-m-d H:i:s'); 
        $Customer['ip']='1'; 
        //save Customer Group value and return customer_id to insert to Customer Group description
       $saveCustomer = (new DataAction)->UpdateData(Customer::class,$Customer,"customer_id",$id);
        //if Customer Group value is insert successfull
        if($saveCustomer['success']){
            $customerIp=['ip'=>$request->ip(),'date_added'=>date('Y-m-d H:i:s')];
            (new DataAction)->UpdateData(CustomerIp::class,$customerIp,"customer_id",$id);
            //delete all address before and re insert to update address
            $deleteAddress=Customer::DeleteAddress($id);
            if($deleteAddress>0){
                //Data for Customer Address
                if(!empty($request['addressItem'])){
                    $Address=array();
                    foreach($request['addressItem'] as $key=>$form){
                        $Address=$form;
                        $Address['customer_id'] = $id;
                        //return success message if data have been successfully save to database
                        $saveAddress=(new DataAction)->StoreData(CustomerAddress::class,[],"",$Address); 
                    }
                    return $saveAddress;
                }else{
                    return $saveCustomer;
                }
            }
        }else{
            //if data doesn't saved to database this will return success false and message why data not save
            return $saveCustomer;
        }
    } 
    public function destroy($id)
    {
        (new DataAction)->DeleteData(Customer::class,'attribute_id',$id);
        return (new DataAction)->DeleteData(CustomerGroupDescription::class,'attribute_id',$id);
    }
    public function filterCustomer(Request $request)
    {
        $result = Customer::customerByFilter($request->all());
        return response()->json(['result'=>true,'data'=>$result]);
    }
}
