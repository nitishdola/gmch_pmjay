<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, DateTime;
use App\Models\BeneficiaryDetail;
use App\Models\OldData\BeneficiaryDetailOldData;
use App\Models\Master\PmjayPackage;

use App\Models\BeneficiaryInvestigation;
use App\Models\BeneficiaryMedicine;
use App\Models\BeneficiaryMedicineReturn;
use App\Models\BeneficiarySrl;
use App\Models\BeneficiaryVendorReimbursement;
use App\Models\BeneficiaryDetailsBloodTransfusion;
use App\Models\BeneficiaryDetailsOTCharge;
use App\Models\BeneficiaryDetailsIcuCharge;
use App\Models\BeneficiaryDetailsBedCharge;
use App\Models\BeneficiaryDetailDialysisCharge;
use App\Models\BeneficiaryDetailPetCt;
use App\Models\BeneficiaryReimbursement;

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

    public function investigationReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	if($request->lab_test_id) {
    		$where['lab_test_id'] = $request->lab_test_id;
    	}

    	$data = BeneficiaryInvestigation::where($where);

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('test_date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('test_date', '<=', $date_to);
    	}

    	$results = $data->orderBy('test_date', 'DESC')->get();

    	return view('reports.pmjay.investigation_report', compact('results'));
    }

    public function medicineReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	if($request->medical_type) {
    		$where['medical_type'] = $request->medical_type;
    	}

    	$data = BeneficiaryMedicine::where($where);

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('bill_date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('bill_date', '<=', $date_to);
    	}

    	$results = $data->orderBy('bill_date', 'DESC')->get();

    	return view('reports.pmjay.medicine_report', compact('results'));
    }

    public function medicineReturnReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	if($request->medical_type) {
    		$where['medical_type'] = $request->medical_type;
    	}

    	$data = BeneficiaryMedicineReturn::where($where);

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('bill_date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('bill_date', '<=', $date_to);
    	}

    	$results = $data->orderBy('bill_date', 'DESC')->get();

    	return view('reports.pmjay.medicine_return_report', compact('results'));
    }


    public function srlReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	$data = BeneficiarySrl::where($where);

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('test_date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('test_date', '<=', $date_to);
    	}

    	$results = $data->orderBy('test_date', 'DESC')->get();

    	return view('reports.pmjay.srl_report', compact('results'));
    }


    public function vendorPaymentReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	$data = BeneficiaryVendorReimbursement::where($where);

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('date', '<=', $date_to);
    	}

    	if($request->vendor_name) {
    		$data = $data->where('vendor_name', 'like', '%' . $request->vendor_name . '%');
    	}

    	$results = $data->orderBy('date', 'DESC')->get(); //dump($results);

    	return view('reports.pmjay.vendor_payment_report', compact('results'));
    }


    public function beneficiaryPaymentReport(Request $request) {
        $where['status'] = 1;

        if($request->beneficiary_detail_id) {
            $where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
        }

        $data = BeneficiaryReimbursement::where($where);

        if($request->date_from) {
            $date_from = date('Y-m-d', strtotime($request->date_from));
            $data = $data->where('date', '>=', $date_from);
        }

        if($request->date_to) {
            $date_to = date('Y-m-d', strtotime($request->date_to));
            $data = $data->where('date', '<=', $date_to);
        }

        $results = $data->orderBy('date', 'DESC')->get(); //dump($results);

        return view('reports.pmjay.beneficiary_payment_report', compact('results'));
    }

    public function bloodTransfusionReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	if($request->blood_transfusion_id) {
    		$where['blood_transfusion_id'] = $request->blood_transfusion_id;
    	}

    	$data = BeneficiaryDetailsBloodTransfusion::where($where);

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('test_date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('test_date', '<=', $date_to);
    	}

    	$results = $data->orderBy('test_date', 'DESC')->get();

    	return view('reports.pmjay.blood_transfusion_report', compact('results'));
    }


    public function otReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	$data = BeneficiaryDetailsOTCharge::where($where);

    	if($request->name) {
    		$data = $data->where('name', 'like', '%' . $request->name . '%');
    	}

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('date', '<=', $date_to);
    	}

    	$results = $data->orderBy('date', 'DESC')->get();

    	return view('reports.pmjay.ot_report', compact('results'));
    }


    public function icuReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	$data = BeneficiaryDetailsIcuCharge::where($where);

    	if($request->name) {
    		$data = $data->where('name', 'like', '%' . $request->name . '%');
    	}

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('date', '<=', $date_to);
    	}

    	$results = $data->orderBy('date', 'DESC')->get();

    	return view('reports.pmjay.icu_report', compact('results'));
    } 


    public function bedChargeReport(Request $request) {
        $where['status'] = 1;

        if($request->beneficiary_detail_id) {
            $where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
        }

        $data = BeneficiaryDetailsBedCharge::where($where);

        if($request->name) {
            $data = $data->where('name', 'like', '%' . $request->name . '%');
        }

        if($request->date_from) {
            $date_from = date('Y-m-d', strtotime($request->date_from));
            $data = $data->where('date', '>=', $date_from);
        }

        if($request->date_to) {
            $date_to = date('Y-m-d', strtotime($request->date_to));
            $data = $data->where('date', '<=', $date_to);
        }

        $results = $data->orderBy('date', 'DESC')->get();
        //dump($results);
        return view('reports.pmjay.bed_report', compact('results'));
    }

    public function petCtReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	$data = BeneficiaryDetailPetCt::where($where);

    	if($request->name) {
    		$data = $data->where('name', 'like', '%' . $request->name . '%');
    	}

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('date', '<=', $date_to);
    	}

    	$results = $data->orderBy('date', 'DESC')->get();

    	return view('reports.pmjay.petct_report', compact('results'));
    }


    public function dialysisReport(Request $request) {
    	$where['status'] = 1;

    	if($request->beneficiary_detail_id) {
    		$where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
    	}

    	$data = BeneficiaryDetailDialysisCharge::where($where);

    	if($request->name) {
    		$data = $data->where('name', 'like', '%' . $request->name . '%');
    	}

    	if($request->date_from) {
    		$date_from = date('Y-m-d', strtotime($request->date_from));
    		$data = $data->where('date', '>=', $date_from);
    	}

    	if($request->date_to) {
    		$date_to = date('Y-m-d', strtotime($request->date_to));
    		$data = $data->where('date', '<=', $date_to);
    	}

    	$results = $data->orderBy('date', 'DESC')->get();

    	return view('reports.pmjay.dialysis_report', compact('results'));
    }
} 
