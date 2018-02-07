<?php

namespace App\Http\Models\BackEnd\Attribute;

use Illuminate\Database\Eloquent\Model;

class AttributeDescription extends Model
{
  protected $table='attribute_description';
  protected $primaryKey='attribute_id';
  protected $fillable=[
  	'name',
  	'attribute_id',
  	'language_id'
  ];
  public $timestamps=false;
}
