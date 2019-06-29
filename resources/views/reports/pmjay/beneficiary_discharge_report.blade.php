@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-lg-12">

    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading">
            <i class="fa fa-table"></i>PMJAY Beneficiaries not discharge for more than 45 Days
          </div>
          <div class="widget-content padded clearfix">

            @if(count($results))
            <div class="table-responsive">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Inward Number</th>
                  <th>Date of Admission</th>
                  <th>MRD number</th>
                  <th>Details</th>
                </tr>
              </thead>

              <tbody>
                <?php $count = 1; ?>
                @foreach($not_discharged_beneficiaries as $k => $v)
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $v['name_of_patient'] }}</td>
                    <td>{{ $v['inward_number'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($v['date_of_admission'])) }}</td> 
                    <td>{{ $v['mrd_number'] }}</td>
                    <td><a target="_blank" href="{{ route('beneficary_details.view_beneficiary', $v['id']) }}" class="btn btn-sm btn-primary"> <i class="fa fa-info" aria-hidden="true"></i> View Details</a>
                    </td>
                    <?php $count++ ; ?>
                @endforeach
              </tbody>
            </div>

            @else
              <div class="alert alert-warning">
                <h2>No Results Found</h2>
              </div>
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
