<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, DateTime;
use App\Models\BeneficiaryDetail;
use App\Models\OldData\BeneficiaryDetailOldData;
use App\Models\Master\PmjayPackage;

class PmjayReportsController extends Controller
{
    public function beneficiaryDischargeReport(Request $request) {
    	$res = BeneficiaryDetail::where('status', 1)->where('discharge_date', NULL)->where('is_cancelled', '!=', 1)->get();
    	
    	$not_discharged_beneficiaries = [];

		foreach($res as $k => $v) { 
			$date_of_admission = $v->date_of_admission;
			$current_date = date('Y-m-d');

			/*$date1 = new DateTime($v->date_of_admission);
			$date2 = new DateTime( date('Y-m-d') );
			$interval = $date1->diff($date2);*/

			//dump($interval->m);

			$diff = abs(strtotime($current_date) - strtotime($date_of_admission));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			//dd($days);
			if($months > 1 && $days > 15) {
				$not_discharged_beneficiaries[$k]['id'] = $v->id;
				$not_discharged_beneficiaries[$k]['name_of_patient'] = $v->name_of_patient;
				$not_discharged_beneficiaries[$k]['date_of_admission'] = $v->date_of_admission;
				$not_discharged_beneficiaries[$k]['inward_number'] = $v->inward_number;
				$not_discharged_beneficiaries[$k]['mrd_number'] = $v->mrd_number;
			}
			
		}

		return view('reports.pmjay.beneficiary_discharge_report', compact('not_discharged_beneficiaries'));
    }


    public function beneficiaryClaimReportSha(Request $request) {
    	$res = BeneficiaryDetail::where('status', 1)->where('discharge_date', '!=', NULL)->where('is_cancelled', '!=', 1)->where('cliams_received', '>', 0)->get();
    	
    	$sha_claim_not_paid = [];

		foreach($res as $k => $v) { 
			$discharge_date = $v->discharge_date;
			$current_date = date('Y-m-d');

			$diff = abs(strtotime($current_date) - strtotime($discharge_date));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			//dd($days);
			if($months >= 1 ) {
				$sha_claim_not_paid[$k]['id'] = $v->id;
				$sha_claim_not_paid[$k]['name_of_patient'] = $v->name_of_patient;
				$sha_claim_not_paid[$k]['discharge_date'] = $v->discharge_date;
				$sha_claim_not_paid[$k]['inward_number'] = $v->inward_number;
				$sha_claim_not_paid[$k]['mrd_number'] = $v->mrd_number;
			}
			
		}

		return view('reports.pmjay.sha_report', compact('sha_claim_not_paid'));
    }
}
