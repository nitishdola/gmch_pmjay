<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    protected $fillable = array(
    	'name','rate','lab_test_department_id'

    );
    protected $guarded   = ['_token'];
}
