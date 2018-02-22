<?php

namespace App\http\models\backend\product;

use Illuminate\Database\Eloquent\Model;

class ProductSpecial extends Model
{
    protected $table = 'product_special';
    protected $primaryKey='product_special_id';
    protected $fillable=[
		'product_id',
		'customer_group_id',
		'priority',
		'price',
		'date_start',
		'date_end',
		
    ];
    public $timestamps = false;
}
