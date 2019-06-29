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
                    {{ Helper::moneyFormatIndia($pmjay_package_amount) }}
                </div>
                <div class="text">
                    Total Package Amount
                </div>
            </div>
            <div class="col-md-4">
                <div class="number">
                    {{ Helper::moneyFormatIndia( $pmjay_hospital_cost) }}
                </div>
                <div class="text">
                    Hospital Cost
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="number">
                    {{ $pmjay_amrit_cost }}
                </div>
                <div class="text">
                    Pharmacy Bill
                </div>
            </div> -->
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
                    {{ Helper::moneyFormatIndia($pmjay_package_amount) }}
                </div>
                <div class="text">
                    Total Package Amount
                </div>
            </div>
            <div class="col-md-4">
                <div class="number">
                    {{ Helper::moneyFormatIndia( $pmjay_hospital_cost) }}
                </div>
                <div class="text">
                    Hospital Cost
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="number">
                    {{ $pmjay_amrit_cost }}
                </div>
                <div class="text">
                    Pharmacy Bill
                </div>
            </div> -->
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