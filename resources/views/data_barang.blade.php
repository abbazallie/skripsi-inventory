@extends('layouts.master')
@push('library-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.min.css')}}">
@endpush
@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <p class="card-text">Data Barang</p>
        </div>
    </div>
</div>

@endsection
@push('library-js')
    <script type="text/javascript" charset="utf8" src="{{asset('assets/js/datatables.min.js')}}"></script>
@endpush
@push('after-scripts')
    <script>

    </script>
@endpush
