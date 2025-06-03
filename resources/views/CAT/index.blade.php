@extends('layouts.main') 

@section('page-title', 'CAT')
@section('breadcrumb', 'CAT')


@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Correction Action Tim</h2>
                    </div>
                <div class="card-body">
        <div class="form-group">
        <label for="audit_type" class="col-form-label">Pilih Tipe Data Audit :</label>
        <select class="form-control" id="audit_type" onchange="redirectToPage()">
            <option value="">--- Pilih Tipe ---</option>
            <option value="ofi">OFI (Opportunity For Improvement)</option>
            <option value="ncr">NCR (Non-Conformance Report)</option>
        </select>

        <script>
            function redirectToPage() {
                const value = document.getElementById("audit_type").value;
                if (value === "ofi") {
                    window.location.href = "/cat/ofi";
                } else if (value === "ncr") {
                    window.location.href = "/cat/ncr";
                }
            }
        </script>

                <div class="form-group mt-3" style="padding-left: 2px;">
                    <button class="btn btn-primary" disabled>Simpan</button>
                </div>
        </div>

                </div>
                </div> 
            </div>
        </div>
    </div>

<script>
    function redirectToPage() {
        const selectedValue = document.getElementById("audit_type").value;
        if (selectedValue) {
            window.location.href = selectedValue;
        }
    }
</script>
@endsection
