<?php

namespace App\Http\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
	protected $primaryKey='product_id';
	 
	public $timestamps = false;
}
