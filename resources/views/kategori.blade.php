@extends('layouts.master')
@section('sub-judul','Kategori')
@push('library-styles')
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
    <div class="card">
        <div class="card-body">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5>Tambah Kategori</h5>
                </div>
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Nama kategori" aria-label="">
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                          </div>
                          @error('nama_kategori')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <div class="text-center">
                    <h4> Daftar Kategori Barang </h4>
                </div>
                <table class="table table-md table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $ktg)
                  <tr>
                      <th scope="row">{{ ++$i }}</th>
                      <td scope="row">{{ $ktg->nama_kategori }}</td>
                      <td scope="row">
                          <form action="{{ route('kategori.destroy', $ktg->id) }}" method="POST">
                          <a href="{{ route('kategori.edit', $ktg->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
                            |
                            @csrf
                            @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"></i>Hapus</button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $kategori->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@push('library-js')
@endpush
@push('after-scripts')
    <script>

    </script>
@endpush
