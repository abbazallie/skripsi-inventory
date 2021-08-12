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
            <form action="{{ route('borrower.store') }}" method="POST">
                @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nb">Nama Peminjam</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Keterangan kerusakan" id="nb" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="form-group col-md-4">
                    <label>Nama Barang</label>
                    <select id="selectItem" class="form-control form-control-sm @error('item_id') is-invalid @enderror" name="item_id">
                    <option value="">--Pilih--</option>
                    @foreach ($items as $brg)
                        <option value="{{ $brg->id }}" {{ old('item_id') == $brg->id ? 'selected' : null}}
                            data-amount="{{$brg->getStock()}}"
                            data-place="{{ $brg->place->name }}"
                            />
                            {{ $brg->name }}
                        </option>
                    @endforeach
                    </select>
                    @error('item_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4" id="colPlace">
                    <label>Ruang/Tempat</label>
                    <input type="text" name="tempat_brg" disabled class="form-control" id="place" value="">
                </div>

                <div class="form-group col-md-2">
                    <label>Jumlah Barang</label>
                        <input type="number" class="form-control" id="itemStock"  disabled="">
                    </div>
                <div class="form-group col-md-2">
                    <label for="qty">Jumlah Peminjaman</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"  placeholder="Jumlah Barang" id="qty" value="{{ old('amount',0) }}">
                        @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>  
                    <div class="form-group col-md-5">
                        <label>Tanggal Peminjaman</label>
                        <input name="borrow_date" type="date" class="form-control @error('borrow_date') is-invalid @enderror"  value="{{ old('borrow_date') }}">
                        @error('borrow_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>         
                <div class="form-group col-md-12">
                <label for="nb">Keterangan</label>
                    <input type="text" name="notes" class="form-control @error('notes') is-invalid @enderror" placeholder="Keterangan pinjam" id="nb" value="{{ old('notes') }}">
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            
            </div>
            <div class="card-footer">
            <a href="{{ route('borrower.index') }}" class="btn btn-dark">
                <i class="fas fa-arrow-circle-left"></i> Kembali 
                    <span class="badge badge-transparent btn-icon icon-left"></span>
            </a>
            <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $("#selectItem").on('change',function () {
                $("#place").val($(this).find(":selected").data('place'));
                $("#itemStock").val($(this).find(":selected").data('amount'));
                $("#qty").attr('max',$(this).find(":selected").data('amount'));
            });
        });
    </script>
@endpush


