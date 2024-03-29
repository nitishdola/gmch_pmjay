@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiaries Blood Transfusion
            </div>
            <div class="widget-content padded clearfix">
                <p class="black-text" id="remb"> Remaining Balance :
                <span id="remaining_balance">0</span>
              </p>

              <div class="alert alert-danger" id="alert" style="display: none;">
                Remaining amount crossed 50% of package amount !
              </div>
              
               <div class="widget-content padded">
                  {!! Form::open(array('route' => 'beneficary_details.blood_transfusions.save', 'id' => 'beneficary_details.blood_transfusions.save')) !!}
                     <fieldset>
                        <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('blood_transfusion_id') ? 'has-error' : ''}}">
                              {!! Form::label('Name_of_Blood_Transfusion*', '', array('class' => '')) !!}
                                  {!! Form::select('blood_transfusion_id', $blood_transfusions, null, ['class' => 'form-control', 'id' => 'blood_transfusion_id', 'placeholder' => 'Select', 'autocomplete' => 'off']) !!}
                                {!! $errors->first('blood_transfusion_id', '<span class="help-inline">:message</span>') !!}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>
                              </div>
                              <div class="form-group">
                                 <label for="amount">Blood Transfusion Charges*</label><input class="form-control" required="true" id="amount" name="amount" type="text" readonly="true">
                              </div>
                           </div>

                            <div class="col-md-4">

                              

                              <div class="form-group">
                                 <label for="lastname">Date of Admission</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
                              </div>
                              <div class="form-group">
                                 <label for="test_date">Date*</label><input class="form-control zdatepicker" id="test_date" name="test_date" required="true" type="text">
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

@include('beneficiary_details._search_beneficiary_page_js')