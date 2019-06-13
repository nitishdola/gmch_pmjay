@section('pageJs')
<script>
$('#package_id').bind("keyup change", function(e) {
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