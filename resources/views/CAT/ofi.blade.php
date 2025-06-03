@extends('layouts.main')
@section('page-title', 'CAT OFI')
@section('breadcrumb', 'CAT OFI')

@section('content')
<div class="container mt-4">
    <h3>Correction Action Tim</h3>
    <label>Pilih Tipe Data Audit :</label>
    <input type="text" class="form-control mb-3" value="OFI (Opportunity For Improvement)" disabled>

    <label>Deskripsi OFI</label>
    <textarea class="form-control mb-3" rows="3" placeholder="Penjelasan Kendala OFI"></textarea>

    <label>Perbaikan Tindakan OFI</label>
    <textarea class="form-control mb-3" rows="3" placeholder="Penjelasan perbaikan yang benar"></textarea>

    <button class="btn btn-primary">Simpan</button>
</div>
@endsection