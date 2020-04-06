@extends('layouts.android')

@section('content')
  <div class="card card-outline card-teal">
    <div class="card-header">
      <h3 class="card-title">{{ $tree->code }}</h3>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($tree->gallery as $item)
          <div class="col-4">
            <a href="{{ $item->image }}" data-toggle="lightbox" data-title="{{ $item->created_at }}"
               data-gallery="gallery" data-max-width="600" data-max-height="600">
              <img src="{{ $item->image }}" class="mb-2 img-fluid" alt="img"/>
            </a>
          </div>
        @endforeach
      </div>
    </div>
    <div class="card-footer">
      <a href="{{ route('generateDatas', mt_rand().'.'.(($item->tree_id + 10) - 5).'.'.mt_rand().'.'.mt_rand()) }}">
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Dapatkat sertifikat(PDF)
        </button>
      </a>
    </div>
  </div>
@endsection

@section('endCSS')
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('end/back/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('endJS')
  <!-- Ekko Lightbox -->
  <script src="{{ asset('end/back/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
  <script>
      $(function () {
          $(document).on('click', '[data-toggle="lightbox"]', function (event) {
              event.preventDefault();
              $(this).ekkoLightbox({
                  alwaysShowClose: true,
              });
          });
      });
  </script>
@endsection