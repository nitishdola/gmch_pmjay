<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryReimbursement extends Model
{
    protected $fillable = array(
    	'name',
    	'beneficiary_detail_id',
    	'amount',
    	'date',
        'added_by'
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required',
    	'date' 					=> 'required|date|date_format:Y-m-d',
        'added_by'              => 'required|exists:users,id',
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
