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
          <a href="{{ route('user.show', base64_encode($user->id)) }}">
            @lang('menu.user.index')
          </a>
        </li>
        <li class="breadcrumb-item">
          @lang('menu.user.edit')
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')

@endsection