<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryInvestigation;
use App\Models\Master\LabTest;

class BeneficiaryInvestigationController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	$all_tests 			= LabTest::pluck('name', 'id');
    	//dd($all_beneficiaries);
    	return view('beneficiary_details.investigations.create', compact('all_beneficiaries', 'all_tests'));
    }

    public function save(Request $request) {
    	$data = [];

    	$data['beneficiary_detail_id'] 	= $request->beneficiary_detail_id;
    	$data['lab_test_id'] 			= $request->lab_test_id;

    	$data['amount'] 				= $request->amount;
    	$data['test_date'] 				= date('Y-m-d', strtotime($request->test_date));
    	$data['added_by']				= Auth::user()->id;
    	
    	$validator = Validator::make($data, BeneficiaryInvestigation::$rules);
		    		if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
		//DB::begintransaction();

		$beneficiary = BeneficiaryInvestigation::create($data);

		if($beneficiary) {
			//add to total expenditure
			$beneficiary_details = BeneficiaryDetail::find($request->beneficiary_detail_id);
			$old_expenditure = $beneficiary_details->total_expenditure;
			$new_expenditure = $old_expenditure+$request->amount;

			$old_remaining = $beneficiary_details->remaining_amount;
			$new_remaining = $old_remaining-$request->amount;

			$beneficiary_details->total_expenditure = $new_expenditure;
			$beneficiary_details->remaining_amount = $new_remaining;

			$beneficiary_details->save();

			return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Investigation added successfully !', 'alert-class' => 'alert-success']);
		}else{
			return Redirect::back()->with(['message' => 'Investigation could not update !', 'alert-class' => 'alert-danger']);
		}

		//DB::commit();

    }
}
