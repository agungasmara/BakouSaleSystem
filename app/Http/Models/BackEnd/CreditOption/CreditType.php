<?php

namespace App\Http\Models\BackEnd\CreditOption;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CreditType extends Model
{
    protected $table='credit_type';
    protected $primaryKey='credit_type_id';
    protected $fillable=[
    	'language_id',
    	'name'
    ];
    public $timestamps=false;
    static function AllCreditType()
    {
        $creditType=DB::table('credit_type')
                  ->leftJoin('language','language.language_id','=','credit_type.language_id')
                  ->select('credit_type_id','credit_type.name as name','language.name as language')
                  ->get();
        return $creditType;
    }
}
