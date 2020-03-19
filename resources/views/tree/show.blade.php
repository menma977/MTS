@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        @lang('menu.kafling')
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item active">
          <a href="{{ route('tree.index') }}">
            @lang('menu.Porang')
          </a>
        </li>
        <li class="breadcrumb-item active">
          @lang('menu.kafling')
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-teal">
        <div class="card-header">
          <h3 class="card-title">Timukan Berdasarkan Username</h3>
        </div>
        <div class="card-body text-center">
          <div class="row">
            <div class="col-md-8">
              <select class="form-control select2 select2-teal" data-dropdown-css-class="select2-teal" id="username">
                @foreach($users as $item)
                  @if($item->username == $username)
                    <option selected="selected">{{ $item->username }}</option>
                  @else
                    <option>{{ $item->username }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-block btn-info" id="submit">Find</button>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-block btn-primary" id="reset">Reset</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @foreach($tree as $index => $item)
      <div class="col-md-6">
        <div class="card card-outline card-teal collapsed-card">
          <div class="card-header text-center row">
            @if($item->user)
              <div class="col-md-5">
                <div class="btn btn-outline-success btn-sm btn-block" data-card-widget="collapse">
                  {{ $item->code }}
                </div>
              </div>
              <div class="col-md-6">
                <button type="button" class="btn btn-block btn-sm btn-success" data-toggle="modal"
                        data-target="#modal-success{{ $item->code }}">
                  Generate Certificat
                </button>
              </div>
              <div class="card-tools col-md-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            @else
              <div class="col-md-11">
                <div class="btn btn-outline-success btn-sm btn-block" data-card-widget="collapse">
                  {{ $item->code }}
                </div>
              </div>
              <div class="card-tools col-md-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            @endif
          </div>
          <div class="card-body" style="display: none;">
            <small>
              Tanggal Upload : {{ $item->created_at }}
            </small>
            @if($item->gallery->count())
              <hr>
            @endif
            <div class="row">
              @foreach($item->gallery as $indexGallery => $itemGallery)
                <div class="col-sm-6">
                  <a href="{{ $itemGallery->image }}" data-toggle="lightbox" data-title="{{ $itemGallery->created_at }}"
                     data-gallery="gallery" data-max-width="600" data-max-height="600">
                    <img src="{{ $itemGallery->image }}" class="mb-2 img-fluid" alt="img"/>
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@section('endCSS')
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/ekko-lightbox/ekko-lightbox.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('end/back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/toastr/toastr.min.css') }}">
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
  <!-- Ekko Lightbox -->
  <script src="{{ asset('end/back/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('end/back/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
      $(function () {
          $(document).on('click', '[data-toggle="lightbox"]', function (event) {
              event.preventDefault();
              $(this).ekkoLightbox({
                  alwaysShowClose: true,
              });
          });
          //Initialize Select2 Elements
          $('.select2').select2();

          $('#submit').click(function () {
              let url = "{{ route('tree.show', '#username') }}";
              window.location.href = url.replace("#username", $("#username").val());
          });

          $('#reset').click(function () {
              window.location.href = "{{ route('tree.show', 'all') }}";
          });
      });
  </script>
@endsection