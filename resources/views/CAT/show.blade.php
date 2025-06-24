@extends('layouts.main')

@section('page-title', 'Detail Data CAT')
@section('breadcrumb')
    <li><a href="{{ route('cat.index') }}">Data CAT</a></li>
    <li class="active">Detail</li>
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Detail Data CAT</h3>

                    <table class="table table-bordered">
                        <tr><th>Data CAT</th><td>{{ $cat->is_cat }}</td></tr>
                        <tr><th>Departemen</th><td>{{ $cat->departemen }}</td></tr>
                        <tr><th>Penyelidikan</th><td>{{ $cat->penyelidikan ?? '-' }}</td></tr>
                        <tr><th>Perbaikan</th><td>{{ $cat->perbaikan ?? '-' }}</td></tr>
                        <tr><th>Rencana</th><td>{{ $cat->rencana ?? '-' }}</td></tr>
                        <tr><th>Verifikator</th><td>{{ $cat->verifikator }}</td></tr>
                        <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($cat->tanggal)->format('d/m/Y') }}</td></tr>
                    </table>

                    <a href="{{ route('cat.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
