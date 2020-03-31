<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>MTS</title>

  <!-- ==============================================
  Favicons
  =============================================== -->
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/logo.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/logo.png') }}">

  <!-- ==============================================
  CSS VENDOR
  =============================================== -->
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/vendor/bootstrap.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/vendor/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/vendor/owl.carousel.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/vendor/owl.theme.default.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/vendor/magnific-popup.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/vendor/animate.min.css') }}">

  <!-- ==============================================
  Custom Stylesheet
  =============================================== -->
  <link rel="stylesheet" type="text/css" href="{{ asset('end/front/css/style.css') }}"/>

  <script src="{{ asset('end/front/js/vendor/modernizr.min.js') }}"></script>
</head>
<body>

<!-- LOAD PAGE -->
<div class="animationload">
  <div class="loader"></div>
</div>

<!-- BACK TO TOP SECTION -->
<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

<x-FrontEndHeader/>

@yield('content')

<!-- FOOTER SECTION -->
<div class="footer">
  <div class="content-wrap pb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="footer-item">
            <img src="{{ asset('img/logo.png') }}" alt="logo bottom" class="logo-bottom"
                 style="width: 80px; height: 80px">
            <div class="spacer-30"></div>
            <p>
              MTS ( mita tani sejahtera ) adalah komunitas kemitraan petani porang yang di bawah naungan koperasi serba
              usaha BUMI RAHAYU badan hukum BH: 23/BH/XVI.17/XI/2014
            </p>
            {{--            <div class="sosmed-icon icon-bg-primary d-inline-flex">--}}
            {{--              <a href="#"><i class="fa fa-facebook"></i></a>--}}
            {{--              <a href="#"><i class="fa fa-twitter"></i></a>--}}
            {{--              <a href="#"><i class="fa fa-instagram"></i></a>--}}
            {{--              <a href="#"><i class="fa fa-pinterest"></i></a>--}}
            {{--              <a href="#"><i class="fa fa-linkedin"></i></a>--}}
            {{--            </div>--}}
          </div>
        </div>

        <div class="col-md-4">
          <div class="footer-item">
            <div class="footer-title">
              Contact Info
            </div>
            <div class="row mb-3">
              <div class="col-5">Address :</div>
              <div class="col-7">RT.001 / RW. 003 Denguk kecamatan karangjati kabupaten ngawi kode pos 63284</div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <img src="{{ asset('end/front/images/dummy-img-600x800.png') }}" alt="" class="img-fluid">
        </div>
      </div>
    </div>
  </div>

  <div class="fcopy">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <p class="ftex">Copyright 2019 &copy; <span class="color-primary">Gaco Html Template</span>. Designed by <span
                class="color-primary">Rometheme.</span></p>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- JS VENDOR -->
<script src="{{ asset('end/front/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('end/front/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('end/front/js/vendor/owl.carousel.js') }}"></script>
<script src="{{ asset('end/front/js/vendor/jquery.magnific-popup.min.js') }}"></script>

<!-- SENDMAIL -->
<script src="{{ asset('end/front/js/vendor/validator.min.js') }}"></script>
<script src="{{ asset('end/front/js/vendor/form-scripts.js') }}"></script>

<script src="{{ asset('end/front/js/script.js') }}"></script>
</body>
</html>
