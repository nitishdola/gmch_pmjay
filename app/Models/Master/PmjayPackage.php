<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class PmjayPackage extends Model
{
    protected $fillable = array(
    	'speciality_code','procedure_name','procedure_code','non_nabh_package_amount','nabh_package_amount'

    );
    protected $guarded   = ['_token'];
}
