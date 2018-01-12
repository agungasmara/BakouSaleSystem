<?php

namespace App\Http\Models\BackEnd\UserGroup;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table='user_group';
    protected $fillable=[
    	'name',
    	'group_type',
    	'permission'
    ];
    public $timestamps=false;
<<<<<<< HEAD:app/Http/Models/BackEnd/UserGroup/UserGroup.php
    protected $primarykey='user_group_id';
    protected $fillable=[
    	'name',
    	'group_type',
    	'permission'
];
=======
    protected $primaryKey='user_group_id';
>>>>>>> 1564b7cccb099c7102afdb680110f1cdd8869aa8:app/Http/Models/BackEnd/User/UserGroup.php
}
