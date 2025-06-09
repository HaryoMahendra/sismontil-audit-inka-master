@extends('layouts.main')


@section('page-title', 'CAT')
@section('breadcrumb')
    <span id="breadcrumb-text">CAT</span>
@endsection

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4" id="cat-heading">CAT</h2>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="form-group">
                            <label for="tipe_data_audit">Pilih Tipe Data Audit :</label>
                            <select id="tipe_data_audit" class="form-control">
                                <option value="">--- Pilih Tipe ---</option>
                                <option value="OFI">OFI (Opportunity For Improvement)</option>
                                <option value="NCR">NCR (Non-Conformance Report)</option>
                            </select>
                        </div>

                        <form method="POST" action="{{ route('cat.store') }}" id="form_ofi" class="mt-4 d-none">
                            @csrf
                            <input type="hidden" name="tipe_data_audit" value="OFI">

                            <div class="form-group">
                                <label for="deskripsi_ofi">Deskripsi OFI</label>
                                <textarea name="deskripsi_ofi" class="form-control" placeholder="Penjelasan Kendala OFI" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="tindakan_ofi">Perbaikan Tindakan OFI</label>
                                <textarea name="tindakan_ofi" class="form-control" placeholder="Penjelasan perbaikan yang benar" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>

                        <form method="POST" action="{{ route('cat.store') }}" id="form_ncr" class="mt-4 d-none">
                            @csrf
                            <input type="hidden" name="tipe_data_audit" value="NCR">

                            <div class="form-group">
                                <label for="deskripsi_ncr">Deskripsi NCR</label>
                                <textarea name="deskripsi_ncr" class="form-control" placeholder="Penjelasan Kendala NCR" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="temuan_ncr">Temuan NCR</label>
                                <textarea name="temuan_ncr" class="form-control" placeholder="Penjelasan temuan audit" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="tindakan_ncr">Tindakan Perbaikan NCR</label>
                                <textarea name="tindakan_ncr" class="form-control" placeholder="Penjelasan tindakan perbaikan" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tipe_data_audit').addEventListener('change', function () {
            const tipe = this.value;

            document.getElementById('form_ofi').classList.toggle('d-none', tipe !== 'OFI');
            document.getElementById('form_ncr').classList.toggle('d-none', tipe !== 'NCR');

            const title = tipe ? `CAT ${tipe}` : 'CAT';
            document.getElementById('breadcrumb-text').textContent = title;
            document.getElementById('page-title').textContent = title;
            document.getElementById('cat-heading').textContent = title;
        });
    </script>
@endsection
