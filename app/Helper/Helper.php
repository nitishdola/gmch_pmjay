<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;
class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function moneyFormatIndia($num) {
	    $explrestunits = "" ;
		$num = preg_replace('/,+/', '', $num);
		$words = explode(".", $num);
		$des = "00";
		if(count($words)<=2){
		    $num=$words[0];
		    if(count($words)>=2){$des=$words[1];}
		    if(strlen($des)<2){$des="$des";}else{$des=substr($des,0,2);}
		}
		if(strlen($num)>3){
		    $lastthree = substr($num, strlen($num)-3, strlen($num));
		    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
		    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
		    $expunit = str_split($restunits, 2);
		    for($i=0; $i<sizeof($expunit); $i++){
		        // creates each of the 2's group and adds a comma to the end
		        if($i==0)
		        {
		            $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
		        }else{
		            $explrestunits .= $expunit[$i].",";
		        }
		    }
		    $thecash = $explrestunits.$lastthree;
		} else {
		    $thecash = $num;
		}
		return "$thecash.$des";
	}

	private static function getOldData($beneficiary_details_id ) {
		return DB::table('beneficiary_detail_old_data')->where('beneficiary_detail_id', $beneficiary_details->id)->first();
	}
	public static function getPackage($beneficiary_details_id = null) {
		$package_info = [];

		//$old_data = $this->getOldData($beneficiary_details_id);
		$ben_details = DB::table('beneficiary_details')->select('package_id', 'package_amount', 'name_of_package')->where('id', $beneficiary_details_id)->first();

		$package_id = $ben_details->package_id;

		if($package_id) {
			$pinfo = DB::table('pmjay_packages')->where('id', $package_id)->first();
			//dd($pinfo);
			$package_info['name']  		= $pinfo->procedure_name;
			$package_info['amount']  	= $ben_details->package_amount;//$ben_details->non_nabh_package_amount;

		}else{
			$package_info['name']  		= $ben_details->name_of_package;
			$package_info['amount']  	= $ben_details->package_amount;
		}

		return $package_info;
	}

	public static function getInvestigationCost($beneficiary_details_id = null) {
		$total_investigation_cost = 0;
		$old_where = [];

		$old_where['status'] = 1;

		if($beneficiary_details_id != null) {
			$old_where['beneficiary_detail_id'] = $beneficiary_detail_id;
		}

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_investigation_cost = 0;
		if($old_data) {

			foreach($old_data as $k => $v):
				$old_investigation_cost += $v->investigation_cost;
			endforeach;
		}

		$where = [];
		$where['status'] = 1;
		$investigations = DB::table('beneficiary_investigations')->where('beneficiary_detail_id', $beneficiary_details_id)->where($where)->get();

        $new_investigation_cost = 0;

        foreach($investigations as $ik => $iv) {
          $new_investigation_cost += $iv->amount;
        }

        $total_investigation_cost = $new_investigation_cost+$old_investigation_cost;

        return $total_investigation_cost;
	}


	public static function getDialysisCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_dialysis_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_dialysis_cost = 0;
		if($old_data) {

			foreach($old_data as $k => $v):
				$old_dialysis_cost = $v->dialysis_cost;
			endforeach;
			
		}

		$dialysis = DB::table('beneficiary_detail_dialysis_charges')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_dialysis_cost = 0;

        foreach($dialysis as $ik => $iv) {
          $new_dialysis_cost += $iv->amount;
        }

        $total_dialysis_cost = $new_dialysis_cost+$old_dialysis_cost;

        return $total_dialysis_cost;
	}


	public static function getBloodTransfusionCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;

		$old_where = [];

		$old_where['status'] = 1;


		$total_blood_transfusion_cost = 0;
		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_blood_transfusion_cost = 0;
		if($old_data) {

			foreach($old_data as $k => $v):
				$old_blood_transfusion_cost = $v->blood_transfusion_cost;
			endforeach;
			
		}

		$blood_transfusions = DB::table('beneficiary_details_blood_transfusions')->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_blood_transfusion_cost = 0;

        foreach($blood_transfusions as $ik => $iv) {
          $new_blood_transfusion_cost += $iv->amount;
        }

        $total_blood_transfusion_cost = $new_blood_transfusion_cost+$old_blood_transfusion_cost;

        return $total_blood_transfusion_cost;
	}


	public static function getEndorscopyCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;

		$old_where = [];

		$old_where['status'] = 1;

		$total_endorscopy_cost = 0;
		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_endorscopy_cost = 0;
		if($old_data) {

			foreach($old_data as $k => $v):
				$old_endorscopy_cost = $v->endorscopy_cost;
			endforeach;
			
		}

		$endorscopy = DB::table('beneficiary_detail_endorscopy_charges')->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_endorscopy_cost = 0;

        foreach($endorscopy as $ik => $iv) {
          $new_endorscopy_cost += $iv->amount;
        }

        $total_endorscopy_cost = $new_endorscopy_cost+$old_endorscopy_cost;

        return $total_endorscopy_cost;
	}

	public static function getBedCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_bedcost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_bed_cost = 0;
		if($old_data) {
			foreach($old_data as $k => $v):
				$old_bed_cost = $v->bed_cost;
			endforeach;
			
		}

		$bed_costs = DB::table('beneficiary_details_bed_charges')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_bed_cost = 0;

        foreach($bed_costs as $ik => $iv) {
          $new_bed_cost += $iv->amount;
        }

        $total_bedcost = $new_bed_cost+$old_bed_cost;

        return $total_bedcost;
	}


	public static function getIcuCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_icu_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_icu_cost = 0;
		if($old_data) {
			foreach($old_data as $k => $v):
				$old_icu_cost = $v->icu_cost;
			endforeach;
			
		}

		$icu_costs = DB::table('beneficiary_details_icu_charges')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_icu_cost = 0;

        foreach($icu_costs as $ik => $iv) {
          $new_icu_cost += $iv->amount;
        }

        $total_icu_cost = $new_icu_cost+$old_icu_cost;

        return $total_icu_cost;
	}

	public static function getOTCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_ot_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_ot_cost = 0;
		if($old_data) {
			foreach($old_data as $k => $v):
				$old_ot_cost = $v->ot_cost;
			endforeach;
			
		}

		$ot_costs = DB::table('beneficiary_details_o_t_charges')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_ot_cost = 0;

        foreach($ot_costs as $ik => $iv) {
          $new_ot_cost += $iv->amount;
        }

        $total_ot_cost = $new_ot_cost+$old_ot_cost;

        return $total_ot_cost;
	}


	public static function getPetCetCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_petcet_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_petcet_cost = 0;
		if($old_data) {
			foreach($old_data as $k => $v):
				$old_petcet_cost = $v->pet_cet_cost_cost;
			endforeach;
			
		}

		$petcet_costs = DB::table('beneficiary_detail_pet_cts')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_petcet_cost = 0;
//dd($petcet_costs);
        foreach($petcet_costs as $ik => $iv) {
          $new_petcet_cost += $iv->amount;
        }

        $total_petcet_cost = $new_petcet_cost+$old_petcet_cost;

        return $total_petcet_cost;
	}


	public static function getVendorReimbursementCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_vr_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_vr_cost = 0;
		if($old_data) {
			$old_vr_cost = $old_data->vendor_reimbursement_cost;
		}

		$vr_costs = DB::table('beneficiary_vendor_reimbursements')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_vr_cost = 0;

        foreach($vr_costs as $ik => $iv) {
          $new_vr_cost += $iv->amount;
        }

        $total_vr_cost = $new_vr_cost+$old_vr_cost;

        return $total_vr_cost;
	}

	public static function getBeneficiaryReimbursementCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_br_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_br_cost = 0;
		if($old_data) {
			$old_br_cost = $old_data->beneficiary_reimbursement_cost;
		}

		$vr_costs = DB::table('beneficiary_reimbursements')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_br_cost = 0;

        foreach($vr_costs as $ik => $iv) {
          $new_br_cost += $iv->amount;
        }

        $total_br_cost = $new_br_cost+$old_br_cost;

        return $total_br_cost;
	}


	public static function getMedicineCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_medicine_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_medicine_cost = 0;
		if($old_data) {
			$old_medicine_cost = $old_data->miscellaneous_cost+$old_data->amrit_pharmacy_cost;
		}

		$medicine_costs = DB::table('beneficiary_medicines')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_medicine_cost = 0;

        foreach($medicine_costs as $ik => $iv) {
          $new_medicine_cost += $iv->amount;
        }

        $total_medicine_cost = $new_medicine_cost+$old_medicine_cost;

        return $total_medicine_cost;
	} 

	public static function getMedicineReturnCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_medicine_return_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_medicine_return_cost = 0;
		if($old_data) {
			$old_medicine_return_cost = $old_data->medicine_return_cost;
		}

		$medicine_costs = DB::table('beneficiary_medicine_returns')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_medicine_return_cost = 0;

        foreach($medicine_costs as $ik => $iv) {
          $new_medicine_return_cost += $iv->amount;
        }

        $total_medicine_return_cost = $new_medicine_return_cost+$old_medicine_return_cost;

        return $total_medicine_return_cost;
	}


	public static function getTACost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_ta_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_ta_cost = 0;
		if($old_data) {
			$old_ta_cost = $old_data->beneficiary_ta_cost;
		}

		$new_ta_cost = DB::table('beneficiary_details')->where($where)->where('id', $beneficiary_details_id)->first()->beneficiary_ta_cost;

        $total_ta_cost = $new_ta_cost+$old_ta_cost;

        return $total_ta_cost;
	}


	public static function getSRLCost($beneficiary_details_id = null) {
		$where = [];
		$where['status'] = 1;
		$total_srl_cost = 0;

		$old_where = [];

		$old_where['status'] = 1;

		$old_data = DB::table('beneficiary_detail_old_data')->where($old_where)->get();
		$old_srl_cost = 0;
		if($old_data) {
			$old_srl_cost = $old_data->srl_cost;
		}

		$srl_costs = DB::table('beneficiary_srls')->where($where)->where('beneficiary_detail_id', $beneficiary_details_id)->get();

        $new_srl_cost = 0;

        foreach($srl_costs as $ik => $iv) {
          $new_srl_cost += $iv->amount;
        }

        $total_srl_cost = $new_srl_cost+$old_srl_cost;

        return $total_srl_cost;
	} 

	public static function checkIfAllowed($beneficiary_details_id) {
		$beneficiary_details = DB::table('beneficiary_details')->select('beneficiary_ta_date')->where('id', $beneficiary_details_id)->first();

		if($beneficiary_details->beneficiary_ta_date != '') {
			$beneficiary_ta_date = $beneficiary_details->beneficiary_ta_date;

			$now = time();
			$beneficiary_ta_date = strtotime($beneficiary_ta_date);
			$datediff = $now - $beneficiary_ta_date;

			$gap = round($datediff / (60 * 60 * 24));

			if($gap > 15) {
				return false;
			}
		}

		return true;
	}
}