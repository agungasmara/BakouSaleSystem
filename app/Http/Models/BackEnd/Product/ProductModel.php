<?php

namespace App\Http\Models\BackEnd\Product;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class ProductModel extends Model
{
    protected $table = 'product';
	protected $primaryKey='product_id';
	protected $guarded = ['product_id']; 
	public $timestamps = false;
	static function UpdateOrCreate($data,$product_id='')
	{
		// dd($data);
		if (!$product_id) {
			$data['date_added']=Carbon::now();
			$data['date_modified']=Carbon::now();
			return static::insert($data);
		}else{
			$data['date_modified']=Carbon::now();
			$Product=static::find($product_id);
			if (!$Product) {
				return false;
			}
			return $Product->update($data);
			// insertGetId
		}
	}
	static function DeleteProduct($product_id)
	{
		$Product=static::find($product_id);
		if (!$Product) {
			return ['success'=>false,
					'message'=>'Data fail to delete.'];
		}
		return ['success'=>$Product->delete(),
    			'message'=>'Data successfully deleted.'];
	}
	public function scopeFilter($query,$filter=array())
	{
	  	foreach ($filter as $key => $value) {
	  		$query->where($key,$value);
	  	}
	  	return $query;
	  	
	}
	public function scopeSort($query,$sort='sort_order',$type='desc')
	{
	  	return $query->orderBy($sort,$type);
	}
	public function Description()
	{
		return $this->hasMany(ProductDescription::class,'product_id');
	}
	
	
}
