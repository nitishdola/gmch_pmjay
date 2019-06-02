<?php

namespace App\Http\Controllers\REST;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\OldData\BeneficiaryDetailOldData;
use App\Models\Master\LabTest;
use App\Models\Master\PmjayPackage;

class ApiController extends Controller
{
    public function getBeneficiaryDetails(Request $request) {
    	$beneficiary_id = $request->beneficiary_id;
    	return BeneficiaryDetail::whereId($beneficiary_id)->first();
    }


    public function labTestDetails(Request $request) {
    	$test_id = $request->lab_test_id;
    	return LabTest::whereId($test_id)->first();
    }

    public function pmjayPackageDetails(Request $request) {
    	$package_id = $request->package_id;
    	return PmjayPackage::find($package_id);
    }
 
    public function addClaimsInfo(Request $request) { //dd($request->cliams_received);
        $beneficiary_details = BeneficiaryDetail::find($request->beneficiary_details_id);

        $beneficiary_details->cliams_received = $request->cliams_received;
        $beneficiary_details->deducted_by_sha = $request->deducted_by_sha;

        if($beneficiary_details->save()) {
            return 1;
        }else{
            return 0;
        }
        
    }
}
