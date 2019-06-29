<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = array(
    	'name',
    );
    protected $guarded   = ['_token'];
}
