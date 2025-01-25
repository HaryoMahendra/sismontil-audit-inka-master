@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ofi/tlofi/input/' . $ofi->id_ofi) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Form OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. OFI</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ofi" disabled class="form-control" id="no_ofi"
                                        value="{{ $ofi->no_ofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-6">
                                    <select name="kepada" disabled id="kepada" class="form-control" disabled>
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
                                    <select name="periode_audit" disabled id="periode_audit" class="form-control">
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
                                    <select name="proses_audit" disabled id="proses_audit" class="form-control">
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control" disabled>
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
                                    <select name="objek_audit" id="objek_audit" class="form-control" disabled>
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
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="OFI" id="jenis_temuan"
                                        name="jenis_temuan" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" disabled class="form-control"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="tgl_terbitofi"
                                        value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal deadline OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" disabled class="form-control"
                                        id="tgl_deadline" value="{{ $ofi->tgl_deadline }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" disabled id="status" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->status == 'Data Belum Lengkap' ? 'selected' : '' }}>Data Belum
                                            Lengkap</option>
                                        <option {{ $ofi->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum
                                            Ditindaklanjuti</option>
                                        <option {{ $ofi->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah
                                            Ditindaklanjuti</option>
                                    </select>
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
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Dari bagian/departemen</label>
                                <div class="col-sm-6">
                                    <select name="asal_dept" id="asal_dept" class="form-control" disabled>
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
                                    <input type="text" name="proyek" disabled class="form-control" id="proyek"
                                        value="{{ $ofi->proyek }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Usulan peningkatan
                                    produk/proses/sistem mutu</label>
                                <div class="col-sm-6">
                                    <select name="usulan_ofi" disabled id="usulan_ofi" class="form-control">
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
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Identitas (No. Part/No. Tack/No.
                                    Dokumen)</label>
                                <div class="col-sm-6">
                                    <select name="identitas_ofi" disabled id="identitas_ofi" class="form-control">
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
                                <label for="colFormLabel" class="col-sm-4 col-form-label">No. Identitas</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_identitas_ofi" disabled class="form-control"
                                        id="no_identitas_ofi" value="{{ $ofi->no_identitas_ofi }}">
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
                                    <input type="text" name="uraian_permasalahan" disabled class="form-control"
                                        id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan" disabled class="form-control"
                                        id="usulan_peningkatan" value="{{ $ofi->usulan_peningkatan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diusulkan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_dept_pengusul" disabled class="form-control"
                                        id="ttd_dept_pengusul" value="{{ $ofi->ttd_dept_pengusul }}">
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
                                    <input type="text" name="dept_pengusul" disabled class="form-control"
                                        id="dept_pengusul" value="{{ $ofi->dept_pengusul }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan" disabled class="form-control"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="tgl_diusulkan"
                                        value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan disetujui
                                    oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_ofi" disabled class="form-control"
                                        id="ttd_disetujui_oleh_ofi" value="{{ $ofi->ttd_disetujui_oleh_ofi }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control"
                                        value="{{ $ofi->ttd_disetujui_oleh_ofi }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh" disabled class="form-control"
                                        id="disetujui_oleh" value="{{ $ofi->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan disetujui
                                    oleh(M/SM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh_jabatan" disabled id="disetujui_oleh_jabatan"
                                        class="form-control">
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
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama jabatan disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh_jabatan_nm" disabled class="form-control"
                                        id="disetujui_oleh_jabatan_nm" value="{{ $ofi->disetujui_oleh_jabatan_nm }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui" disabled class="form-control"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="tgl_disetujui"
                                        value="{{ $ofi->tgl_disetujui }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" disabled id="disposisi" class="form-control">
                                        <option value="">- Pilih -</option>
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
                                    <input type="file" name="ttd_disposisi" disabled class="form-control"
                                        id="ttd_disposisi" value="{{ $ofi->ttd_disposisi }}">
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
                                    <select name="disposisi_diselesaikan_oleh" id="disposisi_diselesaikan_oleh"
                                        class="form-control" disabled>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Input Tindak Lanjut OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Tindak lanjut usulan
                                    peningkatan</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="tl_usulanofi" disabled class="form-control" id="tl_usulanofi"
                                        placeholder="Masukkan tindak lanjut usulan" style="font-style:italic">{{ isset($tlofi->tl_usulanofi) ? $tlofi->tl_usulanofi : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan ditindaklanjuti
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tlofi_oleh" disabled
                                        value="{{ $tlofi->ttd_tlofi_oleh }}" class="form-control" id="ttd_tlofi_oleh"
                                        style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" value="{{ $tlofi->ttd_tlofi_oleh }}" class="form-control"
                                        style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Ditindaklanjuti oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_pekerjatl" disabled
                                        value="{{ $tlofi->nama_pekerjatl }}" class="form-control" id="nama_pekerjatl"
                                        placeholder="Masukkan disini" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal tindak lanjut</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_tl" disabled value="{{ $tlofi->tgl_tl }}"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control"
                                        id="tgl_tl">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bukti</label>
                                <div class="col-sm-6">
                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept="application/pdf" disabled>
                                    <p class="help-block">
                                        <font color="red">"Format file .pdf"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ofi->bukti }}" disabled>
                                </div>
                            </div>
                            <br>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 1</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran1" id="lampiran1" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran1 }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 2</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran2" id="lampiran2" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran2 }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 3</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran3" id="lampiran3" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran3 }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 4</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran4" id="lampiran4" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran4 }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 5</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran5" id="lampiran5" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran5 }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 6</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran6" id="lampiran6" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran6 }}"
                                        disabled>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Uraian verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="uraian_verif" disabled class="form-control" id="uraian_verif" rows="5"
                                        placeholder="Masukkan uraian verifikasi" style="font-style:italic">{{ $tlofi->uraian_verif }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil verifikasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                        {{ $tlofi->hasil_verif == 'efektif' ? 'checked' : '' }} id="inlineRadio1"
                                        value="efektif">
                                    <label class="form-check-label" for="inlineRadio1">Efektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                        {{ $tlofi->hasil_verif == 'tdk_efektif' ? 'checked' : '' }} id="inlineRadio2"
                                        value="tdk_efektif">
                                    <label class="form-check-label" for="inlineRadio2">Tidak Efektif</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diverifikasi
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tlofi_verif" disabled
                                        value="{{ $tlofi->ttd_tlofi_verif }}" class="form-control" id="ttd_tlofi_verif"
                                        style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" value="{{ $tlofi->ttd_tlofi_verif }}" class="form-control"
                                        style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_verifikator" disabled
                                        value="{{ $tlofi->nama_verifikator }}" class="form-control"
                                        id="nama_verifikator" placeholder="Masukkan disini" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal verifikasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif" disabled value="{{ $tlofi->tgl_verif }}"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control"
                                        id="tgl_verif">
                                </div>
                            </div>

                            <br>
                            <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-ofi') }}" title="Kembali"
                                class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
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
