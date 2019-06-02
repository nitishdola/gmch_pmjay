<?php

namespace App\Models\OldData;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryDetailOldData extends Model
{
    protected $fillable = array(
    	'beneficiary_detail_id',
    	'investigation_cost',
    	'pet_cet_cost_cost',
        'miscellaneous_cost',
    	'srl_cost',
    	'amrit_pharmacy_cost',
    	'dialysis_cost',
    	'endorscopy_cost',
    	'ot_cost',
    	'bed_cost',
    	'icu_cost',
    	'blood_transfusion_cost',
    	'implant_cost',
    	'vendor_reimbursement_cost',
    	'beneficiary_reimbursement_cost',
    	'vvi_cost',
    	'medicine_return_cost',
        'beneficiary_ta_cost'
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' 	=> 'required|exists:beneficiary_details,id',
	];
}
