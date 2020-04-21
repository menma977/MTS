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

      @error('name')
      <div class="text-danger" role="alert">
        <small>{{ $message }}</small>
      </div>
      @enderror
      <div class="card-body">
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ $user->name }}">
          </div>
        </div>

        @error('username')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="username"
                   value="{{ $user->username }}">
          </div>
        </div>

        @error('email')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="email"
                   value="{{ $user->email }}">
          </div>
        </div>

        @error('password')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">
            Password <small>Kosongkan jika tidak di ubah</small>
          </label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>

        @error('id_identity_card')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Nomor KTP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="id_identity_card" name="id_identity_card"
                   placeholder="Nomor KTP" value="{{ $user->id_identity_card }}">
          </div>
        </div>

        @error('phone')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Nomor Telfon</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telfon"
                   value="{{ $user->phone }}">
          </div>
        </div>

        @error('bank')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">BANK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="bank" name="bank" placeholder="BANK" value="{{ $user->bank }}">
          </div>
        </div>

        @error('pin_bank')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Nomor Rekening</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pin_bank" name="pin_bank" placeholder="Nomor Rekening"
                   value="{{ $user->pin_bank }}">
          </div>
        </div>

        @error('address')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address" placeholder="Alamat"
                   value="{{ $user->address }}">
          </div>
        </div>
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