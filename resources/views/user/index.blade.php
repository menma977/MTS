@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>@lang('menu.user.index')</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item active">
          @lang('menu.user.index')
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
            <th>@lang('menu.user.role')</th>
            <th>@lang('menu.user.username')</th>
            <th>@lang('menu.user.name')</th>
            <th>@lang('menu.user.email')</th>
            <th>@lang('menu.user.phone')</th>
            <th>@lang('menu.user.id identity card')</th>
          </tr>
          </thead>
          <tbody>
          @foreach($users as $item)
            <tr class="text-center">
              <td>
                {{ $loop->index + 1 }}
                @if($item->identity_card_image && $item->identity_card_image_salve && $item->status == 1)
                  <strong class="text-success float-right">*</strong>
                @endif
              </td>
              @if($item->role == 0)
                <td>Admin</td>
                <td>
                  <button type="button" class="btn btn-block btn-sm btn-success">
                    {{ $item->username }}
                  </button>
                </td>
              @else
                <td>@lang('menu.user.index')</td>
                <td>
                  <button type="button" class="btn btn-block btn-sm btn-success" data-toggle="modal"
                          data-target="#modal-{{ $item->username }}">
                    {{ $item->username }}
                  </button>
                </td>
              @endif
              <td>
                <a href="{{ route('user.show', base64_encode($item->id)) }}"
                   class="btn btn-block btn-outline-secondary btn-sm">
                  {{ $item->name }}
                </a>
              </td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->phone }}</td>
              <td>{{ $item->id_identity_card }}</td>
            </tr>
            <div class="modal fade" id="modal-{{ $item->username }}">
              <div class="modal-dialog modal-lg">
                <div class="modal-content card card-outline card-teal">
                  <div class="modal-header">
                    <h4 class="modal-title">{{ $item->username }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle"
                               src="{{ $item->image ? asset($item->image) : asset('end/back/dist/img/avatar5.png') }}"
                               alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">
                          {{ $item->name }}
                        </h3>
                        <p class="text-muted text-center">
                          {{ $item->username }}
                        </p>
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b>
                              @lang('menu.user.email')
                            </b>
                            <a class="float-right">
                              {{ $item->email }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              @lang('menu.user.phone')
                            </b>
                            <a class="float-right">
                              {{ $item->phone }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              @lang('menu.user.id card number')
                            </b>
                            <a class="float-right">
                              {{ $item->id_identity_card }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              @lang('menu.user.province')
                            </b>
                            <a class="float-right">
                              {{ $item->province ? $item->province : 'Belum di isi' }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              @lang('menu.user.district')
                            </b>
                            <a class="float-right">
                              {{ $item->district ? $item->district : 'Belum di isi' }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              @lang('menu.user.sub_district')
                            </b>
                            <a class="float-right">
                              {{ $item->sub_district ? $item->sub_district : 'Belum di isi' }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              Sponsor
                            </b>
                            <a class="float-right">
                              {{ $item->sponsor->name }}
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-8 row">
                        <div class="col-md-12">
                          <div class="btn-group btn-block">
                            <a href="{{ route('user.update', [base64_encode($item->id), base64_encode(2)]) }}"
                               class="btn btn-sm btn-success">
                              @lang('menu.accept')
                            </a>
                            <a href="{{ route('user.update', [base64_encode($item->id), base64_encode(1)]) }}"
                               class="btn btn-sm btn-warning">
                              @lang('menu.cancel')
                            </a>
                          </div>
                        </div>
                        <div class="col-sm-6 text-center">
                          @if($item->identity_card_image)
                            <img
                                src="{{ $item->identity_card_image }}"
                                class="img-fluid mb-2" alt="ktp"/>
                          @else
                            <img
                                src="{{ asset('img/logo.png') }}"
                                class="img-fluid mb-2" alt="ktp and user"/>
                          @endif
                        </div>
                        <div class="col-sm-6 text-center">
                          @if($item->identity_card_image_salve)
                            <img
                                src="{{ $item->identity_card_image_salve }}"
                                class="img-fluid mb-2" alt="ktp and user"/>
                          @else
                            <img
                                src="{{ asset('img/logo.png') }}"
                                class="img-fluid mb-2" alt="ktp and user"/>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    @if($item->status == 0)
                      <a href="{{ route('user.delete', base64_encode($item->id)) }}"
                         class="btn btn-block btn-info btn-sm">
                        UnSuspend
                      </a>
                    @else
                      <a href="{{ route('user.delete', base64_encode($item->id)) }}"
                         class="btn btn-block btn-danger btn-sm">
                        Suspend
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
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
