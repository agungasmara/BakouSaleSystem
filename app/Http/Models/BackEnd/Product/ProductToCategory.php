<?php

namespace App\Http\Models\BackEnd\Product;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model
{
    protected $table = 'product_to_category';
    protected $fillable=[
    	'category_id',
		'language_id',
		'name',
		'description',
		'meta_title',
		'meta_description',
		'meta_keyword',
    ];
    public $timestamps = false;
}
