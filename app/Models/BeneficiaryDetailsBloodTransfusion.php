<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryDetailsBloodTransfusion extends Model
{
    protected $fillable = array(
    	'blood_transfusion_id',
    	'beneficiary_detail_id',
    	'amount',
    	'test_date',
        'added_by'
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'blood_transfusion_id' 	=> 'required|exists:blood_transfusions,id',
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'amount' 				=> 'required|numeric',
    	'test_date' 			=> 'required|date|date_format:Y-m-d',
        'added_by'              => 'required|exists:users,id'
	];

    

    public function blood_transfusion()
    {
        return $this->belongsTo('App\Models\Master\BloodTransfusion');
    }
}
