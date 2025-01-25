@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ofi/edit/' . $ofi->id_ofi) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Edit OFI</h2>
                            </div><br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="OFI" id="jenis_temuan"
                                        name="jenis_temuan" {{ empty($tlofi) ? '' : 'disabled' }} readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. OFI</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="no_ofi" value="{{ $ofi->no_ofi }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-6">
                                    <select name="kepada" {{ empty($tlofi) ? '' : 'disabled' }} id="kepada"
                                        class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="Wakil Manajemen"
                                            {{ $ofi->kepada == 'Wakil Manajemen' ? 'selected' : '' }}>
                                            Wakil Manajemen</option>
                                        <option value="Ketua Fungsi Kepatuhan Anti Penyuapan"
                                            {{ $ofi->kepada == 'Ketua Fungsi Kepatuhan Anti Penyuapan' ? 'selected' : '' }}>
                                            Ketua Fungsi Kepatuhan Anti Penyuapan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Periode audit</label>
                                <div class="col-sm-6">
                                    <select name="periode_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="periode_audit"
                                        class="form-control">
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
                                    <select name="proses_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="proses_audit"
                                        class="form-control">
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal"
                                            {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="tema_audit"
                                        class="form-control">
                                        <option>- Pilih -</option>
                                        <option {{ $ofi->tema_audit == 'ISO 9001' ? 'selected' : '' }}>ISO 9001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 45001' ? 'selected' : '' }}>ISO 45001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 14001' ? 'selected' : '' }}>ISO 14001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 37001' ? 'selected' : '' }}>ISO 37001</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="tema_audit"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $ofi->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
                                                {{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek audit</label>
                                <div class="col-sm-6">
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

                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control"
                                        id="tgl_terbitofi" value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal deadline OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_deadline" value="{{ $ofi->tgl_deadline }}" readonly>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Edit Form OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Dari bagian/departemen</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="asal_dept" {{ empty($tlofi) ? '' : 'disabled' }} class="form-control" id="asal_dept"
                                        value="{{ $ofi->asal_dept }}"> --}}
                                    <select name="asal_dept" {{ empty($tlofi) ? '' : 'disabled' }} id="asal_dept"
                                        class="form-control">
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
                                    <input type="text" name="proyek" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="proyek" value="{{ $ofi->proyek }}">
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan Peningkatan
                                    Produk/Proses/Sistem Mutu</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_ofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="usulan_ofi" value="{{ $ofi->usulan_ofi }}">
                                </div>
                            </div> --}}

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Usulan peningkatan
                                    produk/proses/sistem mutu</label>
                                <div class="col-sm-6">
                                    <select name="usulan_ofi" {{ empty($tlofi) ? '' : 'disabled' }} id="usulan_ofi"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Produk" {{ $ofi->usulan_ofi == 'Produk' ? 'selected' : '' }}>
                                            Produk</option>
                                        <option value="Proses" {{ $ofi->usulan_ofi == 'Proses' ? 'selected' : '' }}>
                                            Proses</option>
                                        <option value="Sistem Mutu"
                                            {{ $ofi->usulan_ofi == 'Sistem Mutu' ? 'selected' : '' }}>
                                            Sistem Mutu</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Identitas (No. Part/No. Tack/No.
                                    Dokumen)</label>
                                <div class="col-sm-6">
                                    <select name="identitas_ofi" {{ empty($tlofi) ? '' : 'disabled' }} id="identitas_ofi"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="No. Part"
                                            {{ $ofi->identitas_ofi == 'No. Part' ? 'selected' : '' }}>
                                            No. Part</option>
                                        <option value="No. Tack"
                                            {{ $ofi->identitas_ofi == 'No. Tack' ? 'selected' : '' }}>
                                            No. Tack</option>
                                        <option value="No. Dokumen"
                                            {{ $ofi->identitas_ofi == 'No. Dokumen' ? 'selected' : '' }}>
                                            No. Dokumen</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">No.Identitas</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_identitas_ofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="no_identitas_ofi" value="{{ $ofi->no_identitas_ofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang
                                    mengerjakan</label>
                                <div class="col-sm-6">
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
                                    <input type="text" name="uraian_permasalahan"
                                        {{ empty($tlofi) ? '' : 'disabled' }} class="form-control"
                                        id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="usulan_peningkatan"
                                        value="{{ $ofi->usulan_peningkatan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diusulkan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_dept_pengusul" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="ttd_dept_pengusul"
                                        value="{{ $ofi->ttd_dept_pengusul }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ofi->ttd_dept_pengusul }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diusulkan oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dept_pengusul" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="dept_pengusul" value="{{ $ofi->dept_pengusul }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan" {{ empty($tlofi) ? '' : 'disabled' }}
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control"
                                        id="tgl_diusulkan" value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan disetujui
                                    oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_ofi"
                                        {{ empty($tlofi) ? '' : 'disabled' }} class="form-control"
                                        id="ttd_disetujui_oleh_ofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        value="{{ $ofi->ttd_disetujui_oleh_ofi }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control"
                                        value="{{ $ofi->ttd_disetujui_oleh_ofi }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama disetujui oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="disetujui_oleh"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        value="{{ $ofi->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan disetujui oleh</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh_jabatan" {{ empty($tlofi) ? '' : 'disabled' }}
                                        id="disetujui_oleh_jabatan" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option value="Manager"
                                            {{ $ofi->disetujui_oleh_jabatan == 'Manager' ? 'selected' : '' }}>
                                            Manager</option>
                                        <option value="Senior Manager"
                                            {{ $ofi->disetujui_oleh_jabatan == 'Senior Manager' ? 'selected' : '' }}>
                                            Senior Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama jabatan disetujui
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh_jabatan_nm"
                                        {{ empty($tlofi) ? '' : 'disabled' }} class="form-control"
                                        id="disetujui_oleh_jabatan_nm"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        value="{{ $ofi->disetujui_oleh_jabatan_nm }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_disetujui"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{ $ofi->tgl_disetujui }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" {{ empty($tlofi) ? '' : 'disabled' }} id="disposisi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        class="form-control" onchange="doChangeDisposisi(this)">
                                        <option>- Pilih -</option>
                                        <option {{ $ofi->disposisi == 'OFI ditolak' ? 'selected' : '' }}>OFI ditolak
                                        </option>
                                        <option {{ $ofi->disposisi == 'OFI diterima' ? 'selected' : '' }}>OFI diterima
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diselesaikan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disposisi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        class="form-control" id="ttd_disposisi" value="{{ $ofi->ttd_disposisi }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ofi->ttd_disposisi }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diselesaikan oleh</label>
                                <div class="col-sm-6">
                                    <select name="disposisi_diselesaikan_oleh" {{ empty($tlofi) ? '' : 'disabled' }}
                                        id="disposisi_diselesaikan_oleh" class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->disposisi_diselesaikan_oleh == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br>
                            @if (empty($tlofi))
                                <button type="submit" class="btn btn-info">Simpan</button>
                            @endif
                            <a href="{{ url('data-ofi') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        @if (empty($tlofi))
            doChangeDisposisi(document.getElementById('disposisi'));

            function doChangeDisposisi(doc_id) {

                if (doc_id.value == 'OFI diterima') {

                    document.getElementById('disposisi_diselesaikan_oleh').disabled = false;

                    // document.getElementById('tgl_deadline').disabled = false;
                } else {

                    document.getElementById('disposisi_diselesaikan_oleh').value = '';
                    document.getElementById('disposisi_diselesaikan_oleh').disabled = true;

                    // document.getElementById('tgl_deadline').value = '';
                    // document.getElementById('tgl_deadline').disabled = true;
                }
            }
        @endif

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
