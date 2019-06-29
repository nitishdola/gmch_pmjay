<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honorarium extends Model
{
    protected $fillable = array(
    	'amount',
    	'beneficiary_detail_id',
    	'pay_date',
    	'remarks',
        'added_by',
    );
    protected $guarded   = ['_token'];

    protected $table = 'honorariums';

    public static $rules = [
    	//'name' 					=> 'required',
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required|numeric',
    	'pay_date' 				=> 'required|date|date_format:Y-m-d',
        'added_by'              => 'required|exists:users,id',
        'remarks' 				=> 'max:500'
	];

    public function addedBy()
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    public function beneficiaryDetail()
    {
        return $this->belongsTo('App\Models\BeneficiaryDetail', 'beneficiary_detail_id');
    }
}
