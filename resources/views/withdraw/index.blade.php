@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>@lang('menu.withdraw')</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item active">
          @lang('menu.withdraw')
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-header d-flex p-0">
      <h3 class="card-title p-3">@lang('menu.withdraw')</h3>
      <ul class="nav nav-pills ml-auto p-2">
        <li class="nav-item">
          <a class="nav-link active" href="#tab_1" data-toggle="tab">
            @lang('menu.request')
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tab_2" data-toggle="tab">
            @lang('menu.withdraw')
          </a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <table id="list" class="table table-bordered table-striped">
            <thead>
            <tr class="text-center">
              <th style="width: 10px">#</th>
              <th style="width: 150px">@lang('menu.user.index')</th>
              <th style="width: 300px">@lang('menu.amount') @lang('menu.withdraw')</th>
              @if(\Illuminate\Support\Facades\Auth::user()->role == 1)
                <th style="width: 20px">@lang('menu.action')</th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach($requestWithdraw as $item)
              <tr class="text-center">
                <td>{{ $loop->index + 1 }}</td>
                <td>
                  <a href="{{ route('user.show', base64_encode($item->id)) }}" target="_blank"
                     class="btn btn-block btn-secondary btn-xs">
                    {{ $item->user->name }}
                  </a>
                </td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                @admin
                <td>
                  <div class="btn-group">
                    <a href="{{ route('withdraw.update', [base64_encode($item->id), base64_encode(1)]) }}"
                       class="btn btn-sm btn-success">
                      @lang('menu.accept')
                    </a>
                    <a href="{{ route('withdraw.update', [base64_encode($item->id), base64_encode(2)]) }}"
                       class="btn btn-sm btn-danger">
                      @lang('menu.cancel')
                    </a>
                  </div>
                </td>
                @endadmin
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="tab_2">
          <table id="list2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 150px">@lang('menu.user.index')</th>
              <th style="width: 300px">@lang('menu.amount') @lang('menu.withdraw')</th>
              <th style="width: 20px">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($withdraw as $item)
              <tr class="text-center">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td>
                  <span class="badge bg-danger">@lang('menu.withdraw')</span>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
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
