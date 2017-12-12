<?php

namespace App\Http\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table = 'cart';
    protected $primaryKey='cart_id';
    
	protected $fillable = [
							'customer_id',
							'session_id',
							'product_id',
							'option',
							'quantity',
							'date_added'
						];
	 
	public $timestamps = false;
	static function AddToCart($data)
	{
		if (Auth::user()) {
			$key['customer_id']=Auth::id();
			$key['product_id']=$data['product_id'];
		}else{
			$key['session_id']=session()->getId();
			$key['product_id']=$data['product_id'];
		}
		$value['option']=$data['option'];
		$value['quantity']=$data['quantity'];
		$value['date_added']=$data['date_added'];
		return static::updateOrCreate($key,$value);
	}

	static function CartInsert($data)
	{
		return static::insert($data);
	}
}
