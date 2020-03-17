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
  </div>
@endsection

@section('endCSS')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('endJS')
  <script>
      $(function () {

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
