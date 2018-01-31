<?php

namespace App\Http\Models\FrontEnd\Account;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primarykey='address_id';
	protected $fillable = [
						'customer_id',
						'firstname',
						'lastname',
						'company',
						'address_1',
						'address_2',
						'city',
						'postcode',
						'country_id',
						'zone_id',
						'custom_field'
					];
	public $timestamps = false;	
}