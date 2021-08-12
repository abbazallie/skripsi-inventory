@extends('layouts.master')
@section('sub-judul','Data Asset')
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
            <div class="mb-3">
                <a href="{{ route('item.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus-circle"></i> Tambah Barang 
                    <span class="badge badge-transparent btn-icon icon-right"></span>
                </a>
            </div>
            <table class="table table-md table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Ruang/Tempat</th>
                        <th scope="col">Tanggal Pendataan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $brg)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th scope="row">{{ $brg->code }}</th>
                        <th scope="row">{{ $brg->name }}</th>
                        
                        <td scope="row">{{ $brg->category->name ?? '' }}</td>
                        
                        <td scope="row">{{ $brg->getStock() }}</td>
                        <td scope="row">{{ $brg->place->name }}</td>
                        <td scope="row">{{ Carbon\Carbon::create($brg->date_in)->format('d M Y') }}</td>
                        <td scope="row">
                            <form action="{{ route('item.destroy', $brg->id) }}" method="POST">
                            <a href="{{ route('item.edit', $brg->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
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
            {{ $barang->links() }}
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
