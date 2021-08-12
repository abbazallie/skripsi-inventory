@extends('layouts.master')
@section('sub-judul','Tambah Barang')
@push('library-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
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

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('item.store') }}" method="POST">
                @csrf
            <div class="form-row">
                {{-- <div class="form-group col-md-3">
                    <label for="kd">Kode Barang</label>
                    <input type="text" name="kode_brg" class="form-control @error('kode_brg') is-invalid @enderror" id="kd" placeholder="Kode Barang" value="{{ old('kode_brg') }}">
                    @error('kode_brg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="form-group col-md-6">
                <label for="nb">Nama Barang</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Barang" id="nb" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label>Kategori</label>
                    <select class="form-control form-control-sm @error('category_id') is-invalid @enderror" name="category_id">
                    <option value="">--Pilih--</option>
                    @foreach ($categories as $ktg)
                        <option value="{{ $ktg->id }}" {{ old('category_id') == $ktg->id ? 'selected' : null}}>{{ $ktg->name }}</option>
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
                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"  placeholder="Jumlah Barang" id="jm" value="{{ old('amount') }}">
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group col-md-5">
                <label for="ru">Ruang/Tempat</label>
                    {{-- <input type="text" name="place_id" class="form-control @error('place_id') is-invalid @enderror" placeholder="Ruang atau tempat" id="ru" value="{{ old('place_id') }}"> --}}
                    <select name="place_id" id="selectPlace" class="form-control form-control-sm"  @error('place_id') is-invalid @enderror" name="place_id">
                        @foreach (App\Models\Place::all() as $place)
                            <option value="{{ $place->id }}" {{ old('place_id') == $place->id ? 'selected' : null}}>{{ $place->name }}</option>
                        @endforeach
                    </select>
                    @error('place_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label>Tanggal Pendataan</label>
                    <input name="date_in" type="date" class="form-control @error('date_in') is-invalid @enderror"  value="{{ old('date_in') }}">
                    @error('date_in')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            </div>
            <div class="card-footer">
            <a href="{{ route('item.index') }}" class="btn btn-dark">
                <i class="fas fa-arrow-circle-left"></i> Kembali 
                    <span class="badge badge-transparent btn-icon icon-left"></span>
            </a>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#selectPlace').select2({
                'tags' : true
            });
        });
    </script>
@endpush
@endsection


