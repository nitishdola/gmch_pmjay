<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryMedicine;

class BeneficiaryMedicineController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('beneficiary_details.medicine.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) {
        //if(Helper::checkIfAllowed($request->beneficiary_detail_id)) {
            $chk = BeneficiaryMedicine::where('medical_type', $request->medical_type)->where('invoice_number', $request->invoice_number)->count();

            if(!$chk):
            	$data = $request->all();
            	$data['bill_date'] = date('Y-m-d', strtotime($request->bill_date));
                $data['added_by'] = Auth::user()->id;
            	$validator = Validator::make($data, BeneficiaryMedicine::$rules);
                            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

                BeneficiaryMedicine::create($data);
            	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
            else:
                return Redirect::back()->with(['message' => 'Invoice Number '.$request->invoice_number.' already entered !', 'alert-class' => 'alert-danger']);
            endif;
        /*}else{
            return Redirect::back()->with(['message' => 'Investigation not allowed since TA bill date is more than 15 Days !', 'alert-class' => 'alert-danger']);
        }*/

    }
}
