<?php

namespace App\http\models\backend\product;

use Illuminate\Database\Eloquent\Model;

class ProductToCarrier extends Model
{
    protected $table = 'product_carrier';
    
    protected $fillable=[
		'product_id',
		'carrier_id',
		'store_id'
    ];
    public $timestamps = false;
}
