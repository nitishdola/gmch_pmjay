@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-lg-12">

    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading">
            <i class="fa fa-table"></i>PMJAY SRL Report
          </div>
          <div class="widget-content padded clearfix">
            @if(count($results))
            <div class="table-responsive">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Test Name</th>
                  <th>Test Date</th>
                  <th>Beneficiary</th>
                  <th>Amount</th>
                  <th>Added By</th>
                </tr>
              </thead>
              <?php $total = 0; ?>
              <tbody>
                @foreach($results as $k => $v)
                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $v->test_name }}</td>
                    <td>{{ date('d-m-Y', strtotime($v->test_date)) }}</td> 
                    <td>{{ $v->beneficiaryDetail->name_of_patient }}
                      <br>Inward Number : {{ $v->beneficiaryDetail->inward_number }}
                    </td>
                    <td>{{ $v->amount }}</td>
                    <td>{{ $v->addedBy->name }}</td>

                    <?php $total += $v->amount; ?>
                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <th colspan="5"> Total</th>
                  <th>{{ number_format((float)$total, 2, '.', '') }}</th>
                </tr>
              </tfoot>
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
