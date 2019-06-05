<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;

class BeneficiaryCancelController extends Controller
{
    public function create($id) {
    	$beneficiary_details = BeneficiaryDetail::find($id);
    	return view('beneficiary_details.cancel.create', compact('beneficiary_details'));
    }

    public function save(Request $request) {
    	//dd($request->all()['disable_lists']);
        $beneficiary_details_id = Crypt::decrypt($request->beneficiary_details_id);
    	foreach($request->all()['disable_lists'] as $k => $v) {
            //echo 'Cancelling '.$v;
    		if($v == 'investigation') {
                DB::table('beneficiary_investigations')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'medicine_bill') {
    			DB::table('beneficiary_medicines')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}
    		
    		if($v == 'medicine_return') {
                DB::table('beneficiary_medicine_returns')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'srl') {
    			DB::table('beneficiary_srls')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'vendor_payment') {
    			DB::table('beneficiary_vendor_reimbursements')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'beneficary_payment') {
    			DB::table('beneficiary_reimbursements')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		/*if($v == 'blood_transfusion') {
    			DB::table('blood_transfusions')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}*/

    		if($v == 'ot') {
    			DB::table('beneficiary_details_o_t_charges')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'icu') {
    			DB::table('beneficiary_details_icu_charges')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'bed_charge') {
    			$cancel_beds = DB::table('beneficiary_details_bed_charges')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));

                //dump($cancel_beds);
    		}

    		if($v == 'dialysis') {
    			DB::table('beneficiary_detail_dialysis_charges')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}

    		if($v == 'pet_ct') {
    			DB::table('beneficiary_detail_pet_cts')->where('beneficiary_detail_id', $beneficiary_details_id)->update(array('status' => 0));
    		}
    	}

        $beneficiary_details = BeneficiaryDetail::find($beneficiary_details_id);

        $beneficiary_details->is_cancelled = 1;
        $beneficiary_details->cancellation_date = date('Y-m-d');
        $beneficiary_details->cancelled_by = Auth::user()->id;

        $beneficiary_details->save();

        return Redirect::route('beneficary_details.view_beneficiary', $beneficiary_details_id)->with(['message' => 'Beneficiary Cancelled !', 'alert-class' => 'alert-danger']);
    }
}
