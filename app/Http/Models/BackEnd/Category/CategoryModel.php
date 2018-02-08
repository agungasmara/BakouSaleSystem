<?php

namespace App\Http\Models\BackEnd\Category;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CategoryModel extends Model
{
    protected $table = 'category';
	protected $primaryKey='category_id';
	protected $guarded = ['category_id']; 
    protected $fillable=[
    	'category_type_id',
		'image',
		'parent_id',
		'top',
		'column',
		'sort_order',
		'status',
		'date_added',
		'date_modified',
    ];
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
		$language_id=1;
		return $this->hasMany(CategoryDescription::class,'category_id')->where('language_id',$language_id);
	}
	public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
	public function scopeParent($query)
	{
		return $query->where('parent_id',0);
	}
	static function ParentCategories($data=array())
	{
		return static::where('parent_id',0)->where('status',1);
	}
	public function ChildCategories($data=array())
	{
		return $this->hasMany(CategoryModel::class,'parent_id');
	}
	public function CategoryType()
	{
		$language_id=1;
		return $this->hasOne(CategoryType::class,'category_type_id','category_type_id')->where('language_id',$language_id);
	}
	static function getAllCategories()
	{
		$Categorys=static::ParentCategories()->get();
		foreach ($Categorys as $Category) {
			$Category->type=$Category->CategoryType()->value('name');
			$Category->name=$Category->Description()->value('name');
			$getChild=$Category->ChildCategories()->get();
			if ($getChild->count()) {
				$Category->child=$getChild;
				foreach ($Category->child as $Child) {
					$Child->name=$Child->Description()->value('name');
				}
				$Category->child=$Category->child->toArray();
			}
		}
		return $Categorys;
	}
	
}
