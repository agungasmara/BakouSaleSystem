<?php

namespace App\Http\Models\BackEnd\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customer';
    protected $primaryKey='customer_id';
    protected $fillable=[
    	'sec_user_id',
    	'customer_group_id',
    	'store_id',
    	'language_id',
    	'cart',
    	'wishlist',
    	'newsletter',
    	'address_id',
        'custom_field',
        'ip',
        'status',
        'safe',
        'token',
        'code',
        'date_added'
    ];
    public $timestamps=false;
}
