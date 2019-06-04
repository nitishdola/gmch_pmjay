@extends('layouts.default')

@section('pageCss')
<style>
  .funkyradio div {
  clear: both;
  overflow: hidden;
}

.funkyradio label {
  width: 100%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

.funkyradio input[type="radio"]:empty,
.funkyradio input[type="checkbox"]:empty {
  display: none;
}

.funkyradio input[type="radio"]:empty ~ label,
.funkyradio input[type="checkbox"]:empty ~ label {
  position: relative;
  line-height: 2.5em;
  text-indent: 3.25em;
  margin-top: 2em;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.funkyradio input[type="radio"]:empty ~ label:before,
.funkyradio input[type="checkbox"]:empty ~ label:before {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  content: '';
  width: 2.5em;
  background: #D1D3D4;
  border-radius: 3px 0 0 3px;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
  color: #888;
}

.funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #C2C2C2;
}

.funkyradio input[type="radio"]:checked ~ label,
.funkyradio input[type="checkbox"]:checked ~ label {
  color: #777;
}

.funkyradio input[type="radio"]:checked ~ label:before,
.funkyradio input[type="checkbox"]:checked ~ label:before {
  content: '\2714';
  text-indent: .9em;
  color: #333;
  background-color: #ccc;
}

.funkyradio input[type="radio"]:focus ~ label:before,
.funkyradio input[type="checkbox"]:focus ~ label:before {
  box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="radio"]:checked ~ label:before,
.funkyradio-default input[type="checkbox"]:checked ~ label:before {
  color: #333;
  background-color: #ccc;
}

.funkyradio-primary input[type="radio"]:checked ~ label:before,
.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #337ab7;
}

.funkyradio-success input[type="radio"]:checked ~ label:before,
.funkyradio-success input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5cb85c;
}

.funkyradio-danger input[type="radio"]:checked ~ label:before,
.funkyradio-danger input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #d9534f;
}

.funkyradio-warning input[type="radio"]:checked ~ label:before,
.funkyradio-warning input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #f0ad4e;
}

.funkyradio-info input[type="radio"]:checked ~ label:before,
.funkyradio-info input[type="checkbox"]:checked ~ label:before {
  color: #fff;
  background-color: #5bc0de;
}
</style>
@stop

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="widget-content padded clearfix">
              
               <div class="widget-content padded">
                  <h3 class="alert alert-danger"> Cancelling {{ $beneficiary_details->name_of_patient }} , Inward Number : {{ $beneficiary_details->inward_number }} 
                  </h3>

                    {!! Form::open(array('route' => 'beneficary_details.cancel.save', 'id' => 'beneficary_details.cancel.save')) !!}
                    <input type="hidden" name="beneficiary_details_id" value="{{ Crypt::encrypt($beneficiary_details->id) }}">
                     <fieldset>
                        
                        <div class="funkyradio">
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="investigation" id="checkbox1" checked/>
                              <label for="checkbox1">Disable Investigation</label>
                          </div>
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="medicine_bill" id="checkbox2" checked/>
                              <label for="checkbox2">Disable Medicine Bill</label>
                          </div>
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="medicine_return" id="checkbox3" checked/>
                              <label for="checkbox3">Disable Medicine Return Bill</label>
                          </div>
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="srl" id="checkbox4" checked/>
                              <label for="checkbox4">Disable SRL Bill</label>
                          </div>
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="vendor_payment" id="checkbox5" checked/>
                              <label for="checkbox5">Disable Vendor Payment</label>
                          </div>
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="beneficary_payment" id="checkbox6" checked/>
                              <label for="checkbox6">Disable Beneficiary Reimbursement</label>
                          </div>
                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="blood_transfusion" id="checkbox7" checked/>
                              <label for="checkbox7">Disable Blood Transfusion</label>
                          </div>

                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="ot" id="checkbox8" checked/>
                              <label for="checkbox8">Disable OT</label>
                          </div>

                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="icu" id="checkbox9" checked/>
                              <label for="checkbox9">Disable ICU</label>
                          </div>

                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="bed_charge" id="checkbox10" checked/>
                              <label for="checkbox10">Disable Bed Charge</label>
                          </div>

                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="dialysis" id="checkbox11" checked/>
                              <label for="checkbox11">Disable Dialysis</label>
                          </div>

                          <div class="funkyradio-danger">
                              <input type="checkbox" name="disable_lists[]" value="pet_ct" id="checkbox12" checked/>
                              <label for="checkbox12">Disable PET-CT</label>
                          </div>
                      </div>

                        <button class="btn btn-primary" type="submit"><i class="fa fa-download" aria-hidden="true"></i> SUBMIT </button>
                     </fieldset>
                    {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
