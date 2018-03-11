<?php

namespace App\Http\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = 'order_history';
	protected $primaryKey='order_history_id';
	protected $fillable =[
							'order_id',
							'order_status_id',
							'notify',
							'comment',
							'date_added'
						];
	public $timestamps = false;
	
	static function getCategoryFilters($category_id) {

		$implode = array();

		$query = DB::table('category_filter')
				 	->select('filter_id')
					->where('category_id',"" . (int)$category_id . "")
					->get();
					
		// $query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "category_filter WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query as $result) {

			$implode[] = (int)$result->filter_id;

		}



		$filter_group_data = array();



		if ($implode) {
			$filter_group_query = DB::table("filter as f")
								  ->distinct()
								  ->select('f.filter_group_id','fgd.name','fg.sort_order')
								  ->leftjoin('filter_group as fg','f.filter_group_id','=','fg.filter_group_id')
								  ->leftjoin('filter_group_description as fgd','fg.filter_group_id','=','fgd.filter_group_id')
								  ->whereIn('f.filter_id', $implode)
								  ->where('fgd.language_id',config_language_id)
								  ->GROUPBY('f.filter_group_id','fgd.name')
								  ->orderby('fg.sort_order',"LCASE(fgd.name)")
								  ->get();
			//$filter_group_query = $this->db->query("SELECT DISTINCT
			//  f.filter_group_id, fgd.name, fg.sort_order FROM " . DB_PREFIX . "filter f 
			//  LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) 
			//  LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON 
			//  (fg.filter_group_id = fgd.filter_group_id) 
			//  WHERE f.filter_id IN (" . implode(',', $implode) . ") 
			//  AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
			//  GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");



			foreach ($filter_group_query as $filter_group) {

				$filter_data = array();


				$filter_query = DB::table('filter as f')
								->leftjoin('filter_description as fd','f.filter_id','=','fd.filter_id')
								->whereIn('f.filter_id',$implode)
								->where('f.filter_group_id',"".(int)$filter_group->filter_group_id."")
								->where('fd.language_id',config_language_id)
								->orderby('f.sort_order','LCASE(fd.name)')
								->get();
				// $filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name 
				// FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON 
				// (f.filter_id = fd.filter_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") 
				// AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' 
				// AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				// ORDER BY f.sort_order, LCASE(fd.name)");



				foreach ($filter_query as $filter) {

					$filter_data[] = array(

						'filter_id' => $filter->filter_id,

						'name'      => $filter->name

					);

				}



				if ($filter_data) {

					$filter_group_data[] = array(

						'filter_group_id' => $filter_group->filter_group_id,

						'name'            => $filter_group->name,

						'filter'          => $filter_data

					);

				}

			}

		}



		return $filter_group_data;

	}

	static function getCategory($category_id){
		$query = DB::table('category as c')
				 ->distinct()
				 ->select('*')
				 ->leftjoin('category_description as cd','c.category_id','=','cd.category_id')
				 ->leftjoin('category_to_store as c2s','c.category_id', '=', 'c2s.category_id')
				 ->where('c.category_id',"". (int)$category_id . "")
				 ->where('cd.language_id',"" . (int)config_language_id . "")
				 ->where('c2s.store_id',"" . (int)config_store_id . "")
				 ->where('c.status',1)
				 ->first();
		
		return $query;
	}
}
