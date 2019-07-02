@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>PMJAY Honorarium Paid to Medical Team

            </div>
               <div class="widget-content padded">
                  {!! Form::open(array('route' => 'honorarium.save', 'id' => 'honorarium.save')) !!}
                     <fieldset>
                        <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('beneficiary_detail_id') ? 'has-error' : ''}}">
                                {!! Form::label('beneficiary_detail_id*', '', array('class' => '')) !!}
                                  {!! Form::select('beneficiary_detail_id', $all_beneficiaries, null, ['class' => 'select2able', 'id' => 'beneficiary_detail_id', 'placeholder' => 'Select Inward Number', 'autocomplete' => 'off', 'required' => 'true']) !!}
                                {!! $errors->first('beneficiary_detail_id', '<span class="help-inline">:message</span>') !!}
                              </div>

                              <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                                 <label for="amount">Amount*</label><input class="form-control" required="true" id="amount_" name="amount" type="number" step="0.01">

                                 {!! $errors->first('amount', '<span class="help-inline">:message</span>') !!}

                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group {{ $errors->has('name_of_patient') ? 'has-error' : ''}}">
                                 <label for="name_of_patient">Beneficiary Name</label><input class="form-control" id="name_of_patient" name="name_of_patient" type="text" disabled>

                              </div>
                              <div class="form-group {{ $errors->has('pay_date') ? 'has-error' : ''}}">
                                 <label for="lastname">Date of Payment*</label><input class="form-control zdatepicker"  id="pay_date" name="pay_date" type="text">

                                 {!! $errors->first('pay_date', '<span class="help-inline">:message</span>') !!}
                              </div>

                              
                           </div>

                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('date_of_admission') ? 'has-error' : ''}}">
                                 <label for="lastname">Date of Admission*</label><input class="form-control" disabled id="date_of_admission" name="date_of_admission" type="text">
                              </div>
                              <div class="form-group {{ $errors->has('remarks') ? 'has-error' : ''}}">
                                 <label for="test_date">Remarks</label>
                                 <textarea class="form-control" rows="5" name="remarks"></textarea>

                                  {!! $errors->first('remarks', '<span class="help-inline">:message</span>') !!}
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