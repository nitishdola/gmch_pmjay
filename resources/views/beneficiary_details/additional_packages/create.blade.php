@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiary Additional Package Add
            </div>
            <div class="widget-content padded clearfix">
              
               <div class="widget-content padded">
                  {!! Form::open(array('route' => 'beneficary_details.additional_package.save', 'id' => 'beneficary_details.additional_package.save')) !!}
                     <fieldset>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for="lastname">Date of Admission</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('pmjay_package_id') ? 'has-error' : ''}}">
                                {!! Form::select('package_id', $pmjay_packages, null, ['class' => 'select2able col-md-12', 'id' => 'pmjay_package_id', 'placeholder' => 'Select Package', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                  {!! $errors->first('pmjay_package_id', '<span class="help-inline">:message</span>') !!}
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('package_amount') ? 'has-error' : ''}}">
                                 <label for="amount">Amount*</label><input class="form-control" required="true" id="package_amount" name="package_amount" type="text">

                                 {!! $errors->first('package_amount', '<span class="help-inline">:message</span>') !!}
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                                 <label for="date">Date*</label><input class="form-control zdatepicker" id="date" name="date" required="true" type="text">

                                 {!! $errors->first('date', '<span class="help-inline">:message</span>') !!}

                              </div>
                            </div>
                          </div>
                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fa fa-download" aria-hidden="true"></i> SUBMIT </button>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop

@section('pageJs')
<script>
$('#beneficiary_detail_id').change(function() {
//$('#beneficiary_detail_id').bind("keyup change", function(e) {
  $beneficiary_detail_id = $(this).val();
  
  if($beneficiary_detail_id != '') {
    $.blockUI();
    url = data = '';

    url   = "{{ route('api.beneficiary_details') }}";
    data  = "&beneficiary_id="+$beneficiary_detail_id;

    $.ajax({
      data : data,
      url  : url,

      error : function(resp) {
        $.unblockUI();
        alert('Oops !');
      },

      success : function(resp) {

        $.unblockUI();
        $('#name_of_patient').val(resp.name_of_patient);
        $('#date_of_admission').val(resp.date_of_admission);
      }
    });

  }else{
    $.unblockUI();
    $('#name_of_patient').val('');
    $('#date_of_admission').val('');
  }
});

$('#pmjay_package_id').bind("keyup change", function(e) {
  $package_id = $(this).val();
  
  if($package_id != '') {
    $.blockUI();
    url = data = '';

    url   = "{{ route('api.pmjay.package_details') }}";
    data  = "&package_id="+$package_id;

    $.ajax({
      data : data,
      url  : url,

      error : function(resp) {
        $.unblockUI();
        alert('Oops !');
      },

      success : function(resp) {
        $.unblockUI();
        $('#package_amount').val(resp.non_nabh_package_amount);
      }
    });

  }else{
    $.unblockUI();
    $('#package_amount').val('');
  }
});
</script>
@stop