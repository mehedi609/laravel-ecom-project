@extends('layouts.admin.app_admin')

@section('title', 'Create Category')

@push('css')
  <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/matrix-style.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/backend_css/matrix-media.css')}}"/>
@endpush


@section('content')

  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home</a>
      <a href="#" class="current">Products</a>
    </div>
    <h1>All Products</h1>
  </div>

  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Product Image</th>
                  <th>Product Name</th>
                  <th>Product Category Name</th>
                  <th>Product Code</th>
                  <th>Product Color</th>
                  <th>Product Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                  <tr class="gradeA">
                    <td>{{$product->id}}</td>
                    <td>
                      <div class="thumbnail">
                        <img src="{{asset("images/backend_images/products/small/{$product->image}")}}" alt="{{$product->name}}" width="75">
                      </div>
                    </td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->color}}</td>
                    <td>{{$product->price}}</td>
                    <td class="center">
                      <a href="#view-{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                      <a
                        href="{{route('admin.product.edit', $product->id)}}"
                        class="btn btn-primary btn-mini"
                      >
                        Edit
                      </a>
                      <button
                        class="btn btn-danger btn-mini"
                        onclick="deleteItem({{$product->id}})"
                      >
                        Delete
                      </button>
                      <form
                        action="{{route('admin.product.destroy', $product->id)}}"
                        method="post"
                        class="d-none"
                        id="delete-{{$product->id}}"
                      >
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>

                  {{--Product View Modal--}}
                  <div id="view-{{$product->id}}" class="modal hide">
                    <div class="modal-header">
                      <button data-dismiss="modal" class="close" type="button">×</button>
                      <h3>Details of {{$product->name}}</h3>
                    </div>
                    <div class="modal-body">
                        <div class="thumbnail">
                          <img src="{{asset("images/backend_images/products/small/{$product->image}")}}" alt="">
                          <h3>{{$product->name}}</h3>
                          <h5><strong>Category</strong> -> {{$product->category->name}}</h5>
                          <h5><strong>Price</strong> -> {{$product->price}}</h5>
                          <h5><strong>Code</strong> -> {{$product->code}}</h5>
                          <h5><strong>Color</strong> -> {{$product->color}}</h5>
                          <h5><strong>Description</strong> -> {{$product->description}}</h5>
                        </div>
                    </div>
                  </div>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@push('js')
  <script src="{{asset('js/backend_js/jquery.uniform.js')}}"></script>
  <script src="{{asset('js/backend_js/select2.min.js')}}"></script>
  <script src="{{asset('js/backend_js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/backend_js/matrix.js')}}"></script>
  <script src="{{asset('js/backend_js/matrix.tables.js')}}"></script>
  <script src="{{asset('js/backend_js/matrix.interface.js')}}"></script>
  <script src="{{asset('js/backend_js/matrix.popover.js')}}"></script>

  <script>
      function deleteItem(id) {
          const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
          }).then((result) => {
              if (result.value) {
                  event.preventDefault();
                  $(`#delete-${id}`).submit()
              } else if (
                  result.dismiss === Swal.DismissReason.cancel
              ) {
                  swalWithBootstrapButtons.fire(
                      'Cancelled',
                      'Your imaginary file is safe :)',
                      'error'
                  )
              }
          })
      }
  </script>
@endpush
