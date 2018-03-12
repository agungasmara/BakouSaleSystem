<?php

namespace App\Http\Models\BackEnd\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
    static function CustomerList()
    {
        $Customers=DB::table('customer as cm')
            ->Join('customer_group as cmg','cm.customer_group_id','=','cmg.customer_group_id')
            ->Join('customer_group_description as cmgdesc','cmg.customer_group_id','=','cmgdesc.customer_group_id')
            ->leftJoin('customer_ip as cmip','cm.customer_id','=','cmip.customer_id')
            ->select('cm.customer_id as customer_id',
                DB::RAW(
                    "concat(lastname,' ',firstname) as customer_name"
                ),
                'email',
                'cmgdesc.name as group',
                'cm.status',
                'cmip.ip',
                'cm.date_added'
            )
            ->get();
        return $Customers;
    }
}
