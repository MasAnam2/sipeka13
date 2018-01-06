@extends('layouts.view')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>Profile</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Profile</a></li>
      <li class="active">Change</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form role="form" action="{{ $action }}" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Profile</h3>
              <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i></button>
            </div>
              <div class="box-body">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Insert Name" name="name" required value="@if(count($errors)>0){{ old('name') }}@else{{ $data->name }}@endif">
                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-4">
                      <label for="category">Gender</label>
                      <select class="form-control select2" id="category" name="gender">
                      @if(count($errors)>0)
                        <option value="Male" @if(old('gender')=='Male') selected @endif>Male</option>
                        <option value="Female" @if(old('gender')=='Female') selected @endif>Female</option>
                      @else
                        <option value="Male" @if($data->gender=='Male') selected @endif>Male</option>
                        <option value="Female" @if($data->gender=='Female') selected @endif>Female</option>
                      @endif
                      </select>
                    </div>
                    <div class="col-xs-4">
                        <label for="born_in">Born In</label>
                        <input id="born_in" type="text" class="form-control" placeholder="Insert Born In" value="@if(count($errors)>0){{ old('born_in') }}@else{{ $data->born_in }}@endif" name="born_in" required>
                    </div>
                    <div class="col-xs-4">
                        <label for="birthdate">Birthdate</label>
                        <input id="birthdate" type="text" class="form-control" placeholder="Insert Birthdate" value="@if(count($errors)>0){{ old('birthdate') }}@else{{ eng_date2($data->birthdate) }}@endif" name="birthdate" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea name="address" required class="form-control" placeholder="Insert Address">@if(count($errors)>0){{ old('address') }}@else{{ $data->address }}@endif</textarea>
                </div>
                <div class="form-group @if ($errors->has('username')) has-error @endif">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Insert Username" name="username" required value="@if(count($errors)>0){{ old('username') }}@else{{ $username }}@endif">
                  <input type="hidden" name="old_username" value="{{ $username }}">
                  @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection