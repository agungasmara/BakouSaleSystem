<?php

namespace App\Http\Models\BackEnd\Store;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\BackEnd\Setting\Setting;

class Store extends Model
{
	protected $table='store';
	protected $primaryKey='store_id';
	public $timestamps=false;
	protected $fillable=[
    	'name',
		'url',
		'ssl',
    	'sec_user_id',
    	'is_default'
    ]; 
    public function settings()
    {
    	return $this->hasMany(Setting::class,'store_id');
    }
}
