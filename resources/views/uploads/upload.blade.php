@extends('layouts.default')

@section('content')
<div class="row">
<div class="col-sm-6">
<div class="card">
<div class="card-header">
<strong>Lab Dept</strong>
<small>Form</small>
</div>
<div class="card-body">
{{ dump( $errors ) }}
<form method="POST" action="{{ route('savedata') }}" enctype="multipart/form-data">
               @csrf 
<div class="row" id="abId0.28427717104501005">
<div class="col-sm-12" id="abId0.23036952856708393">
<div class="form-group" id="abId0.6970057566816701">
<label for="name">Upload</label>
<input class="form-control" name="lat_dept_data" type="file" required=true>
</div>

<div class="form-group" id="abId0.6970057566816701">
<label for="name"></label>
<button class="btn btn-success">SUBMIT</button>
</div>


</div>
</div>
</form>



</div>
</div>
</div>


@endsection
