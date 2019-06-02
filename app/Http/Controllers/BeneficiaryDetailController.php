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
        $beneficiary_details = BeneficiaryDetail::find($id);
        return view('beneficiary_details.view', compact('beneficiary_details'));
    }
}
