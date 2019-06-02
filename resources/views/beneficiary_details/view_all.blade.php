@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-lg-12">

    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading">
            <i class="fa fa-table"></i>PMJAY Beneficiaries
          </div>
          <div class="widget-content padded clearfix">

            <div class="widget-content padded">
                    <form action="" id="validate-form" method="get">
                      <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="firstname">Inward Number</label><input class="form-control" id="inward_number" name="inward_number" type="text">
                            </div>

                            <div class="form-group">
                              <label for="lastname">Date From</label><input class="form-control zdatepicker" id="lastname" name="date_from" type="text">
                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text">
                            </div>

                            <div class="form-group">
                              <label for="email">Date To</label><input class="form-control zdatepicker" id="email" name="date_to" type="text">
                            </div>
                          </div>

                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search </button>

                      </fieldset>
                    </form>
                  </div>

            <div class="table-responsive">
              <?php  $count = 1; ?>
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Inward Number</th>
                  <th>Date of Admission</th>
                  <th>Package Amount</th>
                  <th>Total Expenditure</th>
                  <th>Remaining Balance</th>
                  <th>Claims Received</th>
                  <th>Deducted by SHA</th>
                  <th>Details</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                  $package_amount = 0;
                  $total_expenditure = 0;
                  $remaining_balance = 0;
                  $total_cliams_received = 0;
                  $total_deducted_by_sha = 0;
                ?>
                @foreach($beneficiary_details as $k => $v)
                  <tr @if($v->is_cancelled == 1) class="alert alert-danger" @endif >
                    <td>{{ (($beneficiary_details->currentPage() - 1 ) * $beneficiary_details->perPage() ) + $count + $k }}</td>
                    <td id="name_{{ $v->id }}">{{ $v->name_of_patient }}</td>
                    <td id="inward_{{$v->id}}">{{ $v->inward_number }}</td>
                    <td>{{ date('d-m-Y', strtotime($v->date_of_admission)) }}</td> 
                    <td>{{ $v->package_amount }}</td>
                    <td>{{ $v->total_expenditure }}</td>
                    <td>{{ number_format((float) ($v->package_amount - $v->total_expenditure), 2, '.', '')   }}</td>
                    <td id="cliams_received_{{$v->id}}">{{ $v->cliams_received }}
                        
                    </td>
                    <td id="deducted_by_sha_{{$v->id}}">{{ $v->deducted_by_sha }}</td>
                    <td><a href="{{ route('beneficary_details.view_beneficiary', $v->id) }}" class="btn btn-sm btn-primary"> <i class="fa fa-info" aria-hidden="true"></i> View Details</a>
                      <br>
                      @if($v->cliams_received <= 0)
                          <a href="javascript:void(0)" id="add_claims_info_{{$v->id}}" class="btn btn-danger btn-sm" 
                            onClick="showMyModal({{ $v->id }})">
                            <i class="fa fa-money" aria-hidden="true"></i> Add Claims Info 
                          </a>
                        @endif
                    </td>

                    <?php 
                      $package_amount += $v->package_amount;
                      $total_expenditure += $v->total_expenditure;
                      $remaining_balance += $v->package_amount - $v->total_expenditure;
                      $total_cliams_received += $v->cliams_received;
                      $total_deducted_by_sha += $v->deducted_by_sha;
                    ?>

                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <th colspan="4">
                    Total
                  </th>

                  <th> {{ number_format((float) ($package_amount), 2, '.', '') }}</th>
                  <th> {{ number_format((float) ($total_expenditure), 2, '.', '') }}</th>
                  <th> {{ number_format((float) ($total_expenditure), 2, '.', '') }}</th>
                  <th> {{ number_format((float) ($total_cliams_received), 2, '.', '') }}</th>
                  <th> {{ number_format((float) ($total_deducted_by_sha), 2, '.', '') }}</th>
              </tfoot>
            </table>

            {{ $beneficiary_details->appends($_GET)->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Claims Receive Info : <br>
          Name - <span id="nm"></span> , Inward Number - <span id="inw"></span></h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
            <div class="col-md-12">

              <div class="form-group {{ $errors->has('cliams_received') ? 'has-error' : ''}}">
              {!! Form::label('cliams_received*', '', array('class' => '')) !!}
              {!! Form::number('cliams_received', null, ['class' => 'form-control', 'id' => 'cliams_received', 'placeholder' => 'Claims Received Amount', 'autocomplete' => 'off', 'required' => 'true']) !!}
              {!! $errors->first('cliams_received', '<span class="help-inline">:message</span>') !!}
              </div>

              <div class="form-group {{ $errors->has('deducted_by_sha') ? 'has-error' : ''}}">
              {!! Form::label('deducted_by_sha*', '', array('class' => '')) !!}
              {!! Form::number('deducted_by_sha', null, ['class' => 'form-control', 'id' => 'deducted_by_sha', 'placeholder' => 'Deduction', 'autocomplete' => 'off']) !!}
              {!! $errors->first('deducted_by_sha', '<span class="help-inline">:message</span>') !!}
              </div>
              <input type="hidden" id="beneficiary_details_id">
              <div>
                <button type="button" class="btn btn-success" onclick="saveClaims()"> SUBMIT </button>
              </div>

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  @stop

  @section('pageJs')
  <script>
    showMyModal = function(beneficiary_details_id) {

      $('#cliams_received').val('');
      $('#deducted_by_sha').val('');

      $name = $('#name_'+beneficiary_details_id).text();
      $('#nm').text($name);
      $inward = $('#inward_'+beneficiary_details_id).text();

      $('#beneficiary_details_id').val(beneficiary_details_id);

      $('#inw').text($inward);
      $('#myModal').modal('show');
    } 

    saveClaims = function() {
      beneficiary_details_id = $('#beneficiary_details_id').val(); console.log(beneficiary_details_id);
      $cliams_received = $('#cliams_received').val();
      $deducted_by_sha = $('#deducted_by_sha').val();
      if($cliams_received == '') {
        alert('Claims receive is empty !');
        return false;
      }

      if($deducted_by_sha == '') {
        alert('Deduction is empty !');
        return false;
      }

      data = url = '';

      data += '&cliams_received='+$cliams_received+'&deducted_by_sha='+$deducted_by_sha+'&beneficiary_details_id='+beneficiary_details_id;

      url += "{{ route('rest.add_claims_info') }}";

      $.ajax({
        data : data,
        url  : url,
        type : 'GET',

        error : function(resp) {
          $('#myModal').modal('hide');
          alert('Error ! Try again');
        },

        success : function(resp) {
          $('#myModal').modal('hide');
          $('#add_claims_info_'+beneficiary_details_id).hide();
          $('#cliams_received_'+beneficiary_details_id).text($cliams_received);
          $('#deducted_by_sha_'+beneficiary_details_id).text($deducted_by_sha);
        }
      });


    }
  </script>
  @stop