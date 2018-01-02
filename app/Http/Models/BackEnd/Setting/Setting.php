<?php

namespace App\Http\Models\BackEnd\Setting;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\BackEnd\Store\Store;

class Setting extends Model
{
    protected $table='setting';
    public $timestamps = false;
    protected $primaryKey='store_id';
    protected $fillable=[
    	'store_id',
    	'code',
    	'key',
    	'value',
    	'serialized'
    ];
}
