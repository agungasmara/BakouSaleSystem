<?php

namespace App\Http\Models\BackEnd\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    public $timestamps=false;
    protected $primarykey='user_id';
    protected $fillable=[
    	'username',
    	'firstname',
    	'lastname',
    	'user_group_id',
    	'image',
    	'email',
    	'password',
    	'salt',
    	'code',
    	'status',
    	'ip',
    	'date_added'
    ];

    public function UserGroup(){
		return $this->belongsTo('App\Http\Models\BackEnd\User\UserGroup','user_group_id');
	}

}
