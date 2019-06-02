@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>Add New Beneficiary(MMCH)
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal">
          @include('beneficiary_details._beneficiary_details_create_form')
          <input type="hidden" name="hospital_type" value="MMCH">
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">Submit</button>
              <a class="btn btn-default-outline" href="{{ route('home') }}">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop

@include('beneficiary_details.beneficiary_details_create_js')