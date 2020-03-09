<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- ==============================================
  Favicons
  =============================================== -->
  <link rel="shortcut icon" href="{{ asset('end/front/images/favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('end/front/images/apple-touch-icon.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('end/front/images/apple-touch-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('end/front/images/apple-touch-icon-114x114.png') }}">

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
        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="footer-item">
            <img src="{{ asset('end/front/images/logo_w.png') }}" alt="logo bottom" class="logo-bottom">
            <div class="spacer-30"></div>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
              laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p>
            <div class="sosmed-icon icon-bg-primary d-inline-flex">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-pinterest"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="footer-item">
            <div class="footer-title">
              Contact Info
            </div>

            <div class="row mb-3">
              <div class="col-5">Address :</div>
              <div class="col-7">-</div>
            </div>
            <div class="row mb-3">
              <div class="col-5">Office :</div>
              <div class="col-7">-</div>
            </div>
            <div class="row mb-3">
              <div class="col-5">Fax :</div>
              <div class="col-7">-</div>
            </div>
            <div class="row mb-3">
              <div class="col-5">Email :</div>
              <div class="col-7">-</div>
            </div>

          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="footer-item">
            <div class="footer-title">
              Opening Hours
            </div>

            <div class="row mb-3">
              <div class="col-5">Mon - Sat :</div>
              <div class="col-7">08:00 - 17:00</div>
            </div>
            <div class="row mb-3">
              <div class="col-5">Sunday :</div>
              <div class="col-7">09:00 - 15:00</div>
            </div>
            <div class="row mb-3">
              <div class="col-5">Friday :</div>
              <div class="col-7">Closed</div>
            </div>

          </div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-3">
          <img src="{{ asset('end/front/images/dummy-img-600x800.jpg') }}" alt="" class="img-fluid">
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
