@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiary Endorscopy
            </div>
            <div class="widget-content padded clearfix">
              <p class="black-text" id="remb"> Remaining Balance :
                <span id="remaining_balance">0</span>
              </p>

              <div class="alert alert-danger" id="alert" style="display: none;">
                Remaining amount crossed 50% of package amount !
              </div>
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
                              {!! Form::label('Endorscopy_name*', '', array('class' => '')) !!}
                                  {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => true, 'placeholder' => 'Endorscopy Name', 'autocomplete' => 'off']) !!}
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
                                 <label for="test_date">Endorscopy Date*</label><input class="form-control zdatepicker" id="date" name="date" required="true" type="text">
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