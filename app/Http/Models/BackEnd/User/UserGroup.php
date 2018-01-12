<?php

namespace App\Http\Models\BackEnd\User;

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
    protected $primaryKey='user_group_id';
}
