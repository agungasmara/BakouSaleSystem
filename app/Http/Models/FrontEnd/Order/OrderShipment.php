<?php

namespace App\http\models\frontend\Order;

use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    protected $table = 'order_shipment';
	protected $primaryKey='order_shipment_id';
	protected $fillable =[
							'order_id',
							'date_added',
							'shipping_courier_id',
							'tracking_number',
						];
	public $timestamps = false;

}
