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
          <i class="fas fa-globe"></i> Mitra Tani Sejahtrea <small>Invoice</small>
          <small class="float-right">Tgl: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
        </h2>
      </div>
    </div>
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
        Dari
        <address>
          <strong>{{ Auth::user()->name }}</strong><br>
          Status: ADMIN<br>
          BANK: {{ Auth::user()->bank }}<br>
          No Rekening: {{ Auth::user()->pin_bank }}
        </address>
      </div>
      <div class="col-sm-6 invoice-col">
        Untuk
        <address>
          <strong>{{ $order->user->name }}</strong><br>
          Username: {{ $order->user->username }}<br>
          Email: {{ $order->user->email }}<br>
          No Telepon: {{ $order->user->phone }}<br>
          BANK: {{ $order->user->bank }}<br>
          No Rekening: {{ $order->user->pin_bank }}
        </address>
      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Serial</th>
            <th>Deskirpsi</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{ $order->total }}</td>
            <td>{{ $order->type == 0 ? 'Porang' : 'Talas' }}</td>
            <td>{{ $order->code }}</td>
            <td>Anda Membeli Produk dengan jumlah {{ $order->total }} dengan total harga
              Rp {{ number_format($order->price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
          </tr>
          @if($order->status == 99)
            <tr>
              <td>1</td>
              <td>Bergabu Menjadi Agen</td>
              <td>{{ $order->code }}</td>
              <td>Anda bergabung menjadi Agen dengan biyaya Rp {{ number_format($order->agenMode, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($order->agenMode, 0, ',', '.') }}</td>
            </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Bukti Transfer:</p>
        @if($order->image)
          <img src="{{ $order->image }}" alt="transfer" style="width: 200px;height: 150px">
          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Bila Ingin Membatalkan silahkan hubungi Admin
          </p>
        @else
          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Tidak Ada Bukti Transfer
          </p>
        @endif
      </div>
      <div class="col-6">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
            </tr>
            @if($order->status == 99)
              <tr>
                <th>Biyaya Agen:</th>
                <td>Rp {{ number_format($order->agenMode, 0, ',', '.') }}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>Rp {{ number_format($order->price + $order->agenMode, 0, ',', '.') }}</td>
              </tr>
            @else
              <tr>
                <th>Total:</th>
                <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
              </tr>
            @endif
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

</body>
</html>
