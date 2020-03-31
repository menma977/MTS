<!-- HEADER -->
<div class="header header-1">
  <!-- NAVBAR SECTION -->
  <div class="navbar-main">
    <div class="container">
      <nav id="navbar-example" class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('img/logo.png') }}" alt="" style="width: 60px; height: 60px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          {{--          <ul class="navbar-nav ml-auto">--}}
          {{--            <li class="nav-item">--}}
          {{--              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"--}}
          {{--                 aria-expanded="false">--}}
          {{--                HOME--}}
          {{--              </a>--}}
          {{--            </li>--}}
          {{--            <li class="nav-item">--}}
          {{--              <a class="nav-link" href="#">ABOUT US</a>--}}
          {{--            </li>--}}
          {{--            <li class="nav-item">--}}
          {{--              <a class="nav-link" href="#">SERVICES</a>--}}
          {{--            </li>--}}
          {{--            @guest--}}
          {{--              <li class="nav-item">--}}
          {{--                <a class="nav-link" href="{{ route('login') }}">Login</a>--}}
          {{--              </li>--}}
          {{--            @else--}}
          {{--              <li class="nav-item">--}}
          {{--                <a class="nav-link" href="{{ route('home') }}">Home</a>--}}
          {{--              </li>--}}
          {{--            @endguest--}}
          {{--          </ul>--}}
          @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-nav ml-auto">Login</a>
          @else
            <a href="{{ route('home') }}" class="btn btn-primary btn-nav ml-auto">Home</a>
          @endguest
        </div>
      </nav>
      <!-- End Navbar -->
    </div>
  </div>

</div>