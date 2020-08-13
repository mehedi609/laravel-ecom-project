<!DOCTYPE html>
<html lang="en">
  <head>
    <title>E-com | @yield('title')</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-responsive.min.css')}}" />
    <link href="{{asset('fonts/backend_fonts/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    @stack('css')
  </head>
  <body>

    <!--Header-part-->
    <div id="header">
      <h1><a href="{{route('admin.dashboard')}}">Matrix Admin</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    @include('layouts.admin.partials._header')
    <!--close-top-serch-->

    <!--sidebar-menu-->
    @include('layouts.admin.partials._sidebar')
    <!--sidebar-menu-->

    <!--main-container-part-->
    <div id="content">
      @yield('content')
    </div>
    <!--end-main-container-part-->

    <!--Footer-part-->
    @include('layouts.admin.partials._footer')
    <!--end-Footer-part-->

    <script src="{{asset("js/backend_js/jquery.min.js")}}"></script>
    <script src="{{asset("js/backend_js/jquery.ui.custom.js")}}"></script>
    <script src="{{asset("js/backend_js/bootstrap.min.js")}}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.all.min.js"></script>

    @stack('js')

    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage (newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-" ) {
                    resetMenu();
                }
                // else, send page to designated URL
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>

    {!! Toastr::message() !!}
  </body>
</html>
