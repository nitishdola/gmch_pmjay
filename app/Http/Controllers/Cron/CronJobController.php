<?php

namespace App\Http\Controllers\Cron;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;

class CronJobController extends Controller
{
    public function completeProcess(Request $request) {
    	$results = BeneficiaryDetail::where('discharge_date', '!=', NULL)
    									->where('beneficiary_ta_cost', '>', 0)
    									->where('status', 1)
    									->get();

    	foreach($results as $k => $v) {
    		$discharge_date = $v->discharge_date;

    		$date_15 = date('Y-m-d', strtotime($discharge_date. ' + 15 days'));

    		$current_date = date('Y-m-d');


    		if(strtotime($date_15) > strtotime($current_date)) {
    			$beneficiary_details = BeneficiaryDetail::find($v->id);

    			$beneficiary_details->is_process_completed = 'Yes';

    			$beneficiary_details->save();
    		}
    	}
    }
}
