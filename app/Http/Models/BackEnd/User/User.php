<?php

namespace App\Http\Models\BackEnd\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Models\BackEnd\UserGroup\UserGroup;
class User extends Model
{
    protected $table='user';
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
    ]; 
    protected $hidden=['password','salt','ip'];

    public function UserGroup(){
		return $this->belongsTo(UserGroup::class,'user_group_id');
	}
    static function Users($data = array())
    {
        return static::Users();
    }
    static function AllUser()
    {
        $users=DB::table('user')
            ->join('user_group', 'user.user_group_id', '=', 'user_group.user_group_id')
            ->select(
                'user_id as id', 
                'username', 
                'user_group.name as group',
                'firstname',
                'lastname',
                'email', 
                'code',
                'image',
                'status', 
                'date_added'
            )
            ->get();
        return $users;
    }
}

