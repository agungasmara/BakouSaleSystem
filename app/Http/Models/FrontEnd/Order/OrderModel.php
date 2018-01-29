<?php

namespace App\http\models\frontend\order;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'order';
	protected $primaryKey='order_id';
	protected $fillable =[
							'invoice_no',
							'invoice_prefix',
							'store_id',
							'store_name',
							'store_url',
							'customer_id',
							'customer_group_id',
							'firstname',
							'lastname',
							'email',
							'telephone',
							'fax',
							'custom_field',
							'payment_firstname',
							'payment_lastname',
							'payment_email',
							'payment_telephone',
							'payment_company',
							'payment_address_1',
							'payment_address_2',
							'payment_city',
							'payment_postcode',
							'payment_country',
							'payment_country_id',
							'payment_zone',
							'payment_zone_id',
							'payment_address_format',
							'payment_custom_field',
							'payment_method',
							'payment_code',
							'shipping_firstname',
							'shipping_lastname',
							'shipping_company',
							'shipping_email',
							'shipping_telephone',
							'shipping_address_1',
							'shipping_address_2',
							'shipping_city',
							'shipping_postcode',
							'shipping_country',
							'shipping_country_id',
							'shipping_zone',
							'shipping_zone_id',
							'shipping_address_format',
							'shipping_custom_field',
							'shipping_method',
							'shipping_code',
							'comment',
							'total',
							'order_status_id',
							'affiliate_id',
							'commission',
							'marketing_id',
							'tracking',
							'language_id',
							'currency_id',
							'currency_code',
							'currency_value',
							'ip',
							'forwarded_ip',
							'user_agent',
							'accept_language',
							'date_added',
							'date_modified',
							];
	static function filldata($data)
	{
		foreach ($fillable as $key) {
			$datas[$key]=$data[$key];
		}
		return $datas;
	}

}
