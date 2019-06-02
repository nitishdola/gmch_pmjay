<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryDetailDialysisCharge;

class BeneficiaryDetailDialysisChargeController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('beneficiary_details.dialysis.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) {

        if(Helper::checkIfAllowed($request->beneficiary_detail_id)) {
            //check if unique date
            $chk = BeneficiaryDetailDialysisCharge::where('date', date('Y-m-d', strtotime($request->date)))->where('beneficiary_detail_id', $request->beneficiary_detail_id)->count();

            if(!$chk):

                $data = $request->all();
                $data['date'] = date('Y-m-d', strtotime($request->date));
                $data['added_by'] = Auth::user()->id;
                $validator = Validator::make($data, BeneficiaryDetailDialysisCharge::$rules);
                            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

                BeneficiaryDetailDialysisCharge::create($data);
                return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
            else:
                return Redirect::back()->with(['message' => 'Dialysis for date '.$request->date.' already done !', 'alert-class' => 'alert-danger']);
            endif;
        }else{
            return Redirect::back()->with(['message' => 'Dialysis not allowed since TA bill date is more than 15 Days !', 'alert-class' => 'alert-danger']);
        }

    }
}
