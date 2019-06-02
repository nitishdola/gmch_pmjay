<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryVendorReimbursement extends Model
{
    protected $fillable = array(
    	'vendor_name',
    	'name',
    	'beneficiary_detail_id',
    	'amount',
    	'date',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'vendor_name' 			=> 'required',
    	'name' 					=> 'required',
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required',
    	'date' 					=> 'required|date|date_format:Y-m-d',
	];
}
