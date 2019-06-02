<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiarySrl extends Model
{
    protected $fillable = array(
    	'test_name',
    	'beneficiary_detail_id',
    	'amount',
    	'test_date',
        'added_by',
    );
    protected $guarded   = ['_token'];

    public static $rules = [
    	'beneficiary_detail_id' => 'required|exists:beneficiary_details,id',
    	'test_name' 			=> 'required',
    	'amount' 				=> 'required',
    	'test_date' 			=> 'required|date|date_format:Y-m-d',
        'added_by'              => 'required|exists:users,id',
	];
}
