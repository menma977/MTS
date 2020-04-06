@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>@lang('menu.user.index')</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">
          <a href="{{ route('home') }}">
            @lang('menu.home')
          </a>
        </li>
        <li class="breadcrumb-item">
          Banner
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title">Infromasi yang berjalan</h3>
        </div>
        <div class="card-body">
          <div class="callout callout-success">
            @if($banner)
              <h5>{{ $banner->title }}</h5>
              <p>{{ $banner->description }}</p>
            @else
              <h5>Kosong</h5>
              <p>Kosong</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title">Buat Banner Infromasi Baru</h3>
        </div>
        <form action="{{ route('banner.store') }}" method="post">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="title">Judul</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                     placeholder="Judul">
            </div>
            @error('title')
            <div class="text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror

            <div class="form-group">
              <label for="description">Deksirpis</label>
              <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description" rows="3"
                        placeholder="Deksirpis..."></textarea>
            </div>
            @error('description')
            <div class="text-danger" role="alert">
              <small>{{ $message }}</small>
            </div>
            @enderror

          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">Submit</button>
            <a href="{{ route('banner.delete') }}" class="btn btn-danger float-right btn-sm">Hapus</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection