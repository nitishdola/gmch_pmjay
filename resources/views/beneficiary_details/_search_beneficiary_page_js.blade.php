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


//$('#amount').keyup(function() {
$('#amount').bind("keyup change", function(e) {
  $amount = $(this).val();
  
  $beneficiary_details_id = $('#beneficiary_detail_id').val();

  if($amount != '') {
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
  }else{
    $('#alert').hide();
  }

});

$('#blood_transfusion_id').change(function() {
  $blood_transfusion_id = $(this).val();

  if($blood_transfusion_id != '') {
    $.blockUI();

    url = data = '';

    data  += "&blood_transfusion_id="+$blood_transfusion_id;
    url   += "{{ route('rest.get_blood_transfusion_info') }}";

    $.ajax({
      url : url,
      data : data,
      type : 'get',

      error : function(resp) {
        $.unblockUI();
        alert('Something went wrong !');
      },

      success : function(resp) {
        $.unblockUI();
        //console.log(resp);
        $('#amount').val(resp.rate);
      }
    });
  }else{
    $('#amount').val('');
  }
});
</script>
@stop