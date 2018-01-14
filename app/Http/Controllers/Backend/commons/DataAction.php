<?php
	namespace App\Http\Controllers\Backend\commons;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	/*
	    DataAction class use for any action the data from any table
	    currently i have create function and parameter as below:
	    /*
	    ==============Parameter=======================
			+ $table: should by model class name
	        Ex. if you want to do action on Setting Model, just pass Setting::class 
	        + $field: put feild name as string 
	        Ex. if you want to compare setting_id to variable
	        + $data: data to be update
	        + $id: id you want to update, it should be a parameter from your api url
	        + $condition: put the conditon to check if data is exist or not before insert data
	        to data base
			Ex. $condition=['con1'=>'val1'] for one conditon
				or 	$condition=[
						'con1'=>'val1',
						'con2'=>'val2',
						.
						.
						.
						'conN'=>'valN'
					] for many condition
			That con1,con2,...,conN are feild name of table to be check with the value of
			val1,val2,...valN
	 	==============End of parameter================
	------------------****************---------------------------------------------- 	
	 	==============Function========================
	        - StoreData($data): Save data to database
	        - EditData($id):Load data to be edit by id
	        - UpdateData($table,$field,$data,$id): Update data by id
	        - DeleteData($id): delete data by id
	    ==============End of function=================
	*/
	class DataAction extends Controller{
		
		public function StoreData($table,$conditon=[],$data)
		{

			$success=false;
			$message='';

			$count=0;

			if(!empty($conditon))
			{

				$count = $table::where($conditon)->count();

				if($count>0){

		         	$success=false;
		         	$message='Data already exist!';

		        }
		        else
		        {

		        	$dataSave=new $table($data);

		        	$saved=$dataSave->save();

		        	if($saved){

			            $success=true;
			            $message='Data successfully saved.';

			        }
			        else
			        {

			            $success=false;
			            $message='Failed to save data!';

			        }

		        }

			}
			else
	        {
	        	$dataSave=new $table($data);

		        $saved=$dataSave->save();

		        if($saved){

		            $success=true;
		            $message='Data successfully saved.';

		        }
		        else
		        {

		            $success=false;
		            $message='Failed to save data!';

		        }
	        }

	        return response()->json([

	            'success'=>$success,
	            'message'=>$message

	        ]);
		}
		public function EditData($table,$field,$id)
		{

			$data=$table::get()->where($field,$id);

			foreach ($data as $key => $value) {

	            return response()->json([

	            	'data'=>$value

	            ]);

	        }
		}
		public function UpdateData($table,$data,$field,$id)
		{

			$success=false;

			$update=$table::where($field,$id)->update($data);

			if($update){

	            $success=true;

	        }else{

	            $success=false;

	        }

	        return response()->json([

	            'success'=>$success,
	            'message'=>'Data successfully updated.'

	        ]);
		}
		//Use to delete data from table 
		public function DeleteData($table,$field,$id)
		{
			$deleted=false;

	        $delete=$table::select('*')->where($field,$id);

	        $delete->delete();

	        if($delete){

	            $deleted=true;

	        }else{

	            $deleted=false;

	        }

	        return response()->json([

	            'deleted'=>$deleted,
	            'data'=>$table::all()

	        ]);

		}

	}
?>