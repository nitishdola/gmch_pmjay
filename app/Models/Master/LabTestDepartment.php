<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class LabTestDepartment extends Model
{
    protected $fillable = array(
    	'name',

    );
    protected $guarded   = ['_token'];
}
