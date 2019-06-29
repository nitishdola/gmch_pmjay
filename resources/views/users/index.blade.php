@extends('layouts.default')

@section('content')

<div class="row">
  <div class="col-lg-12">

    <div class="col-lg-12">
        <div class="widget-container fluid-height clearfix">
          <div class="heading">
            <i class="fa fa-table"></i>Users List
          </div>
          <div class="widget-content padded clearfix">
            <div class="table-responsive">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                @foreach($results as $k => $v)
                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->username }}</td> 
                    <td>{{ strtoupper($v->role) }}
                    </td>
                @endforeach
              </tbody>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
