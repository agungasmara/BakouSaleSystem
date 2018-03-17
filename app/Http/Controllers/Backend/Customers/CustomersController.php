<?php

namespace App\Http\Controllers\Backend\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Customer\Customer;
//use App\Http\Models\Backend\CustomerGroup\CustomerGroupDescription\CustomerGroupDescription;
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
        $CustomerGroup=(new CustomerGroup)->getFillable();
        $CustomerGroup=$request->only($CustomerGroup);

        //Data for Customer Group description
        $customerGroupDesc=(new CustomerGroupDescription)->getFillable();
        $customerGroupDesc=$request->only($customerGroupDesc);
        
        //condition to check if Customer Group value is already existed
        $attrCond=[
            'name'=>$request->name
        ];
        
        //save Customer Group value and return attribute_id to insert to Customer Group description
        $saveAttribute = (new DataAction)->StoreData(CustomerGroup::class,[],"",$CustomerGroup,"attribute_id");

        //if Customer Group value is insert successfull
        if($saveAttribute['success']){
            
            //get id from child array(data)
            $customerGroupDesc['attribute_id'] = $saveCustomerGroup['attribute_id'];

            //return success message if data have been successfully save to database
            return (new DataAction)->StoreData(CustomerGroupDescription::class,$attrCond,"",$customerGroupDesc); 

        }else{

            //if data doesn't saved to database this will return success false and message why data not save
            return $saveCustomerGroup;

        }
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $CustomerGroup=CustomerGroup::CustomerGroupEdit($id);
        foreach($CustomerGroup as $CustomerGroup){
        	$attributeArr=$CustomerGroup;
        }
        return response()->json($attributeArr);
    }
    public function update(Request $request,$id)
    {
        //data for Customer Group value
        $CustomerGroup=(new CustomerGroup)->getFillable();
        $CustomerGroup=$request->only($CustomerGroup);

        //Data for Customer Group description
        $customerGroupDesc=(new CustomerGroupDescription)->getFillable();
        $customerGroupDesc=$request->only($customerGroupDesc);

        $saveCustomerGroup = (new DataAction)->UpdateData(CustomerGroup::class,$CustomerGroup,'attribute_id',$id);
    	return (new DataAction)->UpdateData(CustomerGroupDescription::class,$customerGroupDesc,'attribute_id',$id);
    } 
    public function destroy($id)
    {
        (new DataAction)->DeleteData(CustomerGroup::class,'attribute_id',$id);
        return (new DataAction)->DeleteData(CustomerGroupDescription::class,'attribute_id',$id);
    }
    public function filterCustomer(Request $request)
    {
        $result = Customer::customerByFilter($request->all());
        return response()->json(['result'=>true,'data'=>$result]);
    }
}
