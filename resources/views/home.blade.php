@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        @lang('menu.home')
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="#">
            @lang('menu.home')
          </a>
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="info-box bg-success">
        <span class="info-box-icon"><i class="fas fa-user-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">@lang('menu.online')</span>
          <div class="info-box-number" id="onlineUserCount">0</div>
          <div class="progress">
            <div class="progress-bar" id="onlineUser" style="width: 0"></div>
          </div>
          <div class="progress-description" id="onlineDescriptionPercent">
            0%
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-12">
      <div class="info-box bg-danger">
        <span class="info-box-icon"><i class="fas fa-user-alt-slash"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">@lang('menu.offline')</span>
          <div class="info-box-number" id="offlineUserCount">0</div>
          <div class="progress">
            <div class="progress-bar" id="offlineUser" style="width: 0"></div>
          </div>
          <div class="progress-description" id="offlineDescriptionPercent">
            0%
          </div>
        </div>
      </div>
    </div>

    {{--    <div class="col-md-6">--}}
    {{--      <div class="card card-outline card-success">--}}
    {{--        <div class="card-header">--}}
    {{--          <h3 class="card-title">Pin Yang Terpakai</h3>--}}
    {{--        </div>--}}
    {{--        <div class="card-body">--}}
    {{--          <div class="table-responsive">--}}
    {{--            <table id="list" class="table table-bordered table-striped">--}}
    {{--              <thead>--}}
    {{--              <tr>--}}
    {{--                <th style="width: 10px">#</th>--}}
    {{--                <th>Pemilik</th>--}}
    {{--                <th>Penerima</th>--}}
    {{--                <th>Di Berikan</th>--}}
    {{--                <th>Di Pakai</th>--}}
    {{--              </tr>--}}
    {{--              </thead>--}}
    {{--              <tbody>--}}
    {{--              @foreach($code->whereNotNull('send') as $item)--}}
    {{--                <tr class="text-center">--}}
    {{--                  <td>{{ $loop->index + 1 }}</td>--}}
    {{--                  <td>{{ $item->user->name }}</td>--}}
    {{--                  <td>{{ $item->send->name }}</td>--}}
    {{--                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>--}}
    {{--                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>--}}
    {{--                </tr>--}}
    {{--              @endforeach--}}
    {{--              </tbody>--}}
    {{--            </table>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}
    {{--    <div class="col-md-6">--}}
    {{--      <div class="card card-outline card-success">--}}
    {{--        <div class="card-header">--}}
    {{--          <h3 class="card-title">Pin Belum Terpakai</h3>--}}
    {{--        </div>--}}
    {{--        <div class="card-body">--}}
    {{--          <div class="table-responsive">--}}
    {{--            <table id="list2" class="table table-bordered table-striped">--}}
    {{--              <thead>--}}
    {{--              <tr>--}}
    {{--                <th style="width: 10px">#</th>--}}
    {{--                <th>Pemilik</th>--}}
    {{--                <th>Penerima</th>--}}
    {{--                <th>Di Berikan</th>--}}
    {{--                <th>Di Pakai</th>--}}
    {{--              </tr>--}}
    {{--              </thead>--}}
    {{--              <tbody>--}}
    {{--              @foreach($code->whereNull('send') as $item)--}}
    {{--                <tr class="text-center">--}}
    {{--                  <td>{{ $loop->index + 1 }}</td>--}}
    {{--                  @if($item->user)--}}
    {{--                    <td>{{ $item->user->name }}</td>--}}
    {{--                  @else--}}
    {{--                    <td></td>--}}
    {{--                  @endif--}}
    {{--                  @if($item->send)--}}
    {{--                    <td>{{ $item->send->name }}</td>--}}
    {{--                  @else--}}
    {{--                    <td></td>--}}
    {{--                  @endif--}}
    {{--                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>--}}
    {{--                  <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>--}}
    {{--                </tr>--}}
    {{--              @endforeach--}}
    {{--              </tbody>--}}
    {{--            </table>--}}
    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}
  </div>
@endsection

@section('endCSS')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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

          fetch('{{ route('config.isOnlineStatus') }}').then((response) => {
              return response.json();
          }).then((json) => {
              $("#onlineUserCount").html(json.online);
              let percentOnline = (json.online / json.count) * 100;
              $("#onlineUser").css({"width": percentOnline + "%"});
              $("#onlineDescriptionPercent").html(percentOnline.toFixed(2) + "% Online User");

              $("#offlineUserCount").html(json.offline);
              let percentOffline = (json.offline / json.count) * 100;
              $("#offlineUser").css({"width": percentOffline + "%"});
              $("#offlineDescriptionPercent").html(percentOffline.toFixed(2) + "% Offline User");
          });

          setInterval(function () {
              fetch('{{ route('config.isOnlineStatus') }}').then((response) => {
                  return response.json();
              }).then((json) => {
                  $("#onlineUserCount").html(json.online);
                  let percentOnline = (json.online / json.count) * 100;
                  $("#onlineUser").css({"width": percentOnline + "%"});
                  $("#onlineDescriptionPercent").html(percentOnline.toFixed(2) + "% Online User");

                  $("#offlineUserCount").html(json.offline);
                  let percentOffline = (json.offline / json.count) * 100;
                  $("#offlineUser").css({"width": percentOffline + "%"});
                  $("#offlineDescriptionPercent").html(percentOffline.toFixed(2) + "% Offline User");
              });
          }, 5000);
      });
  </script>
@endsection
