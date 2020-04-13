@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Edit Password</h1>
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
          @lang('menu.user.edit') Password
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="card card-teal">
    <div class="card-header">
      <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <form class="form-horizontal" action="{{ route('user.updatePassword', $user->id) }}" method="post">
      @csrf
      <div class="card-body">
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>
        @error('password')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-success">Sign in</button>
        <a href="{{ route('user.index') }}" class="btn btn-default float-right">
          Cancel
        </a>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
@endsection