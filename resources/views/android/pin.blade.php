@extends('layouts.android')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="info-box">
        <div class="info-box-icon bg-success elevation-1">
          <i class="fas fa-barcode"></i>
        </div>
        <div class="info-box-content">
          <span class="info-box-text">Pin Telah Terpakai</span>
          <div class="info-box-number">
            {{ $code->whereNotNull('send')->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title">Pin Yang Terpakai</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="list" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Pemilik</th>
                <th>Penerima</th>
                <th>Di Berikan</th>
                <th>Di Pakai</th>
              </tr>
              </thead>
              <tbody>
              @foreach($code->whereNotNull('send') as $item)
                <tr class="text-center">
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $item->user->name }}</td>
                  <td>{{ $item->send->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="info-box">
        <div class="info-box-icon bg-info elevation-1">
          <i class="fas fa-barcode"></i>
        </div>
        <div class="info-box-content">
          <span class="info-box-text">Pin Belum Terpakai</span>
          <div class="info-box-number">
            {{ $code->whereNull('send')->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title">Pin Belum Terpakai</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="list2" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Pemilik</th>
                <th>Penerima</th>
                <th>Di Berikan</th>
                <th>Di Pakai</th>
              </tr>
              </thead>
              <tbody>
              @foreach($code->whereNull('send') as $item)
                <tr class="text-center">
                  <td>{{ $loop->index + 1 }}</td>
                  @if($item->user)
                    <td>{{ $item->user->name }}</td>
                  @else
                    <td></td>
                  @endif
                  @if($item->send)
                    <td>{{ $item->send->name }}</td>
                  @else
                    <td></td>
                  @endif
                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('endCSS')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('endJS')
  <!-- DataTables -->
  <script src="{{ asset('end/back/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('end/back/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script>
      $(function () {
          $("#list").DataTable();
          $("#list2").DataTable();
      });
  </script>
@endsection