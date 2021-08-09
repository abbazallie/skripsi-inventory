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
                <form action="{{ route('tampil')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                          <select name="id" class="custom-select @error('') is-invalid @enderror" id="inputGroupSelect04">
                            <option value="">Choose...</option>
                            @foreach ($barang as $brg)
                                <option value="{{ $brg->id }}" {{  old('id') == $brg->id ? 'selected' :null }} >{{ $brg->nama_brg }}</option>
                            @endforeach
                          </select>
                          @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Pilih</button>
                          </div>
                        </div>
                      </div>
                      {{--  --}}
                </form>
            </div>
        </div>
    </div>
    
   
</div>

@endsection


