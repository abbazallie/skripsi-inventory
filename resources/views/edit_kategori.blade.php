@extends('layouts.master')
@section('sub-judul','Kategori')

@section('content')
<div class="section-body">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
            <strong>Edit Gagal</strong> Maaf ada kesalahan saat input data<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            
            <div class="col-md-6">
                <div class="mb-3">
                    <h5>Nama Kategori</h5>
                </div>
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                          <div class="input-group mb-3">
                            <input type="text" name="nama_kategori"  value="{{ $kategori->nama_kategori }}" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Nama kategori" aria-label="">
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">Edit</button>
                            </div>
                            @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                    </div>
                </form>
            </div>
            <div>
                <a href="{{ route('kategori.index') }}" class="btn btn-dark">
                    <i class="fas fa-arrow-circle-left"></i> Kembali 
                    <span class="badge badge-transparent btn-icon icon-left"></span>
                </a>
              </div>
        </div>
    </div>
</div>

@endsection


