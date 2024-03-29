<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryDetailsBloodTransfusion;
use App\Models\Master\BloodTransfusion;
class BeneficiaryDetailsBloodTransfusionController extends Controller
{
    public function create() {
        $all_beneficiaries      = BeneficiaryDetail::pluck('inward_number', 'id');
    	$blood_transfusions 	= BloodTransfusion::pluck('name', 'id');
    	return view('beneficiary_details.blood_transfusions.create', compact('all_beneficiaries', 'blood_transfusions'));
    }

    public function save(Request $request) { //dd(Auth::user());
        if(Helper::checkIfAllowed($request->beneficiary_detail_id)) {
        	$data = $request->all();
        	$data['test_date'] = date('Y-m-d', strtotime($request->test_date));
            $data['added_by'] = Auth::user()->id;
        	$validator = Validator::make($data, BeneficiaryDetailsBloodTransfusion::$rules);
                        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

            BeneficiaryDetailsBloodTransfusion::create($data);
        	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
        }else{
            return Redirect::back()->with(['message' => 'Blood Transfusion not allowed since TA bill date is more than 15 Days !', 'alert-class' => 'alert-danger']);
        }
    }
}
