@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-lg-12">

    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading">
            <i class="fa fa-table"></i>Honorarium List
          </div>
          <div class="widget-content padded clearfix">
            <div class="table-responsive">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Beneficiary</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                @foreach($results as $k => $v)
                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>
                      {{ $v->beneficiaryDetail->name_of_patient }} <br> 
                      <a target="_blank" href="{{ route('beneficary_details.view_beneficiary', $v->beneficiaryDetail->id) }}"> {{ $v->beneficiaryDetail->inward_number }}</a></td>
                    <td>{{ $v->amount }}</td>
                    <td>{{ date('d-m-Y', strtotime($v->pay_date)) }}</td> 
                    <td>{{ $v->remarks }}
                    </td>
                @endforeach
              </tbody>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
