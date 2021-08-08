@extends('layouts.master')
@section('sub-judul','Tambah Barang')

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
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                <label for="kd">Kode Barang</label>
                    <input type="text" name="kode_brg" class="form-control @error('kode_brg') is-invalid @enderror" id="kd" placeholder="Kode Barang" value="{{ old('kode_brg') }}">
                    @error('kode_brg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                <label for="nb">Nama Barang</label>
                    <input type="text" name="nama_brg" class="form-control @error('nama_brg') is-invalid @enderror" placeholder="Nama Barang" id="nb" value="{{ old('nama_brg') }}">
                    @error('nama_brg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label>Kategori</label>
                    <select class="form-control form-control-sm @error('kategori_id') is-invalid @enderror" name="kategori_id">
                    <option value="">--Pilih--</option>
                    @foreach ($kategori as $ktg)
                        <option value="{{ $ktg->id }}" {{ old('kategori_id') == $ktg->id ? 'selected' : null}}>{{ $ktg->nama_kategori }}</option>
                    @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                <label for="jm">Jumlah</label>
                    <input type="number" name="jml_brg" class="form-control @error('jml_brg') is-invalid @enderror"  placeholder="Jumlah Barang" id="jm" value="{{ old('jml_brg') }}">
                    @error('jml_brg')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group col-md-5">
                <label for="ru">Ruang/Tempat</label>
                    <input type="text" name="tempat_brg" class="form-control @error('tempat_brg') is-invalid @enderror" placeholder="Ruang atau tempat" id="ru" value="{{ old('tempat_brg') }}">
                    @error('tempat_brg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label>Tanggal Pendataan</label>
                    <input name="tgl_masuk" type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"  value="{{ old('tgl_masuk') }}">
                    @error('tgl_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            </div>
            <div class="card-footer">
            <a href="{{ route('barang.index') }}" class="btn btn-dark">
                <i class="fas fa-arrow-circle-left"></i> Kembali 
                    <span class="badge badge-transparent btn-icon icon-left"></span>
            </a>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection


