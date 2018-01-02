<?php

namespace App\Http\Models\BackEnd\User;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table='user_group';
    public $timestamps=false;
    protected $primarykey='user_group_id';
}
