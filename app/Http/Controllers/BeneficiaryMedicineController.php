<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryMedicine;

class BeneficiaryMedicineController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('beneficiary_details.medicine.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) { //dd(Auth::user());
    	$data = $request->all();
    	$data['bill_date'] = date('Y-m-d', strtotime($request->bill_date));
        $data['added_by'] = Auth::user()->id;
    	$validator = Validator::make($data, BeneficiaryMedicine::$rules);
                    if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        BeneficiaryMedicine::create($data);
    	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
    }
}
