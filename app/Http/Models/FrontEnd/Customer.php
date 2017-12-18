<?php

namespace App\Http\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customer';
    protected $primaryKey='customer_id';
    public function cart()
    {
    	// return $this->hasMany(Cart::class,'customer_id');
    	
    	return $this->hasManyThrough(Product::class,Cart::class,'customer_id','product_id','customer_id','product_id')->addSelect('cart.quantity as cart_quantity','product.*');
    }
}
