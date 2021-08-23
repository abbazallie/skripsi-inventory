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
            <div>
                <form action="{{ route('damage.update',$damage->id)}}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Pilih Barang</label>
                                <select name="item_id" class="custom-select @error('') is-invalid @enderror" id="selectItem">
                                    <option value="">Choose...</option>
                                    @foreach ($items as $brg)
                                        <option
                                            data-name="{{ $brg->name }}"
                                            data-place="{{ $brg->place->name }}"
                                            data-amount="{{ $brg->getStock()}}"
                                            value="{{ $brg->id }}" {{  old('id',$damage->item_id) == $brg->id ? 'selected' :null }} >{{ $brg->name }}</option>
                                    @endforeach
                                </select>
                                @error('id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4" id="colItemAmount">
                            <div class="form-group">
                                <label for="">Stok Item</label>
                                <input type="text" id="itemAmount" disabled value="{{ $damage->item->getStock() }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4" id="colItemPlace">
                            <div class="form-group">
                                <label for="">Nama Tempat</label>
                                <input type="text" id="itemPlace" disabled value="{{ $damage->item->place->name }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-6 form-group">
                            <label for="">Masukkan jumlah rusak</label>
                            <input type="number" name="amount" min="0" max="{{ $damage->item->getStock() + $damage->amount }}" class="form-control @error('amount') is-invalid @enderror"  placeholder="Jumlah Barang" id="jm" value="{{ old('amount',$damage->amount) }}">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="date">Tanggal rusak</label>
                            <input type="date" name="damage_date" class="form-control @error('damage_date') is-invalid @enderror"  placeholder="Tangga rusak" id="date" value="{{ old('damage_date',$damage->damage_date) }}">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Keterangan / Catatan</label>
                            <textarea name="notes" id="" style="height: 100px" class="form-control">{{ $damage->notes }}</textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
   
</div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            $("#selectItem").on('change', function () {
                $("#colItemAmount").show();
                $("#itemAmount").val($(this).find(':selected').data('amount'));

                $("#colItemPlace").show();
                $("#itemPlace").val($(this).find(':selected').data('place'));
            });
        });
    </script>
@endpush




