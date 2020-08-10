@extends('layouts.admin.app_admin')

@section('title', 'Admin Settings')

@push('css')
  <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/matrix-style.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/matrix-media.css')}}"/>
@endpush


@section('content')

  <div id="content-header">
    <div id="breadcrumb"><a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
      <a href="#">Settings</a> <a href="#" class="current">Admin Settings</a>
    </div>
    <h1>Admin Settings</h1>
  </div>

  <div class="container-fluid">
    <hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update Password</h5>
            </div>
            <div class="widget-content nopadding">
              <form
                class="form-horizontal"
                method="post"
                action="{{route('admin.update.password')}}"
                name="password_validate"
                id="password_validate"
                novalidate="novalidate"
              >
                @csrf
                @method('PUT')
                <div class="control-group">
                  <label class="control-label">Current Password</label>
                  <div class="controls">
                    <input type="password" name="current_password" id="current_password"/>
                    <span id="check-password"></span>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Password</label>
                  <div class="controls">
                    <input type="password" name="password" id="password"/>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Confirm password</label>
                  <div class="controls">
                    <input type="password" name="password_confirmation" id="password_confirmation"/>
                  </div>
                </div>

                <div class="form-actions">
                  <input type="submit" value="Validate" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>

@stop

@push('js')
  <script src="{{asset('js/backend_js/jquery.uniform.js')}}"></script>
  <script src="{{asset('js/backend_js/select2.min.js')}}"></script>
  <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
  <script src="{{asset('js/backend_js/matrix.js')}}"></script>
  <script src="{{asset('js/backend_js/matrix.form_validation.js')}}"></script>
@endpush
