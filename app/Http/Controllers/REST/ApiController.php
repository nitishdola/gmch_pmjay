<?php

namespace App\Http\Controllers\REST;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon, Helper;
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

        if($request->cliams_received > 0) {
            $beneficiary_details->cliams_receive_date = date('Y-m-d', strtotime($request->cliams_receive_date));
        }

        $beneficiary_details->deducted_by_sha = $request->deducted_by_sha;

        if($beneficiary_details->save()) {
            return 1;
        }else{
            return 0;
        }
        
    }

    public function getBalance(Request $request) {
        $beneficiary_details = BeneficiaryDetail::find($request->beneficiary_details_id);

        $entered_amount = $request->amount;

        $package_amount = Helper::getPackage($request->beneficiary_details_id)['amount'];

        $total_cost = Helper::getInvestigationCost($request->beneficiary_details_id)
                        +Helper::getDialysisCost($request->beneficiary_details_id)
                        +Helper::getBloodTransfusionCost($request->beneficiary_details_id)
                        +Helper::getEndorscopyCost($request->beneficiary_details_id)
                        +Helper::getBedCost($request->beneficiary_details_id)
                        +Helper::getIcuCost($request->beneficiary_details_id)
                        +Helper::getOTCost($request->beneficiary_details_id)
                        +Helper::getPetCetCost($request->beneficiary_details_id)
                        +Helper::getVendorReimbursementCost($request->beneficiary_details_id)
                        +Helper::getBeneficiaryReimbursementCost($request->beneficiary_details_id)
                        +Helper::getMedicineCost($request->beneficiary_details_id)
                        -Helper::getMedicineReturnCost($request->beneficiary_details_id)
                        +Helper::getTACost($request->beneficiary_details_id)
                        +Helper::getSRLCost($request->beneficiary_details_id)
                        +$entered_amount;

        $arr = [];

        $arr['package_amount']  = $package_amount;
        $arr['total_cost']      = $total_cost;
        $arr['remaining_balance']      = $package_amount - $total_cost;

        return json_encode($arr);
    }
}
