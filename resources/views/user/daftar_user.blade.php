@extends('layouts.master')
@section('sub-judul','Administrator')
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
                <a href="{{ route('user.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus-circle"></i> Tambah User 
                    <span class="badge badge-transparent btn-icon icon-right"></span>
                </a>
            </div>
            <div class="text-center">
                <h4> Daftar Administrator</h4>
            </div>
            <table class="table table-md table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($user as $use)
              <tr>
                  <th scope="row">{{ ++$i }}</th>
                  <th scope="row">{{ $use->nama }}</th>
                  <th scope="row">{{ $use->username }}</th>
                  <td scope="row">{{ $use->level }}</td>
                  <td scope="row">
                      <form action="{{ route('user.destroy', $use->id) }}" method="POST">
                      <a href="{{ route('user.edit', $use->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
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
          {{ $user->links() }}
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
