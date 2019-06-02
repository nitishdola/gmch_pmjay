@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">PMJAY</div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>URN</th>
                  <th>Inward Number</th>
                  <th>Date of Admission</th>
                  <th>Package Amount</th>
                  <th>Total Expenditure</th>
                  <th>Claims Received</th>
                  <th>Deducted by SHA</th>
                  <th>Details</th>
                </tr>
              </thead>

              <tbody>
                @foreach($beneficiary_details as $k => $v)
                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $v->name_of_patient }}</td>
                    <td>{{ $v->urn }}</td>
                    <td>{{ $v->inward_number }}</td>
                    <td>{{ $v->date_of_admission }}</td> 
                    <td>{{ $v->package_amount }}</td>
                    <td>{{ $v->total_expenditure }}</td>
                    <td>{{ $v->cliams_received }}</td>
                    <td>{{ $v->deducted_by_sha }}</td>
                    <td><a href="" class="btn btn-sm btn-primary"> View Details</a></td>
                @endforeach
              </tbody>
            </table>

            <!-- /.row-->
            <hr class="mt-0">
            
            
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->
        <br>
        
      </div>
    </div>
  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection
