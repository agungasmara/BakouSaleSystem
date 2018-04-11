<?php

namespace App\Http\Models\BackEnd\User;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table='setting';
    public $timestamps=false;
    protected $primaryKey='setting_id';
    protected $fillable=[
		'code',
		'status',
		'user_group_id',
		'image',
		'key',
		'config_language_id',
		'config_secure',
		'config_icon',
		'config_logo',
		'config_stock_checkout',
		'config_stock_display',
		'config_order_status_id',
		'config_checkout_id',
		'config_checkout_guest',
		'config_cart_weight',
		'config_account_id',
		'config_customer_price',
		'config_customer_group_id',
		'config_tax_customer',
		'config_tax_default',
		'config_currency',
		'config_tax',
		'config_language',
		'config_zone_id',
		'config_country_id',
		'config_comment',
		'config_open',
		'config_image',
		'config_fax',
		'config_email',
		'config_geocode:',
		'config_address',
		'config_owner',
		'config_name',
		'config_layout_id',
		'config_theme',
		'config_meta_keyword',
		'config_meta_description',
		'config_meta_title',
		'config_ssl',
		'config_review_status',
		'config_url'
    ]; 
}
