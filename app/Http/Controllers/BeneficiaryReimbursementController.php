<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;

class BeneficiaryReimbursementController extends Controller
{
    //beneficiary_reimbursement
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');

    	return view('beneficiary_details.beneficiary_reimbursement.create', compact('all_beneficiaries'));
    }
}
