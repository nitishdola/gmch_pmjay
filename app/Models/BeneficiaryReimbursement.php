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
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required',
    	'date' 					=> 'required|date|date_format:Y-m-d',
	];
}
