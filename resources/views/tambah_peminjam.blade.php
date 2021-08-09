@extends('layouts.master')
@section('sub-judul','Tambah Peminjam')

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
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nb">Nama Peminjam</label>
                        <input type="text" name="nama_pjm" class="form-control @error('nama_pjm') is-invalid @enderror" placeholder="Keterangan kerusakan" id="nb" value="{{ old('nama_pjm') }}">
                        @error('nama_pjm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="form-group col-md-4">
                    <label>Nama Barang</label>
                    <select class="form-control form-control-sm @error('barang_id') is-invalid @enderror" name="kategori_id">
                    <option value="">--Pilih--</option>
                    @foreach ($barang as $brg)
                        <option value="{{ $brg->id }}" {{ old('barang_id') == $brg->id ? 'selected' : null}}>{{ $brg->nama_brg }}</option>
                    @endforeach
                    </select>
                    @error('barang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="nb">Ruang/Tempat</label>
                        <input type="text" name="tempat_brg" class="form-control @error('keterangan') is-invalid @enderror" id="nb" value="{{ old('keterangan') }}">
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group col-md-2">
                    <label>Jumlah Barang</label>
                        <input type="number" class="form-control" value="{{ $brg->jml_brg }}"  disabled="">
                    </div>
                <div class="form-group col-md-2">
                    <label for="jm">Jumlah Peminjaman</label>
                        <input type="number" name="jml_pjm" class="form-control @error('jml_pjm') is-invalid @enderror"  placeholder="Jumlah Barang" id="jm" value="{{ old('jml_pjm') }}">
                        @error('jml_pjm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>  
                    <div class="form-group col-md-5">
                        <label>Tanggal Peminjaman</label>
                        <input name="tgl_pjm" type="date" class="form-control @error('tgl_pjm') is-invalid @enderror"  value="{{ old('tgl_pjm') }}">
                        @error('tgl_pjm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>         
                <div class="form-group col-md-12">
                <label for="nb">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan kerusakan" id="nb" value="{{ old('keterangan') }}">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            
            </div>
            <div class="card-footer">
            <a href="{{ route('peminjaman.index') }}" class="btn btn-dark">
                <i class="fas fa-arrow-circle-left"></i> Kembali 
                    <span class="badge badge-transparent btn-icon icon-left"></span>
            </a>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection


