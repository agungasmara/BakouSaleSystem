<?php

namespace App\Http\Models\BackEnd\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    public $timestamps=false;
    protected $primarykey='user_id';
}
