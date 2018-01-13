<?php

namespace App\Http\Models\FrontEnd\Account;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primarykey='customer_id';
	protected $fillable = [
						'customer_group_id',
						'store_id',
						'language_id',
						'firstname',
						'lastname',
						'email',
						'telephone',
						'fax',
						'password',
						'salt',
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
	public $timestamps = false;	
}
