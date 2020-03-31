<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MTS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon icon -->
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('end/back/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
  @yield('startCSS')
  @yield('endCSS')
</head>

<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">
  <div>
    <section class="content">
      @yield('content')
    </section>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('end/back/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('end/back/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@yield('startJS')
<!-- AdminLTE App -->
<script src="{{ asset('end/back/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('end/back/dist/js/demo.js') }}"></script>
@yield('endJS')
</body>

</html>
