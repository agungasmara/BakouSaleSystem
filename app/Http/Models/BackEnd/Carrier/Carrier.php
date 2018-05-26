<?php

namespace App\Http\Models\BackEnd\Carrier;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $table='carrier';
    protected $primaryKey='currency_id';
    protected $fillable=[
    	'reference_id',
    	'tax_rule_group_id',
    	'name',
    	'url',
    	'active',
    	'deleted',
    	'shipping_handling',
    	'range_behavior',
        'is_module',
        'is_free',
        'shipping_extenal',
        'need_range',
        'external_module_name',
        'shipping_method',
        'position',
        'max_width',
        'max_height',
        'max_depth',
        'max_weight',
        'grade',
    ];
    public $timestamps=false;
}
