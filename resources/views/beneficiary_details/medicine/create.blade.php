@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiaries Medicine Bill Add
            </div>
            <div class="widget-content padded clearfix">
               <div class="widget-content padded">
                  {!! Form::open(array('route' => 'beneficary_details.medicine.save', 'id' => 'beneficary_details.medicine.save')) !!}
                     <fieldset>
                        <div class="row">
                            <?php 
                              $medical_types['Amrit Pharmacy'] = 'Amrit Pharmacy';
                              $medical_types['Others'] = 'Others';
                            ?>
                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('medical_type') ? 'has-error' : ''}}">
                              {!! Form::label('medical_type', '', array('class' => '')) !!}
                                  {!! Form::select('medical_type', $medical_types, null, ['class' => 'form-control', 'id' => 'medical_type', 'placeholder' => 'Select Medical type']) !!}
                                {!! $errors->first('medical_type', '<span class="help-inline">:message</span>') !!}
                              </div>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('invoice_number') ? 'has-error' : ''}}">
                              {!! Form::label('invoice_number', '', array('class' => '')) !!}
                                  {!! Form::text('invoice_number', null, ['class' => 'form-control', 'id' => 'invoice_number', 'placeholder' => 'Invoice Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('invoice_number', '<span class="help-inline">:message</span>') !!}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>
                              </div>
                              <div class="form-group">
                                 <label for="amount">Bill Amount*</label><input class="form-control" required="true" id="amount" name="amount" type="text">
                              </div>
                           </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for="lastname">Date of Admission</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
                              </div>
                              <div class="form-group">
                                 <label for="bill_date">Bill Date*</label><input class="form-control zdatepicker" id="bill_date" name="bill_date" required="true" type="text">
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

</script>
@stop