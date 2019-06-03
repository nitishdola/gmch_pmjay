@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiaries /  Add Investigations
            </div>
            <div class="widget-content padded clearfix">
              <p class="black-text" id="remb"> Remaining Balance :
                <span id="remaining_balance">0</span>
              </p>

              <div class="alert alert-danger" id="alert" style="display: none;">
                Remaining amount crossed 50% of package amount !
              </div>
               <div class="widget-content padded">

                    {!! Form::open(array('route' => 'beneficary_details.investigation.save', 'id' => 'beneficary_details.investigation.save')) !!}
                     <fieldset>
                        <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('lab_test_id') ? 'has-error' : ''}}">
                              {!! Form::label('lab_test*', '', array('class' => '')) !!}
                                  {!! Form::select('lab_test_id', $all_tests, null, ['class' => 'select2able', 'id' => 'lab_test_id', 'placeholder' => 'Select Test', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('lab_test_id', '<span class="help-inline">:message</span>') !!}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group  {{ $errors->has('name_of_patient') ? 'has-error' : ''}}">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>
                              </div>
                              <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                                 <label for="amount">Amount</label><input class="form-control" id="amount" name="amount" type="text">
                              </div>
                           </div>

                            <div class="col-md-4">

                              

                              <div class="form-group">
                                 <label for="lastname">Date of Admission</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
                              </div>
                              <div class="form-group {{ $errors->has('test_date') ? 'has-error' : ''}}">
                                 <label for="test_date">Test Date</label><input class="form-control zdatepicker" id="test_date" name="test_date" required="true" type="text">
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



$('#lab_test_id').change(function() {
  $lab_test_id = $(this).val();

  if($lab_test_id != '') {
    $.blockUI();
    url = data = '';

    url   = "{{ route('api.test_details') }}";
    data  = "&lab_test_id="+$lab_test_id;

    $.ajax({
      data : data,
      url  : url,

      error : function(resp) {
        $.unblockUI();
        alert('Oops !');
      },

      success : function(resp) {
        $.unblockUI();
        $('#amount').val(resp.rate);
      }
    });

  }else{
    $('#amount').val('');
  }
});

$('#amount').keyup(function() {
  $amount = $(this).val();
  
  $beneficiary_details_id = $('#beneficiary_detail_id').val();

  if($beneficiary_details_id != '') {
    data = url = '';

    url += "{{ route('api.pmjay.get_balance') }}";
    data += '&beneficiary_details_id='+$beneficiary_details_id+'&amount='+$amount;

    //console.log(url+data);

    $.ajax({
      data : data,
      url : url,
      type : 'GET',
      dataType : 'JSON',

      error : function(resp) {
        //console.log(resp);
        alert('Please try again');
      },

      success  : function(resp) {
        //console.log(resp);
        $package_amount = resp.package_amount;
        $total_cost     = resp.total_cost;
        $remaining_balance     = resp.remaining_balance;

        $perc = ($total_cost/$package_amount)*100;
        if($perc > 50) {
          $('#alert').fadeIn('slow');
        }else{
          $('#alert').hide();
        }
        if($perc > 70) {
          $('#remb').removeClass('black-text');
          $('#remb').addClass('red-text');
        }else{
          $('#remb').addClass('black-text');
          $('#remb').removeClass('red-text');
        }

        $('#remaining_balance').text(resp.remaining_balance);
      }
    });
  }else{
    alert('select beneficiary !');
  }

});
</script>
@stop