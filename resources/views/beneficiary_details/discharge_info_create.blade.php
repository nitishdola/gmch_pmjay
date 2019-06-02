@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiary Discharge Info
            </div>
            <div class="widget-content padded clearfix">
               <div class="widget-content padded">
                 {!! Form::open(array('route' => 'beneficary_details.discharge_info.save', 'class' => 'form-horizontal')) !!}
                    
                     <fieldset>
                        <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('beneficiary_ta_cost') ? 'has-error' : ''}}">
                              {!! Form::label('TA*', '', array('class' => '')) !!}
                                  {!! Form::number('beneficiary_ta_cost', null, ['class' => 'form-control', 'step' => '0.01', 'id' => 'beneficiary_ta_cost', 'required' => true, 'placeholder' => 'Beneficiary TA Amount', 'autocomplete' => 'off']) !!}
                                {!! $errors->first('beneficiary_ta_cost', '<span class="help-inline">:message</span>') !!}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>
                              </div>


                              <div class="form-group">
                                 <label for="test_date">Discharge Date*</label><input class="form-control zdatepicker" id="discharge_date" name="discharge_date" required="true" type="text">
                              </div>

                           </div>

                            <div class="col-md-4">

                              <div class="form-group">
                                 <label for="lastname">Date of Admission</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
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
        $('#discharge_date').val(resp.discharge_date);
        $('#beneficiary_ta_cost').val(resp.beneficiary_ta_cost);
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