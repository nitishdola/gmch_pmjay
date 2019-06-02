<!DOCTYPE html>

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Gauhati Medical College">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Gauhati Medical College">
    <title>Gauhati Medical College</title>
    
    <!-- Main styles for this application-->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    
    @yield('pageCss')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      @include('layouts.common.header')
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          @include('layouts.common.sidebar')
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          @yield('breadcumb')
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            @if(Session::has('message'))
            <div class="row">
               <div class="col-lg-12">
                     <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           {!! Session::get('message') !!}
                     </div>
                  </div>
            </div>
            @endif

          @yield('content')
          </div>
        </div>
      </main>
      
    </div>
    <footer class="app-footer">
      <div>
        <span>&copy; GMCH</span>
      </div>
      <div class="ml-auto">
        <span>Powered by</span>
        <a target="_blank" href="https://www.webgreeds.com">WebGreeds</a>
      </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="{{ asset('admin/js/coreui.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
  </body>
</html>
