@extends('layouts.master')
@section('sub-judul','Tambah Barang')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('simpan'),$barang->id }}" method="POST">
                @method('PUT')
                @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nb">Nama Barang</label>
                        <input type="text" name="nama_brg"  value="{{ $barang->nama_brg }}" class="form-control @error('nama_brg') is-invalid @enderror"  id="nb" >
                        @error('nama_brg')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="form-group col-md-4">
                    <label for="nb">Ruang/Tempat</label>
                        <input type="text" name="tempat_brg" value="{{ old('tempat_brg',$barang->tempat_brg) }}" class="form-control @error('tempat_brg') is-invalid @enderror"  id="nb">
                        @error('tempat_brg')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                <div class="form-group col-md-2">
                    <label>Jumlah Barang</label>
                        <input type="number" class="form-control" value="{{ $barang->jml_brg }}"  disabled="">
                    </div>
                <div class="form-group col-md-2">
                    <label for="jm">Jumlah Rusak</label>
                        <input type="number" name="jml_brg_rsk" class="form-control @error('jml_brg') is-invalid @enderror"  placeholder="Jumlah Barang" id="jm" value="{{ old('jml_brg') }}">
                        @error('jml_brg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>  
                    <div class="form-group col-md-3">
                        <label>Tanggal Pendataan</label>
                        <input name="tgl_rsk" type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"  value="{{ old('tgl_masuk') }}">
                        @error('tgl_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>         
                <div class="form-group col-md-9">
                <label for="nb">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan kerusakan" id="nb" value="{{ old('keterangan') }}">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="card-footer">
                    <a href="{{ route('kerusakan.index') }}" class="btn btn-dark">
                        <i class="fas fa-arrow-circle-left"></i> Kembali 
                            <span class="badge badge-transparent btn-icon icon-left"></span>
                    </a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection