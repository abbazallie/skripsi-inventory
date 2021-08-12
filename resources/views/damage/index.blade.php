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
                <a href="{{ route('damage.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus-circle"></i> Tambah Barang 
                    <span class="badge badge-transparent btn-icon icon-right"></span>
                </a>
            </div>
            <table class="table table-md table-hover mt-3">
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
                    @foreach ($damages as $rsk)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th scope="row">{{ $rsk->item->name ?? '' }}</th>
                        <th scope="row">{{ $rsk->item->place->name ?? '' }}</th>
                        <td scope="row">{{ $rsk->amount }}</td>
                        <td scope="row">{{ $rsk->damage_date }}</td>
                        <td scope="row">{{ $rsk->notes }}</td>
                        <td scope="row" class="d-inline-flex">
                            <a href="{{ route('damage.edit', $rsk->id) }}" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i>Edit</a>
                            {{-- <a href="{{ route('damage.edit', $rsk->id) }}" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i>Sudah Normal</a> --}}
                            <form action="{{ route('damage.destroy', $rsk->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"></i>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $damages->links() }}
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
