@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiaries Blood Test
            </div>
            <div class="widget-content padded clearfix">
               <div class="widget-content padded">
                  <form action="" id="validate-form" method="get">
                     <fieldset>
                        <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                              {!! Form::label('Blood_test_name*', '', array('class' => '')) !!}
                                  {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name', 'autocomplete' => 'off']) !!}
                                {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
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
                                 <label for="test_date">Blood Test Date*</label><input class="form-control zdatepicker" id="test_date" name="date" required="true" type="text">
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