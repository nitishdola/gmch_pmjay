@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Beneficiaries Medicines and Consumables etc. add
            </div>
            <div class="widget-content padded clearfix">
              <p class="black-text" id="remb"> Remaining Balance :
                <span id="remaining_balance">0</span>
              </p>

              <div class="alert alert-danger" id="alert" style="display: none;">
                Remaining amount crossed 50% of package amount !
              </div>
               <div class="widget-content padded">
                  {!! Form::open(array('route' => 'beneficary_details.medicine.save', 'id' => 'beneficary_details.medicine.save')) !!}
                     <fieldset>
                        <div class="row">
                            <?php 
                              $medical_types['Amrit Pharmacy'] = 'Amrit Pharmacy';
                              $medical_types['Others'] = 'Others';
                            ?>
                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('medical_type') ? 'has-error' : ''}}">
                              {!! Form::label('medical_type*', '', array('class' => '')) !!}
                                  {!! Form::select('medical_type', $medical_types, null, ['class' => 'form-control', 'id' => 'medical_type', 'placeholder' => 'Select Medical type', 'required' => true]) !!}
                                {!! $errors->first('medical_type', '<span class="help-inline">:message</span>') !!}
                              </div>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('invoice_number') ? 'has-error' : ''}}">
                              {!! Form::label('invoice_number', '', array('class' => '')) !!}
                                  {!! Form::text('invoice_number', null, ['class' => 'form-control', 'id' => 'invoice_number', 'placeholder' => 'Invoice Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('invoice_number', '<span class="help-inline">:message</span>') !!}
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>
                              </div>
                              <div class="form-group">
                                 <label for="amount">Amount*</label><input class="form-control" required="true" min="1" step="0.01" id="amount" name="amount" type="number">
                              </div>
                           </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for="lastname">Date of Admission</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
                              </div>
                              <div class="form-group">
                                 <label for="bill_date">Bill Date*</label><input class="form-control zdatepicker" id="bill_date" name="bill_date" required="true" type="text">
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