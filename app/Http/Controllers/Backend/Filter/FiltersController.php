<?php

namespace App\Http\Controllers\Backend\Filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Filter\Filter;
use App\Http\Models\Backend\Filter\FilterDescription;
/*
    DataAction class use for any action the data from any table
    For more detail i have comment in DataAction class in commons folder
*/
use App\Http\Controllers\Backend\commons\DataAction;
class FiltersController extends Controller
{
    public function index()
    {
        $Filter=Filter::AllFilters();
        return response()->json($Filter);
    }
    public function store(Request $request)
    {
        //data for Filter value
        $Filter=(new Filter)->getFillable();
        $Filter=$request->only($Filter);

        //Data for Filter description
        $FilterDesc=(new FilterDescription)->getFillable();
        $FilterDesc=$request->only($FilterDesc);
        
        //condition to check if Filter value is already existed
        $filterGroup=[
            'name'=>$request->name
        ];
        
        //save Filter value and return filter_id to insert to Filter description
        $saveFilter = (new DataAction)->StoreData(Filter::class,[],"",$Filter,"filter_id");

        //if Filter value is insert successfull
        if($saveFilter['success']){
            
            //get id from child array(data)
            $FilterDesc['filter_id'] = $saveFilter['filter_id'];

            //return success message if data have been successfully save to database
            return (new DataAction)->StoreData(FilterDescription::class,[],"",$FilterDesc); 

        }else{

            //if data doesn't saved to database this will return success false and message why data not save
            return $saveFilter;

        }
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $Filter=Filter::FilterEdit($id);
        foreach($Filter as $Filter){
        	$filterArr=$Filter;
        }
        return response()->json($filterArr);
    }
    public function update(Request $request,$id)
    {
        //data for Filter value
        $Filter=(new Filter)->getFillable();
        $Filter=$request->only($Filter);

        //Data for Filter description
        $attributeDesc=(new FilterDescription)->getFillable();
        $attributeDesc=$request->only($attributeDesc);

        $saveFilter = (new DataAction)->UpdateData(Filter::class,$Filter,'filter_id',$id);
    	return (new DataAction)->UpdateData(FilterDescription::class,$attributeDesc,'filter_id',$id);
    } 
    public function destroy($id)
    {
        (new DataAction)->DeleteData(Filter::class,'filter_id',$id);
        return (new DataAction)->DeleteData(FilterDescription::class,'filter_id',$id);
    }
}
