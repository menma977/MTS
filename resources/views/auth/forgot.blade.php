@extends('layouts.login')

@section('content')
  <div class="login-logo">
    <a href="{{ url('/') }}">
      <img src="{{ asset('img/logo.png') }}" class="login-logo" style="width: 300px;" alt="logo">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      @if($validate)
        <p class="login-box-msg">Lupa Kata Sandi</p>
        <form action="{{ route('email.updatePassword', [$user->email, $token]) }}" method="post">
          @csrf
          @error('password')
          <div class="text-danger" role="alert">
            <small>{{ $message }}</small>
          </div>
          @enderror
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password" placeholder="password Baru">
            <div class="input-group-append">
              <div class="input-group-text">
                <div class="fas fa-lock"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
              <button type="submit" class="btn btn-success btn-block">
                Update
              </button>
            </div>
          </div>
        </form>
      @else
        <p class="login-box-msg">Data Yang anda kirimkan tidak valid coba ulangi lagi</p>
      @endif
    </div>
  </div>
@endsection
