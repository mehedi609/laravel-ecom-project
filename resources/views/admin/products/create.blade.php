@extends('layouts.admin.app_admin')

@section('title', 'Create Product')

@push('css')
  <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/matrix-style.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/matrix-media.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-wysihtml5.css')}}"/>
@endpush


@section('content')

  <div id="content-header">
    <div id="breadcrumb"><a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
      <a href="{{route('admin.product.index')}}">Product</a> <a href="{{route('admin.product.create')}}" class="current">Create Product</a>
    </div>
    <h1>Create Product</h1>
  </div>

  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add New Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form
              class="form-horizontal"
              method="post"
              action="{{route('admin.product.store')}}"
              name="add_product"
              id="add_product"
              novalidate="novalidate"
              enctype="multipart/form-data"
            >
              @csrf
              <div class="control-group">
                <label class="control-label">Under Category</label>
                <div class="controls">
                  <select style="width: 220px;" name="category_id">
                    <option selected disabled value="-1">Select</option>
                    @foreach ($parent_categories as $parent_category)
                      <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                      @php
                        $sub_categories = \App\Category::where('parent_id', $parent_category->id)->get();
                      @endphp
                      @foreach ($sub_categories as $sub_category)
                        <option value="{{$sub_category->id}}">&nbsp;--&nbsp;{{$sub_category->name}}</option>
                      @endforeach
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="name" id="name" placeholder="Product Name">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="code" id="code" placeholder="Product Code">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="color" id="color" placeholder="Product Color">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description" placeholder="Product Description"></textarea>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" placeholder="Product Price">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Upload Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image"/>
                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Product" class="btn btn-success">
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
