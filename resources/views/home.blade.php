@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div style="background: #FFF; padding: 10px; text-align: center; font-weight: bold;">
            <h3>
                <div class="heading">
                    <i class="fa fa-table"></i> PMJAY Data
                </div>
            </h3>
        </div>
        <div class="widget-container stats-container">

            

            <div class="col-md-4">
                <div class="number">
                    {{ $pmjay_patients }}<small></small>
                </div>
                <div class="text">
                    Patients
                </div>
            </div>
            <div class="col-md-4">
                <div class="number">
                    {{ Helper::moneyFormatIndia($pmjay_package_amount + Helper::getAdditionalPackageInfo() ) }}
                </div>
                <div class="text">
                    Total Package Amount
                </div>
            </div>
            <div class="col-md-4">
                <div class="number">
                    {{ Helper::moneyFormatIndia( 
                            Helper::getInvestigationCost() + 
                            Helper::getDialysisCost() +
                            Helper::getBloodTransfusionCost() +
                            Helper::getEndorscopyCost() +
                            Helper::getIcuCost() +
                            Helper::getOTCost() +
                            Helper::getPetCetCost() +
                            Helper::getVendorReimbursementCost() +
                            Helper::getBeneficiaryReimbursementCost() +
                            Helper::getMedicineCost() -
                            Helper::getMedicineReturnCost() +
                            Helper::getTACost() +
                            Helper::getSRLCost()
                        ) 
                    }}
                </div>
                <div class="text">
                    Hospital Cost
                </div>
            </div>
        </div>


        <div class="widget-container stats-container">

            

            <div class="col-md-4">
                <div class="number">
                    <img src="{{ asset('loader.gif') }}" style="display: none;" id="patientCountLoader" />
                        <a href="{{ route('beneficary_details.view_all', 
                                [
                                    'date_from' => date('Y-m-d'),
                                    'date_to' => date('Y-m-d'),
                                ]) }}">
                            <span id="patientCount"></span>
                        </a>
                    <small></small>
                </div>
                <div class="text">
                    Patient admitted on {{ date('d-m-Y') }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="number">
                    <img src="{{ asset('loader.gif') }}" style="display: none;" id="claimsReceivedInfoLoader" />
                    <span id="claimsReceivedInfo"></span><small>( <span id="claimsReceivedInfoCount"></span> )</small>
                </div>
                <div class="text">
                    Claims Received 
                </div>
            </div>
            <div class="col-md-4">
                <div class="number">
                    <img src="{{ asset('loader.gif') }}" style="display: none;" id="claimsPendingInfoLoader" />
                    <span id="claimsPendingInfo"></span><small>( <span id="claimsPendingInfoCount"></span> )</small>
                </div>
                <div class="text">
                    Claims Pending(After Discharge) 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('pageCss')
<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style>
	.widget-container { font-family: 'Ubuntu', sans-serif !important; }
</style>
@stop

@section('pageJs')
<script>
    data = url = '';

    url += "{{ route('rest.getPatientCount') }}";

    $('#patientCountLoader').show();
    $.ajax({
        data : data,
        type : 'GET',
        url  : url,

        error : function(resp) {
            alert('Oops ! Something went wrong');
        },
        success : function(resp) {
            console.log(url);
            console.log(resp);
            $('#patientCountLoader').hide();
            $('#patientCount').text(resp);
        }
    });


    data = url = '';

    url += "{{ route('rest.claims_received_data') }}";

    $('#claimsReceivedInfoLoader').show();
    $.ajax({
        data : data,
        type : 'GET',
        url  : url,
        dataType : 'JSON',

        success : function(resp2) {
            $('#claimsReceivedInfoLoader').hide();
            $('#claimsReceivedInfo').text(resp2.amount);
            $('#claimsReceivedInfoCount').text(resp2.count);
        }
    });


    data = url = '';

    url += "{{ route('rest.claims_pending_data') }}";

    $('#claimsPendingInfoLoader').show();
    $.ajax({
        data : data,
        type : 'GET',
        url  : url,
        dataType : 'JSON',

        success : function(resp3) {
            $('#claimsPendingInfoLoader').hide();
            $('#claimsPendingInfo').text(resp3.amount);
            $('#claimsPendingInfoCount').text(resp3.count);
        }
    });
</script>
@stop