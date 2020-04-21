<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MTS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('end/back/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <section class="invoice">
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Mitra Tani Sejahtrea <small>Lupa Katasandi</small>
          <small class="float-right">Tgl: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
        </h2>
      </div>
    </div>
    <div class="row invoice-info">
      <p>Hallo {{ $user->name }}</p>
      <p>anda telah mingirimkan email untuk pengubhaan katasandi</p>
      <p>kilik link di bawah jika anda ingin mengubah katasandi</p>
      <p>
        <a href="{{ route('email.forgotPassword', [$user->email, encrypt($user->username)]) }}">
          LINK
        </a>
      </p>
      <p><b>jika ini bukan anda abaikan saja</b></p>
    </div>
  </section>
</div>
</body>
</html>
