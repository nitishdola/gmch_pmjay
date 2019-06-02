<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryDetailsBloodTransfusion
class BeneficiaryDetailsBloodTransfusionController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('beneficiary_details.blood_transfusions.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) { //dd(Auth::user());
    	$data = $request->all();
    	$data['test_date'] = date('Y-m-d', strtotime($request->test_date));
        $data['added_by'] = Auth::user()->id;
    	$validator = Validator::make($data, BeneficiaryDetailsBloodTransfusion::$rules);
                    if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        BeneficiaryDetailsBloodTransfusion::create($data);
    	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
    }
}
