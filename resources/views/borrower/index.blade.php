@extends('layouts.master')
@section('sub-judul','Data Peminjaman')
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
                <a href="{{ route('borrower.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus-circle"></i> Tambah Peminjam 
                    <span class="badge badge-transparent btn-icon icon-right"></span>
                </a>
            </div>
            <table class="table table-md table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Peminjam</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Ruang/Tempat</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal Peminjamn</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowers as $pjm)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <th scope="row">{{ $pjm->contact->name }}</th>
                    <th scope="row">{{ $pjm->item->name }}</th>
                    <th scope="row">{{ $pjm->item->place->name }}</th>
                    <td scope="row">{{ $pjm->amount }}</td>
                    <td scope="row">{{ Carbon\Carbon::create($pjm->borrow_date)->format('d M Y') }}</td>
                    <td scope="row">{{ $pjm->borrow_notes }}</td>
                    <td scope="row">
                        <form action="{{ route('borrower.destroy', $pjm->id) }}" method="POST">
                        <a href="{{ route('borrower.edit', $pjm->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"></i>Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {{ $borrowers->links() }}
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
