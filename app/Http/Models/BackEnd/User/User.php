<?php

namespace App\Http\Models\BackEnd\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BackEnd\UserGroup\UserGroup;
class User extends Model
{
    protected $table=['user'];
    public $timestamps=false;
    protected $primarykey='user_group_id';
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
<<<<<<< HEAD
    ]; 
=======
    ];

    public function UserGroup(){
		return $this->belongsTo('App\Http\Models\BackEnd\User\UserGroup','user_group_id');
	}

>>>>>>> 1564b7cccb099c7102afdb680110f1cdd8869aa8
}
