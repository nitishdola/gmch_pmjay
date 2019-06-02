@extends('layouts.auth')

@section('content')



<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card-group">
         <div class="card p-4">
            <h1>{{ __('Login') }}</h1>
            <div class="card-body">
               <p class="text-muted">Sign In to your account</p>

                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif

               <form method="POST" action="{{ route('login') }}">
               @csrf
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                     <i class="icon-user"></i>
                     </span>
                  </div>
                  <input class="form-control" name="username" type="text" placeholder="Username">
               </div>
               <div class="input-group mb-4">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                     <i class="icon-lock"></i>
                     </span>
                  </div>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row">
                  <div class="col-3">
                     <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                  </div>
                  <div class="col-9 text-right">
                     <a href="">Login  as Administrator</a>
                  </div>
                </div>
                </form>
            </div>
         </div>
         <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
               <div>
                  <img src="http://www.gmchassam.gov.in/images/emblem-00.gif">
                  <img src="https://aaas-assam.in/images/abpmjaylogo.png">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
