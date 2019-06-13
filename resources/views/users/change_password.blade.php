@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>Change Password
            </div>
            <div class="widget-content padded clearfix">
               <div class="widget-content padded">
                   {!! Form::open(array('route' => 'change_password.save', 'id' => 'change_password.save')) !!}
                     <fieldset>
                        <div class="row">
                           <div class="col-md-4">

                              <div class="form-group {{ $errors->has('previous_password') ? 'has-error' : ''}}">
                              {!! Form::label('previous_password*', '', array('class' => '')) !!}
                                <input class="form-control" required="true" id="previous_password" name="previous_password" type="password">
                              </div>
                            </div>
                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              
                              <div class="form-group">
                                 <label for="amount">New Password</label><input class="form-control" required="true" id="password" name="password" type="password">
                              </div>
                           </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                              <div class="form-group">
                                 <label for="password_confirm">Confirm Password*</label><input class="form-control" id="password_confirm" name="password_confirm" required="true" type="password">
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