@extends('layouts.admin.app_admin')

@section('title', 'Edit Category')

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
      <a href="#">Category</a> <a href="#" class="current">Edit Category</a>
    </div>
    <h1>Edit Category</h1>
  </div>

  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form
              class="form-horizontal"
              method="post"
              action="{{route('admin.category.update', $category->id)}}"
              name="add_category"
              id="add_category"
              novalidate="novalidate"
            >
              @csrf
              @method('PUT')
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Category Name"
                    value="{{$category->name}}"
                  >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea
                    name="description"
                    id="description"
                    placeholder="Description"
                  >{{$category->description}}</textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Select Category</label>
                <div class="controls">
                  <select style="width: 220px;" name="parent_id">
                    <option value="0">Parent Category</option>
                    @foreach ($parent_categories as $parent_category)
                      <option
                        value="{{$parent_category->id}}"
                        {{$parent_category->id == $category->parent_id ? 'selected' : ''}}
                      >
                        {{$parent_category->name}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Edit Category" class="btn btn-success">
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
