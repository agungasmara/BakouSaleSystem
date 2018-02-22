<?php

namespace App\http\models\backend\product;

use Illuminate\Database\Eloquent\Model;

class ProductRelated extends Model
{
    protected $table = 'product_related';
    
    protected $fillable=[
    	'product_id',
		'related_id',
		
    ];
    public $timestamps = false;
}
