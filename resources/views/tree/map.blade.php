@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Atur Denah Barocde</h1>
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
        <li class="breadcrumb-item">
          Set Map
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="card card-outline card-teal">
    <form class="form-horizontal" action="{{ route('tree.storeMap', $tree->id) }}" method="POST">
      @csrf
      <div class="card-body">
        <input type="text" id="long" name="long" class="form-control" data-type="address" value="-6.249776" hidden/>
        <input type="text" id="lat" name="lat" class="form-control" data-type="address" value="106.813202" hidden/>
        <div class="form-group">
          <div class="map-container">
            <div id="map" data-type="map" style="height: 300px"></div>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-info">Simpan</button>
      </div>
    </form>
  </div>
@endsection

@section('endCSS')
  <!-- Map -->
  <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.6.0/dist/leaflet.css') }}"/>
@endsection

@section('endJS')
  <!-- Map -->
  <script src="{{ url('https://unpkg.com/leaflet@1.6.0/dist/leaflet.js') }}"></script>

  <script>
    $(function () {
      generateMap("{{ $tree->x_fild ? $tree->x_fild : -6.249776 }}", "{{ $tree->y_fild ? $tree->y_fild : 106.813202 }}")
    });

    function generateMap(long, lat) {
      let mymap = L.map("map").setView([long, lat], 8);
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
        document.querySelector("#long").value = longLat.split(",")[0].replace("(", "");
        document.querySelector("#lat").value = longLat.split(",")[1].replace(")", "");
      });
      mymap.on("click", e => {
        marker.setLatLng(e.latlng);
      });
    }
  </script>
@endsection