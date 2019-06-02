<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryDetailsBedCharge extends Model
{
    protected $fillable = array(
    	'name',
    	'beneficiary_detail_id',
    	'amount',
    	'date',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'name' 					=> 'required',
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required|numeric',
    	'date' 					=> 'required|date|date_format:Y-m-d',
	];
}
