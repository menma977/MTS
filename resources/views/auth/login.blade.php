@extends('layouts.login')

@section('content')
  <div class="login-logo">
    <a href="{{ url('/') }}">Apis Cerana</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">@lang('menu.login')</p>
      <form action="{{ route('login') }}" method="post">
        @csrf

        @error('username')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                 value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-envelope"></div>
            </div>
          </div>
        </div>

        @error('password')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="current-password" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-lock"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-warning btn-block">
              @lang('menu.login')
            </button>
          </div>
        </div>
      </form>

      @if (!Route::has('password.request'))
        <p class="mb-1">
          <a href="{{ route('password.request') }}">
            @lang('menu.forgetPassword')
          </a>
        </p>
      @endif
    </div>
  </div>
@endsection
