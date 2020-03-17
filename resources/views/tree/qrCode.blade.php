<!DOCTYPE html>
<html>
<head>
  <title>QR</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('end/back/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
</head>
<body>

<div class="visible-print text-center">

  <img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
  <h5>{{ $code }}</h5>
  <small>{{ URL::to('/') }}</small>

</div>

<!-- jQuery -->
<script src="{{ asset('end/back/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('end/back/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('end/back/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('end/back/dist/js/demo.js') }}"></script>
</body>
</html>
