@extends('layouts.main')

@section('page-title', 'Tema Audit')
@section('breadcrumb')
    <li><a href="{{ url('tema') }}">Tema Audit</a></li>
    <li class="active">Tambah Tema Audit</li>
@endsection

@section('content')
    <div class="main-content-inner">

        <div class="d-flex justify-content-center row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white">
                        <h2>Tambah Tema</h2>
                    </div>
                    <div class="card-body">
                        <form id="tema_form" action="{{ route('tema.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_tema" class="form-label">Nama tema <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_tema"
                                    class="form-control {{ $errors->first('nama_tema') ? 'is-invalid' : '' }}" required
                                    id="nama_tema" placeholder="Masukkan Nama Tema">
                            </div>
                            @if ($errors->has('nama_tema'))
                                <span class="text-danger"> {{ $errors->first('nama_tema') }}</span>
                            @endif
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        <div style="gap: 4px" class="row d-flex justify-content-end">
                            <button onclick="document.getElementById('tema_form').submit()"
                                class="btn btn-info">Simpan</button>
                            <a href="{{ route('tema.index') }}" title="Batal" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
