<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
use App\Models\BeneficiaryDetail;
use App\Models\BeneficiaryDetailPetCt;
class BeneficiaryDetailPetCtController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('beneficiary_details.pet_ct.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) { //dd(Auth::user());

        if(Helper::checkIfAllowed($request->beneficiary_detail_id)) {
        	$data = $request->all();
        	$data['date'] = date('Y-m-d', strtotime($request->date));
            $data['added_by'] = Auth::user()->id;
        	$validator = Validator::make($data, BeneficiaryDetailPetCt::$rules);
                        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

            BeneficiaryDetailPetCt::create($data);
        	return Redirect::route('beneficary_details.view_beneficiary', $request->beneficiary_detail_id)->with(['message' => 'Added successfully', 'alert-class' => 'alert-success']);
        }else{
            return Redirect::back()->with(['message' => 'PET CT not allowed since TA bill date is more than 15 Days !', 'alert-class' => 'alert-danger']);
        }
    }
}
