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
                    <td>{{ $v->name_of_patient }}</td>
                    <td>{{ $v->inward_number }}</td>
                    <td>{{ date('d-m-Y', strtotime($v->date_of_admission)) }}</td> 
                    <td>{{ $v->package_amount }}</td>
                    <td>{{ $v->total_expenditure }}</td>
                    <td>{{ number_format((float) ($v->package_amount - $v->total_expenditure), 2, '.', '')   }}</td>
                    <td>{{ $v->cliams_received }}</td>
                    <td>{{ $v->deducted_by_sha }}</td>
                    <td><a href="{{ route('beneficary_details.view_beneficiary', $v->id) }}" class="btn btn-sm btn-primary"> <i class="fa fa-info" aria-hidden="true"></i> View Details</a></td>

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
  @stop