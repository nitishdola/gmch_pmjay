<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryDetailAdditionalPackage extends Model
{
    protected $fillable = array(
    	'beneficiary_detail_id',
    	'package_id',
    	'package_amount',
    	'date',
        'added_by',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'package_id' 			=> 'required|exists:pmjay_packages,id',
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'package_amount' 		=> 'required|numeric',
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

    public function package()
    {
        return $this->belongsTo('App\Models\Master\PmjayPackage', 'package_id', 'id');
    }
}
