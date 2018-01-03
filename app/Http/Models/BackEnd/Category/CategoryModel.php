<?php

namespace App\Http\Models\BackEnd\Category;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CategoryModel extends Model
{
    protected $table = 'category';
	protected $primaryKey='category_id';
	protected $guarded = ['category_id']; 
	public $timestamps = false;
	static function UpdateOrCreate($data,$category_id='')
	{
		// dd($data);
		if (!$category_id) {
			$data['date_added']=Carbon::now();
			$data['date_modified']=Carbon::now();
			return static::insert($data);
		}else{
			$data['date_modified']=Carbon::now();
			$Category=static::find($category_id);
			if (!$Category) {
				return false;
			}
			return $Category->update($data);
		}
	}
	static function DeleteCategory($category_id)
	{
		$Category=static::find($category_id);
		if (!$Category) {
			return false;
		}
		return $Category->delete();
	}
	public function Description()
	{
		return $this->hasMany(CategoryDescription::class,'category_id');
	}
	static function ParentCategories($data=array())
	{
		return static::where('parent_id',0)->where('status',1);
	}
	public function ChildCategories($data=array())
	{
		return $this->hasMany(CategoryModel::class,'parent_id');
	}
	static function getAllCategories()
	{
		$Categorys=static::ParentCategories()->get();
		foreach ($Categorys as $key => $Category) {
			$Category->child=$Category->ChildCategories()->get();
		}
		return $Categorys;
	}
	
}
