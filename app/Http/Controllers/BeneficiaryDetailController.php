<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\OldData\BeneficiaryDetailOldData;
use App\Models\Master\PmjayPackage;

class BeneficiaryDetailController extends Controller
{
    public function viewAll(Request $request) {
    	$scheme = $request->scheme;
    	$wherein = [];
        $data = BeneficiaryDetail::where('scheme', $scheme)->get();
        foreach($data as $k => $v) {
            $wherein[] = $v->id;
        }

    	$beneficiary_details = BeneficiaryDetail::where('scheme', $scheme)
    							->where('status',1)
    							->paginate(500);

    	return view('beneficiary_details.view_all', compact('beneficiary_details'));
    }

    public function create(Request $request) {
        $pmjay_packages = PmjayPackage::where('status', 1)->pluck('procedure_name', 'id');
        if($request->hospital_type == 'cancer_hospital') {
            return view('beneficiary_details.create_cancer_hospital', compact('pmjay_packages'));
        }else if($request->hospital_type == 'mmch') {
            return view('beneficiary_details.create_mmch_hospital', compact('pmjay_packages'));
        }else{
            return view('beneficiary_details.create', compact('pmjay_packages'));
        }
        
    }

    public function save(Request $request) {
        $data = $request->all();
        if($request->date_of_admission != '') {
            $data['date_of_admission'] = date('Y-m-d', strtotime($request->date_of_admission));
        }else{
            return Redirect::back()->with(['message' => 'Date is empty', 'alert-class' => 'alert-danger']);
        }

        $data['inward_number'] = strtoupper($request->inward_number);
        $data['added_by'] = Auth::user()->id;
        $data['hospital_type'] = 'GMCH';
        $data['scheme'] = 'pmjay';

       // dd($data);

        $validator = Validator::make($data, BeneficiaryDetail::$rules);
                    if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $beneficiary_details = BeneficiaryDetail::create($data);

        return Redirect::route('beneficary_details.view_beneficiary', $beneficiary_details->id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
    }

    public function viewBeneficiary($id) {
        $beneficiary_details = BeneficiaryDetail::with('addedBy', 'cancelledBy')->whereId($id)->first();
        return view('beneficiary_details.view', compact('beneficiary_details'));
    }


    public function createDischargeInfo() {
        $all_beneficiaries  = BeneficiaryDetail::pluck('inward_number', 'id');
        return view('beneficiary_details.discharge_info_create', compact('all_beneficiaries'));
    }

    public function saveDischargeInfo(Request $request) {
        $beneficiary_detail_id = $request->beneficiary_detail_id;
        $beneficary_details = BeneficiaryDetail::find($beneficiary_detail_id);

        if($request->discharge_date) {
            $beneficary_details->discharge_date = date('Y-m-d', strtotime($request->discharge_date));
        }


        if($request->beneficiary_ta_cost) {
            $beneficary_details->beneficiary_ta_cost = $request->beneficiary_ta_cost;

            if($request->beneficiary_ta_cost > 0) {
                $beneficary_details->beneficiary_ta_date = date('Y-m-d');
            }
        }

        $beneficary_details->save();

        return Redirect::route('beneficary_details.view_beneficiary', $beneficiary_detail_id)->with(['message' => 'Updated successfully', 'alert-class' => 'alert-success']);
        
    }

    
}
