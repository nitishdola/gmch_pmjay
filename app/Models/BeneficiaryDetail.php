<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryDetail extends Model
{
    protected $fillable = array(
    	'register_sl_no',
    	'name_of_patient',
    	'urn',
    	'date_of_admission',
    	'inward_number',
    	'hospital_number',
    	'mrd_number',
    	'discharge_date',
    	'package_id',
    	'name_of_package',
    	'package_amount',
    	'total_expenditure',
    	'remaining_amount',
    	'cliams_received',
        'deducted_by_sha',
    	'remarks',
        'scheme',
        'is_cancelled',
        'hospital_type',
        'added_by',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'name_of_patient' 	=> 'required',
    	'urn' 				=> 'required',
    	'date_of_admission' => 'required|date|date_format:Y-m-d',
    	'inward_number' 	=> 'required|unique:beneficiary_details,inward_number',
        'package_amount'    => 'required|numeric',
	];

    public function old_data()
    {
        return $this->hasOne('App\OldData\BeneficiaryDetailOldData');
    }

    public function pmjay_package()
    {
        return $this->belongsTo('App\Master\PmjayPackage');
    }
}
