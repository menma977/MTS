@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>@lang('menu.list') Tree</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item active">
          @lang('menu.Porang')
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="info-box">
        <div class="info-box-icon bg-teal">
          <i class="fas fa-boxes"></i>
        </div>
        <div class="info-box-content">
          <div class="info-box-text">@lang('menu.amount') @lang('menu.Porang')</div>
          <div class="info-box-number">{{ $tree->count() }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <div class="info-box-icon bg-teal">
          <i class="fas fa-box"></i>
        </div>
        <div class="info-box-content">
          <div class="info-box-text">@lang('menu.sold')</div>
          <div class="info-box-number">{{ $tree->where('user', '!=', null)->count() }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <div class="info-box-icon bg-teal">
          <i class="fas fa-box-open"></i>
        </div>
        <div class="info-box-content">
          <div class="info-box-text">@lang('menu.not sold yet')</div>
          <div class="info-box-number">{{ $tree->where('user', null)->count() }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6 text-center">
      <a class="btn btn-app btn-warning" data-toggle="modal" data-target="#modal-list">
        <i class="fas fa-barcode"></i>
        @lang('menu.print Barcode')
      </a>
    </div>
    <div class="col-6 text-center">
      <a class="btn btn-app" data-toggle="modal" data-target="#modal-sm">
        <i class="fas fa-plus-square"></i>
        @lang('menu.new Porang')
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div id="accordion">
        <div class="card card-outline card-teal">
          <div class="card-header">
            <button type="button" class="btn btn-block btn-info btn-xs collapsed" data-toggle="collapse"
                    data-parent="#accordion" href="#newTree" aria-expanded="false">
              @lang('menu.new Porang Request')
            </button>
            @if($order->where('status', 0)->count())
              <div class="badge badge-success navbar-badge">{{ $order->where('status', 0)->count() }}</div>
            @endif
          </div>
          <div id="newTree" class="panel-collapse in collapse" style="">
            <div class="card-body">
              <div class="table-responsive">
                <table id="list" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th style="width: 10px">#</th>
                    <th style="width: 100px">@lang('menu.receiver')</th>
                    <th style="width: 10px">@lang('menu.nominal')</th>
                    <th style="width: 10px">@lang('menu.amount')</th>
                    <th style="width: 10px">@lang('menu.action')</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($order->where('status', 0) as $item)
                    <tr class="text-center">
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                      <td>Rp {{ number_format($item->total * 1500000, 0, ',', '.') }}</td>
                      <td>{{ $item->total }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('tree.update', [base64_encode($item->id), base64_encode(1)]) }}"
                             class="btn btn-sm btn-success">
                            @lang('menu.accept')
                          </a>
                          <a href="{{ route('tree.update', [base64_encode($item->id), base64_encode(2)]) }}"
                             class="btn btn-sm btn-danger">
                            @lang('menu.cancel')
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card-header">
            <button type="button" class="btn btn-block btn-primary btn-xs collapsed" data-toggle="collapse"
                    data-parent="#accordion" href="#tree" aria-expanded="false">
              @lang('menu.Porang List Already Processed')
            </button>
          </div>
          <div id="tree" class="panel-collapse in collapse" style="">
            <div class="card-body">
              <div class="table-responsive">
                <table id="list2" class="table table-sm table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th style="width: 10px">#</th>
                    <th style="width: 100px">@lang('menu.receiver')</th>
                    <th style="width: 10px">@lang('menu.nominal')</th>
                    <th style="width: 10px">@lang('menu.amount')</th>
                    <th style="width: 10px">@lang('menu.date')</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($order->where('status', '!=', 0) as $item)
                    <tr class="text-center">
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                      <td>Rp {{ number_format($item->total * 1500000, 0, ',', '.') }}</td>
                      <td>{{ $item->total }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s') }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card card-outline card-teal">
        <div class="card-header">
          <h3 class="card-title">@lang('menu.list') @lang('menu.Porang')</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="list3" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width: 5px">#</th>
                <th style="width: 50px">@lang('menu.receiver')</th>
                <th style="width: 10px">QR</th>
                <th style="width: 10px">Gallery</th>
                <th>Code</th>
                <th style="width: 50px">@lang('menu.send')</th>
                <th style="width: 50px">Lokasi</th>
                <th style="width: 100px">@lang('menu.yield')</th>
                <th style="width: 5px">Status</th>
              </tr>
              </thead>
              <tbody>
              @foreach($tree as $item)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $item->user ? $item->user->username : 'Belum Terpakai' }}</td>
                  <td>
                    <a href="{{ route('tree.QRCode', base64_encode($item->id)) }}"
                       class="btn btn-block btn-outline-secondary btn-xs" target="_blank">
                      QR
                    </a>
                  </td>
                  <td>
                    <button type="button" class="btn btn-block btn-outline-info btn-xs" data-toggle="modal"
                            data-target="#modal-gallery{{ $item->code }}">
                      Gallery
                    </button>
                  </td>
                  <td>{{ $item->code }}</td>
                  <td>{{ $item->start }}</td>
                  <td>
                    <button type="button" class="btn btn-block btn-outline-info btn-xs" data-toggle="modal"
                            data-target="#modal-map{{ $item->code }}">
                      Set Lokasi
                    </button>
                  </td>
                  @if($item->yield)
                    <td>Rp {{ number_format($item->yield, 0, ',', '.') }}</td>
                  @else
                    <td>
                      <button type="button" class="btn btn-block btn-success btn-xs" data-toggle="modal"
                              data-target="#modal-yild{{ $item->code }}">
                        Panen
                      </button>
                    </td>
                  @endif
                  <td>{{ $item->status }}</td>
                </tr>
                <div class="modal fade" id="modal-gallery{{ $item->code }}">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content bg-teal">
                      <div class="modal-header">
                        <h4 class="modal-title">Gallery</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          &times;
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('tree.uploadToGallery', base64_encode($item->id)) }}" method="POST"
                              enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="count">Add New Image</label>
                            <input type="file" class="form-control" placeholder="img" name="img">
                          </div>
                          <button type="submit" class="btn btn-outline-light btn-block">@lang('menu.accept')</button>
                        </form>
                        <hr>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                            @foreach($item->gallery as $indexId => $itemGallery)
                              <div class="carousel-item @if($indexId == 0) active @endif">
                                <img class="d-block w-100" src="{{ $itemGallery->image }}" style="height: 400px"
                                     alt="img">
                              </div>
                            @endforeach
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                             data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                             data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-yild{{ $item->code }}">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content bg-teal">
                      <div class="modal-header">
                        <h4 class="modal-title">@lang('menu.yield')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          &times;
                        </button>
                      </div>
                      <form action="{{ route('tree.harvest', base64_encode($item->id)) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                          <label for="yiled">Input Hasil Panen</label>
                          <div class="input-group mb-3">
                            <div class="input-group-append">
                              <span class="input-group-text bg-teal">Rp</span>
                            </div>
                            <input type="number" class="form-control" name="yiled">
                            <div class="input-group-append">
                              <span class="input-group-text bg-teal">.00</span>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <div type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</div>
                          <button type="submit" class="btn btn-outline-light">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-map{{ $item->code }}">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-teal">
                      <div class="modal-header">
                        <h4 class="modal-title">Set Lokasi Barcode</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          &times;
                        </button>
                      </div>
                      <form action="{{ route('tree.storeMap', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                          <input type="text" id="long{{ $item->code }}" name="long" class="form-control"
                                 data-type="address" value="-6.249776" hidden/>
                          <input type="text" id="lat{{ $item->code }}" name="lat" class="form-control"
                                 data-type="address" value="106.813202" hidden/>
                          <div class="map-container">
                            <div id="map{{ $item->code }}" data-type="map" style="height: 300px"></div>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline-light"
                                  data-dismiss="modal">@lang('menu.cancel')</button>
                          <button type="submit" class="btn btn-outline-light">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <h4 class="modal-title">@lang('menu.create a Porang')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            &times;
          </button>
        </div>
        <form action="{{ route('tree.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="count">@lang('menu.amount') Porang</label>
              <input type="text" class="form-control" placeholder="Jumlah Porang" name="count">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">@lang('menu.cancel')</button>
            <button type="submit" class="btn btn-outline-light">@lang('menu.accept')</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-list">
    <div class="modal-dialog modal-sm">
      <div class="modal-content bg-teal">
        <div class="modal-header">
          <h4 class="modal-title">@lang('menu.print Barcode')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            &times;
          </button>
        </div>
        <form action="{{ route('tree.QRCodeList') }}" method="POST" target="_blank">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="count">@lang('menu.amount') QR</label>
              <input type="text" class="form-control" placeholder="Jumlah Porang" name="count">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">@lang('menu.cancel')</button>
            <button type="submit" class="btn btn-outline-light">@lang('menu.accept')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('endCSS')
  <!-- Map -->
  <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.6.0/dist/leaflet.css') }}"/>

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/toastr/toastr.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('end/back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('endJS')
  <!-- Map -->
  <script src="{{ url('https://unpkg.com/leaflet@1.6.0/dist/leaflet.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ asset('end/back/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('end/back/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('end/back/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('end/back/plugins/toastr/toastr.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('end/back/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
      $(function () {
          $("#list").DataTable();
          $("#list2").DataTable();
          $("#list3").DataTable();
          $('.select2').select2({
              theme: "classic"
          });
          const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000
          });
        @error('user')
        Toast.fire({
            type: 'error',
            title: '{{ $message }}'
        });
        @enderror
        @error('count')
        Toast.fire({
            type: 'error',
            title: '{{ str_replace('count', 'jumlah', $message) }}'
        });
        @enderror
        @error('img')
        Toast.fire({
            type: 'error',
            title: '{{ $message }}'
        });
        @enderror
        @error('yiled')
        Toast.fire({
            type: 'error',
            title: '{{ $message }}'
        });
        @enderror
        @error('long')
        Toast.fire({
            type: 'error',
            title: '{{ $message }}'
        });
        @enderror
        @error('lat')
        Toast.fire({
            type: 'error',
            title: '{{ $message }}'
        });
        @enderror

        @foreach($tree as $item)
        generateMap("{{ $item->code }}", "{{ $item->x_fild ? $item->x_fild : -6.249776 }}", "{{ $item->y_fild ? $item->y_fild : 106.813202 }}");
        @endforeach
      });

      function generateMap(valueNameMap, long, lat) {
          let mymap = L.map("map" + valueNameMap).setView([long, lat], 8);
          let marker = L.marker([long, lat], {
              draggable: true, autoPan: true
          });
          marker.addTo(mymap);
          L.tileLayer(
              "https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWVubWE5NzciLCJhIjoiY2s4MDB2Z2N5MGJvcTNlcnUzczh1ZjBkbiJ9.EpC5l4fOYB3YK-OMbUcFzA",
              {
                  attribution:
                      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                  maxZoom: 18,
                  id: "mapbox/streets-v11",
                  tileSize: 512,
                  zoomOffset: -1,
                  accessToken: "pk.eyJ1IjoibWVubWE5NzciLCJhIjoiY2s4MDB2Z2N5MGJvcTNlcnUzczh1ZjBkbiJ9.EpC5l4fOYB3YK-OMbUcFzA"
              }
          ).addTo(mymap);
          marker.on("move", (e) => {
              let longLat = e.latlng.toString().substr(6);
              document.querySelector("#long" + valueNameMap).value = longLat.split(",")[0].replace("(", "");
              document.querySelector("#lat" + valueNameMap).value = longLat.split(",")[1].replace(")", "");
          });
          mymap.on("click", e => {
              marker.setLatLng(e.latlng);
          });
      }
  </script>
@endsection
