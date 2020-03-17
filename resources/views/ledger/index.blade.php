@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>@lang('menu.ledger')</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item active">
          @lang('menu.ledger')
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="card card-outline card-teal">
    <div class="card-body">
      <div class="table-responsive">
        <table id="list" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>@lang('menu.user.index')</th>
            <th>Code</th>
            <th style="width: 500px">@lang('menu.description')</th>
            <th style="width: 200px">Debit</th>
            <th style="width: 200px">Credit</th>
            <th style="width: 10px">Type</th>
            <th style="width: 200px">@lang('menu.date')</th>
          </tr>
          </thead>
          <tbody>
          @foreach($ledger as $item)
            <tr class="text-center">
              <td>{{ $loop->index + 1 }}</td>
              <td>{{ $item->user->name }}</td>
              <td>{{ $item->code }}</td>
              <td>{{ $item->description }}</td>
              @if($item->ledger_type == 3)
                <td>Rp {{ number_format($item->credit, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->debit, 0, ',', '.') }}</td>
              @else
                <td>Rp {{ number_format($item->debit, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->credit, 0, ',', '.') }}</td>
              @endif
              @if($item->ledger_type == 0)
                <td>
                  <div class="badge bg-success">@lang('menu.income')</div>
                </td>
              @elseif($item->ledger_type == 1)
                <td>
                  <div class="badge bg-warning">@lang('menu.outcome')</div>
                </td>
              @elseif($item->ledger_type == 2)
                <td>
                  <div class="badge bg-info">Bonus</div>
                </td>
              @else
                <td>
                  <div class="badge bg-danger">@lang('menu.withdraw')</div>
                </td>
              @endif
              <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
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
      });
  </script>
@endsection
