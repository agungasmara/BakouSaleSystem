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
<<<<<<< HEAD
		if (Auth::user()) {
=======
		if (Auth::check()) {
			$key['customer_id']=Auth::id();
		}else{
			$key['session_id']=session()->getId();
		}
		$key['product_id']=$data['product_id'];
		$value['option']=isset($data['option'])? : '';
		$value['quantity']=$data['quantity'] + static::Quantity($key) ;
		$value['date_added']=Carbon::now() ;
		return static::updateOrCreate($key,$value);
	}
	static function Quantity($filter)
  	{
  		$query=new static;
  		foreach ($filter as $key => $value) {
  			$query=$query->where($key,$value);
  		}
  		return $query->value('quantity');
  	}
	static function RemoveFromCart($data)
	{
		if (Auth::check()) {
>>>>>>> 7a2389c1820d01bc9034ebe887ee85ecfdf266c1
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
<<<<<<< HEAD
=======
	static function MyCart()
	{	
		// $key= Auth::user()!== null ? 'customer_id':'session_id';
		if (Auth::check()) {
			$key['customer_id']=Auth::id();
		}else{
			$key['session_id']=session()->getId();
		}
>>>>>>> 7a2389c1820d01bc9034ebe887ee85ecfdf266c1

	static function CartInsert($data)
	{
		return static::insert($data);
	}
}
