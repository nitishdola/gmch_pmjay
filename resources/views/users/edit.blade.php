@extends('layouts.default')

@section('content')

<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-12">
         <div class="widget-container fluid-height clearfix">
            <div class="heading">
               <i class="fa fa-table"></i>Edit User

            </div>
            

            <div class="widget-content padded clearfix">
               <div class="widget-content padded">
                  {!! Form::model($user, array('route' => ['user.update', $user->id], 'id' => 'user.save', 'onsubmit' => 'return submitVerify()')) !!}
                     <fieldset>
                        <div class="row">
                          <div class="col-md-4">

                            <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                              {!! Form::label('username*', '', array('class' => '')) !!}
                                {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username', 'autocomplete' => 'off', 'readonly' => true, 'required' => 'true']) !!}
                              {!! $errors->first('username', '<span class="help-inline">:message</span>') !!}
                            </div>
                          </div>
                        </div>

                        <?php 
                          $roles = [];

                          $roles['admin'] = 'Admin';
                          $roles['ha'] = 'HA';
                          $roles['ha'] = 'Pharmacist';
                          $roles['accountant'] = 'Accountant';

                        ?>

                        <div class="row">
                          <div class="col-md-4">

                            <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
                              {!! Form::label('role*', '', array('class' => '')) !!}
                                {!! Form::select('role', $roles, null, ['class' => 'form-control', 'id' => 'role', 'placeholder' => 'Role', 'autocomplete' => 'off', 'required' => 'true']) !!}
                              {!! $errors->first('role', '<span class="help-inline">:message</span>') !!}
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-md-4">
                            <div class="form-group">
                               <label for="name_of_patient">Full Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'full_name', 'placeholder' => 'Full Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                               <label for="name_of_patient">Password</label><input class="form-control" id="password" name="password" type="password">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                               <label for="name_of_patient">Confirm Password</label><input class="form-control" id="password_confirm" name="password_confirm" type="password">
                            </div>
                          </div>
                        </div>

                      <button class="btn btn-primary" type="submit"><i class="fa fa-download" aria-hidden="true"></i> Update </button>
                    </fieldset>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop

@section('pageJs')
<script>
submitVerify = function() {
  pass = $('#password').val();
  pass_confirm = $('#password_confirm').val();


  if($('#username').val() == '') {
    alert('Username is empty');return false;
  }

  if($('#role').val() == '') {
    alert('Role is empty');return false;
  }

  if($('#full_name').val() == '') {
    alert('Full Name is empty');return false;
  }

  if($('#password').val() == '') {
    alert('Password is empty');return false;
  }

  if(pass == pass_confirm) {
    return true;
  }else{
    alert('Password not matched');
    return false;
  }

}
</script>
@stop