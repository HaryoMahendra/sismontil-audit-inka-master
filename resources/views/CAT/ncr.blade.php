@extends('layouts.main')
@section('page-title', 'CAT NCR')
@section('breadcrumb', 'CAT NCR')
@section('content')
<div class="container mt-4">
    <h3>Correction Action Tim</h3>
    <label>Pilih Tipe Data Audit :</label>
    <input type="text" class="form-control mb-3" value="NCR (Non-Conformance Report)" disabled>

    <label>Deskripsi NCR</label>
    <textarea class="form-control mb-3" rows="3" placeholder="Penjelasan Ketidaksesuaian"></textarea>

    <label>Analisis Akar Masalah</label>
    <textarea class="form-control mb-3" rows="3" placeholder="Akar penyebab masalah"></textarea>

    <label>Tindakan Korektif</label>
    <textarea class="form-control mb-3" rows="3" placeholder="Langkah perbaikan yang direncanakan"></textarea>

    <button class="btn btn-primary">Simpan</button>
</div>
@endsection
