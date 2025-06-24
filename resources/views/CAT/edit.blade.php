@extends('layouts.main')

@section('page-title', 'Edit Data CAT')
@section('breadcrumb')
    <li><a href="{{ route('cat.index') }}">Data CAT</a></li>
    <li class="active">Edit</li>
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Edit Data CAT</h3>

                    <form action="{{ route('cat.update', $cat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="is_cat">Data CAT</label>
                            <select name="is_cat" class="form-control" required>
                                <option value="Ya" {{ $cat->is_cat == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ $cat->is_cat == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="departemen">Departemen</label>
                            <input type="text" name="departemen" class="form-control" value="{{ $cat->departemen }}" required>
                        </div>

                        <div class="form-group">
                            <label for="format_cat_penyelidikan">Penyelidikan Ketidaksesuaian</label>
                            <textarea name="format_cat_penyelidikan" class="form-control">{{ $cat->penyelidikan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="format_cat_perbaikan">Perbaikan</label>
                            <textarea name="format_cat_perbaikan" class="form-control">{{ $cat->perbaikan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="format_cat_rencana">Rencana Tindakan Perbaikan</label>
                            <textarea name="format_cat_rencana" class="form-control">{{ $cat->rencana }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="verifikator">Verifikator</label>
                            <input type="text" name="verifikator" class="form-control" value="{{ $cat->verifikator }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_penyelidikan">Tanggal Penyelidikan</label>
                            <input type="date" name="tanggal_penyelidikan" class="form-control" value="{{ $cat->tanggal }}" required>
                        </div>

                        <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                        <a href="{{ route('cat.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
