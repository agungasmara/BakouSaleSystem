<?php

namespace App\Http\Models\BackEnd\Product;

use Illuminate\Database\Eloquent\Model;

class ProductToStore extends Model
{
    protected $table = 'product_to_store';
    //
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
