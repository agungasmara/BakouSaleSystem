<?php

namespace App\Http\Models\BackEnd\Carrier;

use Illuminate\Database\Eloquent\Model;

class CarrierShop extends Model
{
    protected $table='carrier_shop';
    protected $primaryKey='carrier_id';
    protected $fillable=[
    	'carrier_id',
    	'store_id',
    	
    ];
    public $timestamps=false;
}
