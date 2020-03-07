<x-FrontEndHeader/>
<!-- HEADER -->
<div class="header header-1">
  <!-- TOPBAR -->
  <div class="topbar d-none d-md-block">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-8 col-md-10 col-lg-9">
          <div class="info">
            <div class="info-item">
              <i class="fa fa-phone"></i> +62 7144 3300
            </div>
            <div class="info-item">
              <i class="fa fa-clock-o"></i> Mon - Sat : 08:00 - 17:00
            </div>
            <div class="info-item">
              <i class="fa fa-map-marker"></i> 99 Park Jomblo, Pekanbaru
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-md-2 col-lg-3">
          <div class="sosmed-icon pull-right d-inline-flex">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- NAVBAR SECTION -->
  <div class="navbar-main">
    <div class="container">
      <nav id="navbar-example" class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('end/front/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">
                HOME
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">HOME VERSION 1</a>
                <a class="dropdown-item" href="#">HOME VERSION 2</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">ABOUT US</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">SERVICES</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">
                PAGES
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">GALLERY</a>
                <a class="dropdown-item" href="#">TESTIMONIALS</a>
                <a class="dropdown-item" href="#">FAQ</a>
                <a class="dropdown-item" href="#">404 PAGE</a>
                <a class="dropdown-item" href="#">NEWS</a>
                <a class="dropdown-item" href="#">SINGLE NEWS</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">CONTACT US</a>
            </li>
          </ul>
          <a href="#" class="btn btn-primary btn-nav ml-auto">GET FREE QUOTE</a>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>
  </div>

</div>