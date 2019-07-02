<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\OldData\BeneficiaryDetailOldData;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pmjay_where = [];
        $pmjay_where['scheme'] = 'pmjay';
        $pmjay_where['status'] = 1;
        $pmjay_patients = BeneficiaryDetail::where($pmjay_where)->count();
        $pmjay_package_amount = BeneficiaryDetail::where($pmjay_where)->sum('package_amount');

        /*$pmjay_wherein = [];
        $pmjay_data = BeneficiaryDetail::where($pmjay_where)->get();
        foreach($pmjay_data as $k => $v) {
            $pmjay_wherein[] = $v->id;
        }

        $pmjay_hospital_cost_data = BeneficiaryDetailOldData::whereIn('beneficiary_detail_id', $pmjay_wherein)->select('investigation_cost', 'pet_cet_cost_cost', 'srl_cost', 'amrit_pharmacy_cost', 'dialysis_cost', 'endorscopy_cost', 'ot_cost', 'bed_cost', 'icu_cost', 'blood_transfusion_cost', 'implant_cost', 'vendor_reimbursement_cost', 'beneficiary_reimbursement_cost', 'beneficiary_ta_cost', 'vvi_cost', 'miscellaneous_cost')->get();

        $pmjay_hospital_cost = 0;

        foreach($pmjay_hospital_cost_data as $k1 => $v1) {
            $pmjay_hospital_cost += $v1->investigation_cost;
            $pmjay_hospital_cost += $v1->pet_cet_cost_cost;
            $pmjay_hospital_cost += $v1->srl_cost;
            $pmjay_hospital_cost += $v1->amrit_pharmacy_cost;
            $pmjay_hospital_cost += $v1->dialysis_cost;
            $pmjay_hospital_cost += $v1->endorscopy_cost;
            $pmjay_hospital_cost += $v1->ot_cost;
            $pmjay_hospital_cost += $v1->bed_cost;
            $pmjay_hospital_cost += $v1->icu_cost;
            $pmjay_hospital_cost += $v1->blood_transfusion_cost;
            $pmjay_hospital_cost += $v1->implant_cost;
            $pmjay_hospital_cost += $v1->vendor_reimbursement_cost;
            $pmjay_hospital_cost += $v1->beneficiary_reimbursement_cost;
            $pmjay_hospital_cost += $v1->beneficiary_ta_cost;
            $pmjay_hospital_cost += $v1->vvi_cost;
            $pmjay_hospital_cost += $v1->miscellaneous_cost;
        }

        $pmjay_amrit_cost_data = BeneficiaryDetailOldData::whereIn('beneficiary_detail_id', $pmjay_wherein)->select('amrit_pharmacy_cost','miscellaneous_cost')->get();

        $pmjay_amrit_cost = 0;

        foreach($pmjay_amrit_cost_data as $k2 => $v2) {
            $pmjay_amrit_cost += $v2->amrit_pharmacy_cost;
            $pmjay_amrit_cost += $v2->miscellaneous_cost;
        }*/

        return view('home', compact('pmjay_patients', 'pmjay_package_amount'));
    }
}
