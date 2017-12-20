<?php

namespace App\http\models\frontend;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class SessionModel extends Model
{
    protected $table = 'session';
	protected $primaryKey='session_id';
	protected $fillable = [
							'session_id',
							'data',
							'expire'
						];
	public $incrementing = false;
	public $timestamps = false;
	static function AddSession()
	{
		$data=collect(session()->all());
		$key['session_id']=session()->getId();
		$value['data']=$data->toJson();
		$value['expire']=Carbon::now();
		return static::updateOrCreate($key,$value);
	}
	public function cart()
    {
    	// return $this->hasMany(Cart::class,'customer_id');
    	
    	return $this->hasManyThrough(Product::class,Cart::class,'customer_id','product_id','customer_id','product_id')->addSelect('product.*','cart.quantity as cart_quantity');
    }
}
