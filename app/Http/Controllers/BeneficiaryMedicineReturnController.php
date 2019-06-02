<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryMedicineReturn;

class BeneficiaryMedicineReturnController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('beneficiary_details.medicine_return.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) {
        $chk = BeneficiaryMedicineReturn::where('medical_type', $request->medical_type)->where('invoice_number', $request->invoice_number)->count();

        if(!$chk):

        	$data = $request->all();
        	$data['bill_date'] = date('Y-m-d', strtotime($request->bill_date));
            $data['added_by'] = Auth::user()->id;
        	$validator = Validator::make($data, BeneficiaryMedicineReturn::$rules);
                        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

            BeneficiaryMedicineReturn::create($data);
        	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
        else:
            return Redirect::back()->with(['message' => 'Invoice Number '.$request->invoice_number.' already entered !', 'alert-class' => 'alert-danger']);
        endif;
    }
}
