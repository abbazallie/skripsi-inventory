@extends('layouts.master')
@section('sub-judul','Asset Rusak')
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
            <div>
                <a href="{{ route('kerusakan.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus-circle"></i> Tambah Barang 
                    <span class="badge badge-transparent btn-icon icon-right"></span>
                </a>
            </div>
            <div class="text-center">
                <h4> Data Kerusakan Inventaris Barang SMA Darunnajah</h4>
            </div>
            <table class="table table-md table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Ruang/Tempat</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal Pendataan</th>
                <th scope="col">Keterangan Kerusakan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($barangRusak as $rsk)
              <tr>
                  <th scope="row">{{ ++$i }}</th>
                  <th scope="row">{{ $rsk->barang->nama_brg }}</th>
                  <th scope="row">{{ $rsk->barang->tempat_brg }}</th>
                  <td scope="row">{{ $rsk->jml_brg }}</td>
                  <td scope="row">{{ $rsk->tgl_rsk }}</td>
                  <td scope="row">{{ $rsk->keterangan }}</td>
                  <td scope="row">
                      <form action="{{ route('kerusakan.destroy', $rsk->id) }}" method="POST">
                      <a href="{{ route('kerusakan.edit', $rsk->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
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
          {{ $barangRusak->links() }}
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
