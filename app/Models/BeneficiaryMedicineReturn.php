<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryMedicineReturn extends Model
{
    protected $fillable = array(
    	'invoice_number',
    	'beneficiary_detail_id',
    	'amount',
    	'bill_date',
        'added_by',
        'medical_type',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required',
    	'bill_date' 			=> 'required|date|date_format:Y-m-d',
        'added_by'              => 'required|exists:users,id',
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
