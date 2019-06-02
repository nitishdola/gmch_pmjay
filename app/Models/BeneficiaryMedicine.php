<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryMedicine extends Model
{
    protected $fillable = array(
    	'invoice_number',
    	'beneficiary_detail_id',
    	'amount',
    	'bill_date',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required',
    	'bill_date' 			=> 'required|date|date_format:Y-m-d',
	];
}
