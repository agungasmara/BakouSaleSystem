<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_group_id', 
        'firstname', 
        'lastname',
        'gender',
        'dob',
        'company',
        'website',
        'owner',
        'address_1',
        'address_2',
        'username',
        'email', 
        'email_2',
        'password',
        'telephone_1',
        'telephone_2',
        'country',
        'province',
        'city',
        'code',
        'image',
        'status',
        'remember_token',
        'api_token',
        'date_added',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    public $timestamps = false; 
}
