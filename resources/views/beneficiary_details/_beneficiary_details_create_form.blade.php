<div class="form-group">
  <label class="control-label col-md-2">Register Serial Name</label>
  <div class="col-md-3">
    <input class="form-control" placeholder="Register Serial Name" name="register_sl_no" type="text">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Patient Name</label>
  <div class="col-md-3">
    <input class="form-control" placeholder="Patient Name" name="name_of_patient" type="text">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">URN</label>
  <div class="col-md-3">
    <input class="form-control" placeholder="URN Number" name="urn" type="text">
  </div>
</div> 

<div class="form-group">
  <label class="control-label col-md-2">Date of Admission</label>
  <div class="col-md-3">
    <input class="form-control zdatepicker" placeholder="Date of Admission" name="date_of_admission" type="text">
  </div>
</div>  

<div class="form-group">
  <label class="control-label col-md-2">Inward Number</label>
  <div class="col-md-3">
    <input class="form-control" style="text-transform: uppercase" placeholder="Inward Number" name="inward_number" type="text">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">Hospital Number</label>
  <div class="col-md-3">
    <input class="form-control" placeholder="Hospital Number" name="hospital_number" type="text">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-2">MRD Number</label>
  <div class="col-md-3">
    <input class="form-control" placeholder="MRD Number" name="mrd_number" type="text">
  </div>
</div>

<div class="form-group {{ $errors->has('package_id') ? 'has-error' : ''}}">
  {!! Form::label('select_package*', '', array('class' => 'control-label col-md-2')) !!}
    <div class="col-md-3">
      {!! Form::select('package_id', $pmjay_packages, null, ['class' => 'select2able', 'id' => 'package_id', 'placeholder' => 'Select Package', 'autocomplete' => 'off', 'required' => 'true']) !!}
    </div>
  {!! $errors->first('package_id', '<span class="help-inline">:message</span>') !!}
</div>



  <div class="form-group">
    <label class="control-label col-md-2">Package Amount</label>
    <div class="col-md-3">
      <input class="form-control" name="package_amount" id="package_amount" placeholder="Package Amount" type="text">
    </div>
  </div>