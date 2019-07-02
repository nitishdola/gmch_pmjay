<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryDetailAdditionalPackage;
use App\Models\Master\PmjayPackage;
class BeneficiaryDetailsAdditionalPackagesController extends Controller
{
    public function create() {
        $all_beneficiaries  = BeneficiaryDetail::pluck('inward_number', 'id');
    	$pmjay_packages = PmjayPackage::where('status', 1)->pluck('procedure_name', 'id');
    	return view('beneficiary_details.additional_packages.create', compact('all_beneficiaries', 'pmjay_packages'));
    }

    public function save(Request $request) { 

        if(Helper::checkIfAllowed($request->beneficiary_detail_id)) {
        	$data = $request->all();
        	$data['date'] = date('Y-m-d', strtotime($request->date));
            $data['added_by'] = Auth::user()->id;
        	$validator = Validator::make($data, BeneficiaryDetailAdditionalPackage::$rules);
                        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

            BeneficiaryDetailAdditionalPackage::create($data);
        	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Package added successfully', 'alert-class' => 'alert-success']);
        }else{
            return Redirect::back()->with(['message' => 'Additional Package not allowed since TA bill date is more than 15 Days !', 'alert-class' => 'alert-danger']);
        }
    }

    public function index(Request $request) {
        $where = [];

        $where['status'] = 1;

        if($request->beneficiary_detail_id) {
            $where['beneficiary_detail_id'] = $request->beneficiary_detail_id;
        }
        //dd($where);
        $results = BeneficiaryDetailAdditionalPackage::where($where)->with('package')->get();
        //dd($results);
        return view('beneficiary_details.additional_packages.index', compact('results'));
    }
}
