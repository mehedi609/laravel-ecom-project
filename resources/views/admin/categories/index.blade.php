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
      <a href="#" class="current">Categories</a>
    </div>
    <h1>All Categories</h1>
  </div>

  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Parent Category ID with Name</th>
                  <th>Category URL</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                  <tr class="gradeA">
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    @if ($category->parent_id == 0)
                        <td>0 => Main Category</td>
                    @else
                      @php
                        $parent_category = \App\Category::where('id', $category->parent_id)->first();
                      @endphp
                      <td>{{"{$parent_category->id} => {$parent_category->name}"}}</td>
                    @endif

{{--                    <td>{{$category->parent_id}}</td>--}}
                    <td>{{$category->url}}</td>
                    <td class="center">
                      <a
                        href="{{route('admin.category.edit', $category->id)}}"
                        class="btn btn-primary btn-mini"
                      >
                        Edit
                      </a>
                      <button
                        class="btn btn-danger btn-mini"
                        onclick="deleteCategory({{$category->id}})"
                      >
                        Delete
                      </button>
                      <form
                        action="{{route('admin.category.destroy', $category->id)}}"
                        method="post"
                        class="d-none"
                        id="delete-category-{{$category->id}}"
                      >
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
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

  <script>
      function deleteCategory(id) {
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
                  $(`#delete-category-${id}`).submit()
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
