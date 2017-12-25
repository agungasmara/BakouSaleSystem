<?php

namespace App\Http\Models\BackEnd\Store;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\BackEnd\Setting\Setting;

class Store extends Model
{
	protected $table='store';
	//protected $primaryKey='store_id';
    public function settings()
    {
    	return $this->hasMany(Setting::class,'store_id');
    }
}
