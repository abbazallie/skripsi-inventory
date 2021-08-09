@extends('layouts.master')
@section('sub-judul','Tambah User')

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
                @csrf
                <div class="row">
                  <div class="form-group col-6">
                    <label for="first_name">Nama</label>
                    <input name="nama"  id="first_name" type="text" class="form-control @error('nama') is-invalid @enderror" >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group col-6">
                    <label for="last_name">Username</label>
                    <input name="username" id="last_name" type="text" class="form-control @error('username') is-invalid @enderror">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                  <div class="form-group col-6">
                    <label>Level</label>
                    <select name="level" class="form-control selectric @error('level') is-invalid @enderror" >
                        <option>-- Pilih --</option>
                      <option>Admin</option>
                      <option>Kepala sekolah</option>
                    </select>
                    @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('user.index') }}" class="btn btn-dark">
                        <i class="fas fa-arrow-circle-left"></i> Kembali 
                            <span class="badge badge-transparent btn-icon icon-left"></span>
                    </a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
          </form>
    </div>
</div>

@endsection


