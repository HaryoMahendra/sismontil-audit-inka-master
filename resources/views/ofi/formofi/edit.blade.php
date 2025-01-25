@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Input Form OFI</h2>
                        </div><br>
                        <form action="{{ url('data-ofi/form/' . $ofi->id_ofi) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. OFI</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ofi" class="form-control" id="no_ofi"
                                        value="{{ $ofi->no_ofi }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Periode audit</label>
                                <div class="col-sm-6">
                                    <select name="periode_audit" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="periode_audit" class="form-control" disabled>
                                        <option value="">- Pilih -</option>
                                        <option value="I" {{ $ofi->periode_audit == 'I' ? 'selected' : '' }}>
                                            I</option>
                                        <option value="II" {{ $ofi->periode_audit == 'II' ? 'selected' : '' }}>
                                            II</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="proses_audit" class="form-control" disabled>
                                        <option value="">- Pilih -</option>
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" class="form-control" id="tgl_terbitofi"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $ofi->tgl_terbitofi }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal deadline OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" id="tgl_deadline" class="form-control"
                                        value="{{ $ofi->tgl_deadline }}" disabled>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-6">
                                    <select name="kepada" id="kepada" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Wakil Manajemen">Wakil Manajemen</option>
                                        <option value="Ketua Fungsi Kepatuhan Anti Penyuapan">Ketua Fungsi Kepatuhan Anti
                                            Penyuapan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Dari bagian/departemen</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="asal_dept" class="form-control" id="asal_dept"> --}}
                                    <select name="asal_dept" id="asal_dept" class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->asal_dept == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proyek</label>
                                <div class="col-sm-6">
                                    <input type="text" name="proyek" class="form-control" id="proyek">
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan Peningkatan
                                    Produk/Proses/Sistem Mutu</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_ofi" class="form-control" id="usulan_ofi">
                                </div>
                            </div> --}}

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan peningkatan
                                    produk/proses/sistem mutu</label>
                                <div class="col-sm-6">
                                    <select name="usulan_ofi" id="usulan_ofi" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Produk">Produk</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Sistem Mutu">Sistem Mutu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Identitas (No. Part/No. Tack/No.
                                    Dokumen)</label>
                                <div class="col-sm-6">
                                    <select name="identitas_ofi" id="identitas_ofi" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="No. Part">No. Part</option>
                                        <option value="No. Tack">No. Tack</option>
                                        <option value="No. Dokumen">No. Dokumen</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">No. Identintas</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_identitas_ofi" class="form-control"
                                        id="no_identitas_ofi">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang
                                    mengerjakan</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="dept_ygmngrjkn" class="form-control" id="dept_ygmngrjkn"> --}}
                                    {{-- <select name="dept_ygmngrjkn" id="dept_ygmngrjkn" class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->dept_ygmngrjkn == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select name="objek_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="objek_audit"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian permasalahan</label>
                                <div class="col-sm-6">
                                    <textarea name="uraian_permasalahan" class="form-control" id="uraian_permasalahan" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Usulan peningkatan</label>
                                <div class="col-sm-6">
                                    <textarea name="usulan_peningkatan" class="form-control" id="usulan_peningkatan" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diusulkan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_dept_pengusul" class="form-control"
                                        id="ttd_dept_pengusul">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diusulkan oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dept_pengusul" class="form-control" id="dept_pengusul">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan" class="form-control" id="tgl_diusulkan"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_ofi" class="form-control"
                                        id="ttd_disetujui_oleh_ofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh" class="form-control" id="disetujui_oleh"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">jabatan disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh_jabatan" id="disetujui_oleh_jabatan"
                                        class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Senior Manager">Senior Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama jabatan disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh_jabatan_nm" class="form-control"
                                        id="disetujui_oleh_jabatan_nm"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui" class="form-control" id="tgl_disetujui"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" id="disposisi" class="form-control"
                                        onchange="doChangeDisposisi(this)"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option>OFI ditolak</option>
                                        <option>OFI diterima</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diselesaikan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disposisi" class="form-control" id="ttd_disposisi">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diselesaikan oleh</label>
                                <div class="col-sm-6">
                                    <select name="disposisi_diselesaikan_oleh" id="disposisi_diselesaikan_oleh"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}">{{ $data_usersAuditee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diselesaikan Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disposisi_diselesaikan_oleh" class="form-control"
                                        id="disposisi_diselesaikan_oleh">
                                </div>
                            </div> --}}

                            <br>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                            <a href="{{ url('data-ofi') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        doChangeDisposisi(document.getElementById('disposisi'));

        function doChangeDisposisi(doc_id) {

            if (doc_id.value == 'OFI diterima') {
                document.getElementById('ttd_disposisi').disabled = false;

                document.getElementById('disposisi_diselesaikan_oleh').disabled = false;

                // document.getElementById('tgl_deadline').disabled = false;
            } else {
                document.getElementById('ttd_disposisi').value = '';
                document.getElementById('ttd_disposisi').disabled = true;

                document.getElementById('disposisi_diselesaikan_oleh').value = '';
                document.getElementById('disposisi_diselesaikan_oleh').disabled = true;

                // document.getElementById('tgl_deadline').value = '';
                // document.getElementById('tgl_deadline').disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitofi = document.getElementById('tgl_terbitofi');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitofi.addEventListener('change', function() {
                if (tgl_terbitofi.value !== '') {
                    var deadline = new Date(tgl_terbitofi.value);
                    deadline.setDate(deadline.getDate() + 60);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
