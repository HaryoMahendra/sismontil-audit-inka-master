@extends('layouts.main')

@section('page-title', 'Tambah CAT')
@section('breadcrumb')
    <li class="active">Tambah CAT</li>
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-4">Form Tambah Data CAT</h5>

                    <!-- Form CAT -->
                    <form method="POST" action="{{ route('cat.store') }}" id="cat_form">
                        @csrf

                        <div class="form-group">
                            <label for="is_cat">Data CAT</label>
                            <select name="is_cat" id="is_cat" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="departemen">Departemen yang Mengerjakan *</label>
                            <select name="departemen" id="departemen" class="form-control" required>
                                <option value="">-- Pilih Departemen --</option>
                                <option value="TJSL">TJSL</option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="PKPB">PKPB</option>
                                <option value="Hukum">Hukum</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Produksi">Produksi</option>
                            </select>
                        </div>





                        <div class="form-group">
                            <label for="format_penyelidikan">Penyelidikan Ketidaksesuaian (Root cause analysis)</label>
                            <textarea name="format_cat_penyelidikan" id="format_penyelidikan" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="format_perbaikan">Perbaikan yang dilakukan</label>
                            <textarea name="format_cat_perbaikan" id="format_perbaikan" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="format_rencana">Rencana tindakan perbaikan (Agar tidak terulang)</label>
                            <textarea name="format_cat_rencana" id="format_rencana" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="verifikator">Verifikator</label>
                            <select name="verifikator" id="verifikator" class="form-control" required>
                                <option value="">- Pilih -</option>
                                <option value="Wakil Manajemen">Wakil Manajemen</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_penyelidikan">Tanggal Penyelidikan</label>
                            <input type="date" name="tanggal_penyelidikan" id="tanggal_penyelidikan" class="form-control" required>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <a href="{{ route('cat.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endpush


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // $(document).ready(function () {
    //     $('#departemen').select2({
    //         theme: 'bootstrap-5',
    //         placeholder: "-- Pilih Departemen --",
    //         width: '100%',
    //         allowClear: true // hanya untuk single select
    //     });
    // });
</script>


@endpush

