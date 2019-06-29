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
        'medical_type',
        'added_by',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required',
    	'bill_date' 			=> 'required|date|date_format:Y-m-d',
        'medical_type'          => 'required',
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
