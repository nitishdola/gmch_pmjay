@extends('layouts.default')


@section('pageCss')
<style>
#background{
    position:absolute;
    z-index:0;
    display:block;
    min-height:50%; 
    min-width:50%;
    color:yellow;
}


#bg-text
{ 
    padding-top: 200px;
    padding-left: 200px;
    color:#F68787;
    font-size:80px;
    transform:rotate(310deg);
    -webkit-transform:rotate(350deg);
    font-family: Copperplate,"Copperplate Gothic Light",fantasy
}
</style>
@stop

@section('content')

<?php 
$hospital_cost = 0;
?>



<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height" style="z-index: 999">

      @if($beneficiary_details->is_cancelled == 1)
      <div id="background">
        <p id="bg-text">CANCELLED</p>
      </div>
      @endif

      <div class="heading tabs">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        Name : {{ $beneficiary_details->name_of_patient }} 

        <i class="fa fa-database" aria-hidden="true"></i>
        / URN :  {{ $beneficiary_details->urn }} 

        <i class="fa fa-info-circle" aria-hidden="true"></i>
        / INWARD NUMBER : {{ $beneficiary_details->inward_number }} 


        <ul class="nav nav-tabs pull-right" data-tabs="tabs" id="tabs">
          <li class="active">
            <a data-toggle="tab" href="#tab1"><i class="fa fa-comments"></i><span>Overview</span></a>
          </li>
          <li>
            <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>Cost Analysis</span></a>
          </li>
          <!--
          <li>
            <a data-toggle="tab" href="#tab3"><i class="fa fa-paper-clip"></i><span>Attachments</span></a>
          </li> -->
        </ul>
      </div>
      <div class="tab-content padded" id="my-tab-content">
        <div class="tab-pane active" id="tab1">
          <h3>
            Overview 
          </h3>
          <table class="table table-bordered table-hover table-striped">
            <thead>

              <tr>
                <th>Beneficiary Name </th>
                <td>{{ $beneficiary_details->name_of_patient }}</td>
              </tr>

              <tr>
                <th>Date Of Admission </th>
                <td>{{ date('d-m-Y', strtotime($beneficiary_details->date_of_admission)) }}</td>
              </tr>


              <tr>
                <th>Discharge Date </th>
                <td>
                  @if($beneficiary_details->discharge_date)
                  {{ date('d-m-Y', strtotime($beneficiary_details->discharge_date)) }}
                  @endif
                </td>
              </tr>

              <tr>
                <th>Package Name </th>
                <td>{!! Helper::getPackage($beneficiary_details->id)['name'] !!}</td>
              </tr>

              <tr>
                <th>Package Amount </th>
                <td>{!! Helper::getPackage($beneficiary_details->id)['amount'] !!}</td>
              </tr>

              <tr>
                <th>URN </th>
                <td>{{ $beneficiary_details->urn }}</td>
              </tr>

              <tr>
                <th>Inward Number/CCN Number </th>
                <td>{{ $beneficiary_details->inward_number }}</td>
              </tr>


              <tr>
                <th>Hospital Number </th>
                <td>{{ $beneficiary_details->hospital_number }}</td>
              </tr>

              <tr>
                <th>MRD Number </th>
                <td>{{ $beneficiary_details->mrd_number }}</td>
              </tr>
            </thead>

            @if($beneficiary_details->is_cancelled != 1)
            <tfoot>
              <tr>
                <td>
                  <a target="_blank" onclick="return confirm('Are you sure to cancel ?')" href="{{ route('beneficary_details.cancel.create', $beneficiary_details->id ) }}" class="btn btn-danger btn-lg"> <i class="fa fa-arrows-alt" aria-hidden="true"></i> CANCEL BENEFICIARY</a>
                </td>
              </tr>
            </tfoot>
            @else
             <tfoot>
              <tr>
                <td>
                  <button type="button" class="btn btn-danger btn-lg"> BENEFICIARY CANCELLED ON {{ date('d-m-Y', strtotime($beneficiary_details->cancellation_date)) }} BY {{ ucwords($beneficiary_details->cancelledBy->name ) }}</button>
                </td>
              </tr>
            </tfoot>
            @endif
          </table>
        </div>
        <div class="tab-pane" id="tab2">
          <h3>
            Cost Analysis
          </h3>

          
          <table class="table table-bordered table-hover table-striped">
            <thead>

              <tr>
                <th>Package Amount </th>
                <td>{!! Helper::getPackage($beneficiary_details->id)['amount'] !!}</td>
              </tr>

              <tr>
                <th>Test/Investigation Cost </th>
                <td>
                  <?php 

                    $investigation_cost = Helper::getInvestigationCost($beneficiary_details->id);

                    $hospital_cost += $investigation_cost;
                  ?>

                  {{ $investigation_cost }}

                </td>
              </tr>

              <tr>
                <th>Dialysis</th>
                <td> 
                    <?php 

                      $dialysis_cost = Helper::getDialysisCost($beneficiary_details->id);

                      $hospital_cost += $dialysis_cost;
                    ?>

                    {{ $dialysis_cost }}
                </td>
              </tr>

              <tr>
                <th>Blood Transfusion</th>
                <td> 
                  <?php 

                    $blood_transfusion_cost = Helper::getBloodTransfusionCost($beneficiary_details->id);

                    $hospital_cost += $blood_transfusion_cost;
                  ?>
                  {{ $blood_transfusion_cost }}</td>
              </tr>

              <tr>
                <th>Endorscopy</th>
                <td> 
                  <?php 

                      $endorscopy_cost = Helper::getEndorscopyCost($beneficiary_details->id);

                      $hospital_cost += $endorscopy_cost;
                    ?>

                  {{ $endorscopy_cost }}</td>
              </tr>

              <tr>
                <th>Bed Cost</th>
                <td> 
                  <?php 

                    $bed_cost = Helper::getBedCost($beneficiary_details->id);

                    $hospital_cost += $bed_cost;
                  ?>
                {{ $bed_cost}}</td>
              </tr>

              <tr>
                <th>ICU Cost</th>
                <td> 
                   <?php 

                    $icu_cost = Helper::getIcuCost($beneficiary_details->id);

                    $hospital_cost += $icu_cost;
                  ?>
                  {{ $icu_cost }}</td>
              </tr>
              
              <tr>
                <th>OT Cost</th>
                <td> 
                  <?php 

                    $ot_cost = Helper::getOTCost($beneficiary_details->id);

                    $hospital_cost += $ot_cost;
                  ?>
                {{ $ot_cost }}</td>
              </tr>


              <tr>
                <th>PET-CT</th>
                <td> 
                  <?php 

                    $pet_cet_cost = Helper::getPetCetCost($beneficiary_details->id);

                    $hospital_cost += $pet_cet_cost;
                  ?>
                  {{ $pet_cet_cost }}</td>
              </tr>

              <tr>
                <th>Vendor Reimbursement </th>
                  <?php 

                    $vendor_reimbursement_cost = Helper::getVendorReimbursementCost($beneficiary_details->id);

                    $hospital_cost += $vendor_reimbursement_cost;
                  ?>
                <td>{{ $vendor_reimbursement_cost }}</td>
              </tr>


              <tr>
                <th>
                  Beneficiary Reimbursement
                </th>

                <td>
                  <?php 

                    $beneficiary_reimbursement_cost = Helper::getBeneficiaryReimbursementCost($beneficiary_details->id);

                    $hospital_cost += $beneficiary_reimbursement_cost;
                  ?>

                    {{ $beneficiary_reimbursement_cost }}
                </td>
              </tr> 

              <tr>
                <th>Medicine Cost</th>
                <td>
                  <?php 

                    $medicine_cost = Helper::getMedicineCost($beneficiary_details->id);

                    $hospital_cost += $medicine_cost;
                  ?>

                    {{ $medicine_cost }}
                </td>
              </tr>
              

              <tr>
                <th>Medicine Return</th>
                <td>
                  <?php 

                    $medicine_return_cost = Helper::getMedicineReturnCost($beneficiary_details->id);

                    $hospital_cost = $hospital_cost - $medicine_return_cost;
                  ?>

                    {{ $medicine_return_cost }}
                </td>
              </tr>

              <tr>
                <th>TA</th>
                <td>
                  <?php 

                    $ta_cost = Helper::getTACost($beneficiary_details->id);

                    $hospital_cost += $ta_cost;
                  ?>
                  {{ $ta_cost }}</td>
              </tr>


              <tr>
                <th>SRL</th>
                <td>
                  <?php 

                    $srl_cost = Helper::getSRLCost($beneficiary_details->id);

                    $hospital_cost += $srl_cost;
                  ?>

                    {{ $srl_cost }}
                </td>
              </tr>

            </thead>
          </table>
          <hr>
          <table class="table table-bordered table-condensed">
            <tr class="success">
              <th style="text-align: right;">Package Amount</th>
              <td>{{ $beneficiary_details->package_amount }}</td>
            </tr>

            <tr class="warning">
              <th  style="text-align: right;">Hospital and Medicine Cost</th>
              <td>{{ Helper::moneyFormatIndia($hospital_cost) }}</td>
            </tr>

            <tr class="success">
              <th  style="text-align: right;">Medicine Return</th>
              <td>{{ Helper::moneyFormatIndia($medicine_return_cost) }}
            </tr>

            <tr>
              <td colspan="2" style="border-bottom: 2px solid #000"></td>
            </tr>

            <tr class="info">
              <td style="text-align: right;">
                @if( ($beneficiary_details->package_amount - $hospital_cost + $medicine_return_cost) >= 0 )
                  Surplus
                @else
                  Deficit
                @endif

              </td>
              <td> {{ $beneficiary_details->package_amount - $hospital_cost + $medicine_return_cost }} </td>
            </tr>

          </table>

          <div class="col-md-12 clearfix" style="height: 400px;">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
        <!-- 
        <div class="tab-pane" id="tab3">
          <h3>
            Attachments
          </h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque imperdiet auctor purus, non imperdiet sapien dapibus non. Phasellus pretium rutrum elit in cursus. Donec ullamcorper nec massa vel mattis. Curabitur eros metus, dapibus quis est et, dapibus imperdiet dolor.
          </p>
        </div> -->
      </div>
    </div>
  </div>
</div>

<?php 





$datapoints_arr = [];

$datapoints_arr[0]['y'] = $investigation_cost;
$datapoints_arr[0]['label'] = 'Investigation Cost';

$datapoints_arr[1]['y'] = $dialysis_cost;
$datapoints_arr[1]['label'] = 'Dialysis';

$datapoints_arr[2]['y'] = $blood_transfusion_cost;
$datapoints_arr[2]['label'] = 'Blood Transfusion';

$datapoints_arr[3]['y'] = $endorscopy_cost ;
$datapoints_arr[3]['label'] = 'Endorscopy';

$datapoints_arr[4]['y'] = $bed_cost;
$datapoints_arr[4]['label'] = 'Bed Cost';

$datapoints_arr[5]['y'] = $icu_cost ;
$datapoints_arr[5]['label'] = 'ICU Cost';

$datapoints_arr[6]['y'] = $ot_cost;
$datapoints_arr[6]['label'] = 'OT Cost';

$datapoints_arr[7]['y'] = $pet_cet_cost;
$datapoints_arr[7]['label'] = 'PET-CT';

$datapoints_arr[8]['y'] = $vendor_reimbursement_cost;
$datapoints_arr[8]['label'] = 'Vendor Reimbursement';

$datapoints_arr[9]['y'] = $beneficiary_reimbursement_cost;;
$datapoints_arr[9]['label'] = 'Beneficiary Reimbursement';

$datapoints_arr[10]['y'] = $medicine_cost;
$datapoints_arr[10]['label'] = 'Medicine Cost';

$datapoints_arr[11]['y'] = $ta_cost;
$datapoints_arr[11]['label'] = 'TA';

$datapoints_arr[12]['y'] = $srl_cost;
$datapoints_arr[12]['label'] = 'SRL';


$datapoints_json =  json_encode($datapoints_arr);
?>

@stop

@section('pageJs')
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function() {

var options = {
  title: {
    text: "Cost Analysis - Pie"
  },
  data: [{
      type: "pie",
      startAngle: 45,
      showInLegend: "true",
      legendText: "{label}",
      indexLabel: "{label} ({y})",
      yValueFormatString:"#,##0.#"%"",
      dataPoints: {!! $datapoints_json !!}
  }]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
@stop