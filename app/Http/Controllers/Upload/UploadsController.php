<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
use App\Models\BeneficiaryDetail;
use App\Models\OldData\BeneficiaryDetailOldData;
use App\Models\Ward;

use DateTime;

class UploadsController extends Controller
{
    public function uploadData() {
    	return view('uploads.upload');
    }

    public function saveData(Request $request) {
    	$path = $request->file('lat_dept_data')->getRealPath();
    	$data = Excel::load($path, function($reader) {})->get();

        $record = 0;

        DB::beginTransaction();
        //dd($data[3]);

        /*foreach($data as $k => $v) {
            echo '<br>'.$v->date_of_admission;
            echo '<br>'.Carbon::parse($v->date_of_admission)->format('Y-m-d');
            
        }*/

        //exit;
        //dd($data);
    	foreach($data[0] as $k => $v) { //
    		if($v->inward_number != '') {
                $beneficiary_details = [];

                

                $beneficiary_details['register_sl_no'] = $v->register_sl_no;
                $beneficiary_details['name_of_patient'] = $v->name_of_patient;
                $beneficiary_details['urn'] = $v->urn;

                $date_of_admission = Carbon::parse($v->date_of_admission)->format('Y-m-d');

                $beneficiary_details['date_of_admission'] = $date_of_admission;


                $inward_check = BeneficiaryDetail::where('inward_number', $v->inward_number)->count();

                if(!$inward_check) {
                    $inward_number = trim($v->inward_number);
                }else{
                    $inward_number = trim($v->inward_number).'_DUP'.uniqid();
                }

                $beneficiary_details['inward_number'] = $inward_number;
                


                $beneficiary_details['hospital_number'] = $v->hospital_number;

                $mrdno = trim($v->mrd_no);

                $cancel = 0;

                if(strpos($mrdno, 'cancel')) {
                    $cancel = 1;
                }

                if(strpos($mrdno, 'close')) {
                    $cancel = 1;
                }

                if($cancel):
         
                    $beneficiary_details['mrd_number']      = NULL;
                    $beneficiary_details['is_cancelled']    = 1;
                else:
                    $beneficiary_details['mrd_number'] = $v->mrd_no;
                endif;

                if($v->discharge_date):
                    if((bool)strtotime($v->discharge_date)):
                        $discharge_date = Carbon::parse($v->discharge_date)->format('Y-m-d');
                    else:
                        $discharge_date = NULL;
                    endif;
                else:
                    $discharge_date = NULL;
                endif;

                $beneficiary_details['discharge_date']  = $discharge_date;
                $beneficiary_details['name_of_package'] = $v->name_of_package;
                /*if($v->package_amount =! null) {
                    $beneficiary_details['package_amount']  = $v->package_amount;
                }else{
                    $beneficiary_details['package_amount']  = 0;
                }*/

                $beneficiary_details['package_amount']  = (float) $v->package_amount;
                
                $beneficiary_details['total_expenditure'] = $v->total_expenditure;
                if($v->remaining_amount != '') {
                    $rem = $v->remaining_amount;
                }else{
                    $rem = 0;
                }
                $beneficiary_details['remaining_amount']    = $rem;
                $beneficiary_details['cliams_received']     = $v->claims_received;
                $beneficiary_details['deducted_by_sha']     = $v->deducted_by_sha;
                $beneficiary_details['remarks'] = $v->remarks;
                $beneficiary_details['scheme']  = 'pmjay';
                

                $validator = Validator::make($beneficiary_details, BeneficiaryDetail::$rules);
                    if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
                
                if($beneficiaryDetails = BeneficiaryDetail::create($beneficiary_details)) {
                    $old_data = [];

                    //echo '<p> Inserting '.$v->inward_number;

                    $old_data['beneficiary_detail_id']  = $beneficiaryDetails->id;

                    $investigation_cost = 0;

                    if(is_numeric($v->investigation_upto_05022019)) {
                        $investigation_cost += $v->investigation_upto_05022019;
                    }
                    if(is_numeric($v->investigation)) {
                        $investigation_cost += $v->investigation;
                    }

                    $old_data['investigation_cost']     = $investigation_cost;



                    $pet_ct = 0;
                    if(is_numeric($v->pet_ct)) {
                        $pet_ct += $v->pet_ct;
                    }

                    $old_data['pet_cet_cost_cost']      = $pet_ct;

                    

                    $miscellaneous_cost                 = 0;



                    $miscellaneous_cost                 = $v->spt18 + $v->octb18 + $v->novm18 + $v->decm18 + $v->janr19 + $v->feby19 + $v->marh19 + $v->apl19+ $v->may_19+ $v->jun_19;

                    $old_data['miscellaneous_cost']     = $miscellaneous_cost;


                    $dialysis_charge_upto_05022019 = 0;
                    if(is_numeric($v->dialysis_charge_upto_05022019)) {
                        $dialysis_charge_upto_05022019 = $v->dialysis_charge_upto_05022019;
                    }

                    $dialysis_charge = 0;

                    if(is_numeric($v->dialysis_charge)) {
                        $dialysis_charge = $v->dialysis_charge;
                    }


                    $old_data['dialysis_cost']          = $dialysis_charge_upto_05022019+$dialysis_charge;

                    $old_data['endorscopy_cost']        = $v->endorscopy_upto_05022019+$v->endoscopy;
                    $old_data['ot_cost']                = $v->ot_charge_upto_05022019+$v->ot_charge;

                    $bed_charge_upto_05022018 = 0;
                    if(is_numeric($v->bed_charge_upto_05022018)) {
                        $bed_charge_upto_05022018 = $v->bed_charge_upto_05022018;
                    }

                    $bed_charge = 0;
                    if(is_numeric($v->bed_charge)) {
                        $bed_charge = $v->bed_charge;
                    }


                    $old_data['bed_cost']               = $bed_charge_upto_05022018+$bed_charge;
                    

                    $icu_charge=0;
                    if(is_numeric($v->icu_charge)) {
                        $icu_charge = $v->icu_charge;
                    }
                    $old_data['icu_cost']               = $v->icu_charge_upto_05022019+$icu_charge;

                    $blood_transfusion_charge = 0;
                    if(is_numeric($v->blood_transfusion_charge)) {
                        $blood_transfusion_charge = $v->blood_transfusion_charge;
                    }

                    $old_data['blood_transfusion_cost'] = $v->blood_transfusion_charge_upto_05022019+$blood_transfusion_charge;

                    $implant_cost = trim($v->implantstent);

                    if($implant_cost == '') {
                        $implant_cost = 0;
                    }
                    if(!is_numeric( $implant_cost )) {
                        $implant_cost = 0;
                    }

                    $old_data['implant_cost']           = $implant_cost;

                    $old_data['vendor_reimbursement_cost']  = $v->vendors;
                    $old_data['beneficiary_reimbursement_cost']     = 0;//$v->beneficiaries;
                    $old_data['vvi_cost']               = $v->vvi;
                    $old_data['medicine_return_cost']   = $v->medicine_return;
                    $old_data['beneficiary_ta_cost']    = $v->ta;

                    //dd($old_data);

                    BeneficiaryDetailOldData::create($old_data);

                    $record++;
                }
    		}else{
                echo '<br>Inward Number '.$v->name_of_patient.'IW Number'.$v->inward_number.'  not found';
            }
    	}

        DB::commit();

        return $record.' inserted !';
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function uploadWards() {
        return view('uploads.wards');
    }

    public function saveWards(Request $request) {
        $path = $request->file('ward_data')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();

        $record = 0;

        //dd($data[0][0]);
        foreach($data[0] as $k => $v) {
            $ward_dta = [];

            $ward_dta['name'] = $v->unit_for_admission;

            Ward::create($ward_dta);
        }
    }
}