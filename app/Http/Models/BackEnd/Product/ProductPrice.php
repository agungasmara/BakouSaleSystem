<?php

namespace App\http\models\backend\product;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'product_price';
    
    protected $fillable=[
    	'product_price_id',
		'product_id',
		'customer_group_id',
		'price',
		
    ];
    public $timestamps = false;
}
