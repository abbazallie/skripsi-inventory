@extends('layouts.master')
@section('sub-judul','Edit User')

@section('content')
<div class="section-body">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ $message }}
        </div>
      </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                  <div class="form-group col-6">
                    <label for="first_name">Nama</label>
                    <input name="nama"  id="first_name" type="text" value="{{ old('kode_brg', $user->nama) }} class="form-control @error('nama') is-invalid @enderror" >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group col-6">
                    <label for="last_name">Username</label>
                    <input name="username" id="last_name" type="text" value="{{ old('kode_brg', $user->username) }} class="form-control @error('nama') is-invalid @enderror">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input name="password" value="{{ $user->level }}" id="password" type="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="form-group col-6">
                    <label>Level</label>
                    <select class="form-control selectric @error('level') is-invalid @enderror" name="level">
                        <option>-- Pilih --</option>
                      <option value="{{ $user->level }}">Indonesia</option>
                      <option>Palestine</option>
                    </select>
                    @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                </div>
                <div class="form-group">
                    <a href="{{ route('user.index') }}" class="btn btn-dark">
                        <i class="fas fa-arrow-circle-left"></i> Kembali 
                            <span class="badge badge-transparent btn-icon icon-left"></span>
                    </a>
                  <button type="submit" class="btn btn-light btn-lg btn-block">
                    Simpan
                  </button>
                </div>
          </form>
    </div>
</div>

@endsection


