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
  {{--  <div class="row">--}}
  {{--    <div class="col-md-12">--}}
  {{--      <a href="#" class="btn btn-app" data-toggle="modal" data-target="#modal-code">--}}
  {{--        <i class="fas fa-edit"></i>--}}
  {{--        Kirim Pin--}}
  {{--      </a>--}}
  {{--    </div>--}}
  {{--  </div>--}}

  <div class="modal fade" id="modal-code">
    <div class="modal-dialog modal-sm">
      <div class="modal-content card card-outline card-teal">
        <div class="modal-header">
          <h4 class="modal-title">Kirim Pin Ke User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('user.sendCode') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="username">Username</label>
              <select class="form-control select2 select2-teal" data-dropdown-css-class="select2-teal"
                      name="user">
                @foreach($users as $item)
                  <option value="{{ $item->id }}">{{ $item->username }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="pin">Total PIN</label>
              <input type="number" class="form-control" name="pin" placeholder="Jumlah Pin EX: 1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-block btn-success btn-xs">Success</button>
          </div>
        </form>
      </div>
    </div>
  </div>

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
              @if($item->role == 1)
                <td>Admin</td>
                <td>
                  <button type="button" class="btn btn-block btn-sm btn-success">
                    {{ $item->username }}
                  </button>
                </td>
              @elseif($item->role == 2)
                <td>Mitra Mandiri</td>
                <td>
                  <button type="button" class="btn btn-block btn-sm btn-success" data-toggle="modal"
                          data-target="#modal-{{ $item->username }}">
                    {{ $item->username }}
                  </button>
                </td>
              @elseif($item->role == 3)
                <td>Mitra luar biasa</td>
                <td>
                  <button type="button" class="btn btn-block btn-sm btn-success" data-toggle="modal"
                          data-target="#modal-{{ $item->username }}">
                    {{ $item->username }}
                  </button>
                </td>
              @else
                <td>Mitra agen</td>
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
                              BANK
                            </b>
                            <a class="float-right">
                              {{ $item->bank }}
                            </a>
                          </li>
                          <li class="list-group-item">
                            <b>
                              Nomor Rekening
                            </b>
                            <a class="float-right">
                              {{ $item->pin_bank }}
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
                              Alamat
                            </b>
                            <a class="float-right">
                              {{ $item->address ? $item->address : 'Belum di isi' }}
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
                          @if($item->role != 1)
                            <li class="list-group-item">
                              <form action="{{ route('user.roleUpdate', base64_encode($item->id)) }}"
                                    method="POST">
                                @csrf
                                <div class="input-group input-group-sm">
                                  <select class="form-control" name="role" id="role">
                                    <option value="2" {{ $item->role == 2 ? 'selected' : '' }}>
                                      Mitra Mandiri
                                    </option>
                                    <option value="3" {{ $item->role == 3 ? 'selected' : '' }}>
                                      Mitra luar biasa
                                    </option>
                                    <option value="4" {{ $item->role == 4 ? 'selected' : '' }}>
                                      Mitra agen
                                    </option>
                                  </select>
                                  <div class="input-group-append">
                                    <button type="submit"
                                            class="btn btn-success btn-flat">Update
                                    </button>
                                  </div>
                                </div>
                              </form>
                            </li>
                          @endif
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
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/toastr/toastr.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('end/back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <style>
    .select2-selection__rendered {
      line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
      height: 35px !important;
    }

    .select2-selection__arrow {
      height: 35px !important;
    }
  </style>
@endsection

@section('endJS')
  <!-- DataTables -->
  <script src="{{ asset('end/back/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('end/back/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('end/back/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('end/back/plugins/toastr/toastr.min.js') }}"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2();

      $("#list").DataTable();

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
      });
      @error('img')
      Toast.fire({
        type: 'error',
        title: '{{ $message }}'
      });
      @enderror
      @error('user')
      Toast.fire({
        type: 'error',
        title: '{{ $message }}'
      });
      @enderror
      @error('pin')
      Toast.fire({
        type: 'error',
        title: '{{ $message }}'
      });
      @enderror
    });
  </script>
@endsection
