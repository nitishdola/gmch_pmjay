<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class BloodTransfusion extends Model
{
    protected $fillable = array(
    	'name','rate'

    );
    protected $guarded   = ['_token'];
}
