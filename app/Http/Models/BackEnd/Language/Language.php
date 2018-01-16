<?php

namespace App\Http\Models\BackEnd\Language;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table='language';
    protected $fillable=[
    	'name',
    	'code',
    	'locale',
    	'image',
    	'directory',
    	'sort_order',
    	'status'
    ];
    public $timestamps = false;

    static function AllLanguages()
    {
    	$languages=Language::get(
    	[
    		'language_id as id',
	    	'name',
	    	'code',
	    	'locale',
	    	'image',
	    	'directory',
	    	'status'
	    ]);
	    return $languages;
    }
}
