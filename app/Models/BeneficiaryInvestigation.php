<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryInvestigation extends Model
{
    protected $fillable = array(
    	'lab_test_id',
    	'beneficiary_detail_id',
    	'amount',
    	'test_date',
        'added_by',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'lab_test_id' 			=> 'required|exists:lab_tests,id',
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required|numeric',
    	'test_date' 			=> 'required|date|date_format:Y-m-d',
        'added_by'              => 'required|exists:users,id',
	];

    

    public function lab_test()
    {
        return $this->belongsTo('App\Models\Master\LabTest');
    }

    public function addedBy()
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    public function beneficiaryDetail()
    {
        return $this->belongsTo('App\Models\BeneficiaryDetail', 'beneficiary_detail_id');
    }
}
