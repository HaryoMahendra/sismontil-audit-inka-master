@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ofi/tlofi/input/' . $ofi->id_ofi . (!empty($ref_page) ? '/' . $ref_page : '')) }}"
            method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
                                    <input type="text" name="no_ofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="no_ofi" value="{{ $ofi->no_ofi }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-6">
                                    <select name="kepada" {{ empty($tlofi) ? '' : 'disabled' }} id="kepada"
                                        class="form-control" disabled>
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
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="proses_audit" class="form-control" readonly>
                                        <option value="">- Pilih -</option>
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
                                    <select name="tema_audit" id="tema_audit" class="form-control" readonly>
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
                                    <select name="objek_audit" id="objek_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? 'disabled' : 'disabled' }}>
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
                                        name="jenis_temuan" readonly>
                                    {{-- <select name="jenis_temuan" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="jenis_temuan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->jenis_temuan == 'Ketidaksesuaian' ? 'selected' : '' }}>Ketidaksesuaian</option>
                                        <option {{ $ofi->jenis_temuan == 'Potensi Peningkatan' ? 'selected' : '' }}>Potensi Peningkatan</option>
                                    </select> --}}
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="tgl_terbitofi"
                                        value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal deadline OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        value="{{ $ofi->tgl_deadline }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
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
                                    {{-- <input type="text" name="asal_dept" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="asal_dept" value="{{ $ofi->asal_dept }}"> --}}
                                    <select name="asal_dept" id="asal_dept" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
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
                                    <input type="text" name="proyek"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="proyek" value="{{ $ofi->proyek }}">
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan Peningkatan
                                    Produk/Proses/Sistem Mutu</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_ofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="usulan_ofi" value="{{ $ofi->usulan_ofi }}">
                                </div>
                            </div> --}}
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Usulan peningkatan
                                    produk/proses/sistem mutu</label>
                                <div class="col-sm-6">
                                    <select name="usulan_ofi" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="usulan_ofi" class="form-control">
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
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Identitas (No. Part/No. Tack/No.
                                    Dokumen)</label>
                                <div class="col-sm-6">
                                    <select name="identitas_ofi" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="identitas_ofi" class="form-control">
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
                                <label for="colFormLabel" class="col-sm-4 col-form-label">No. Identitas</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_identitas_ofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
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
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Uraian permasalahan</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="uraian_permasalahan" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        class="form-control" id="uraian_permasalahan" rows="5" placeholder="Masukkan uraian permasalahan"
                                        style="font-style:italic">{{ $ofi->uraian_permasalahan }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Permasalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="uraian_permasalahan"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div> --}}

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Uraian peningkatan</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="usulan_peningkatan" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        class="form-control" id="usulan_peningkatan" rows="5" placeholder="Masukkan uraian permasalahan"
                                        style="font-style:italic">{{ $ofi->usulan_peningkatan }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="usulan_peningkatan" value="{{ $ofi->usulan_peningkatan }}">
                                </div>
                            </div> --}}

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda tangan diusulkan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_dept_pengusul"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="ttd_dept_pengusul" value="{{ $ofi->ttd_dept_pengusul }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"class="form-control" value="{{ $ofi->ttd_dept_pengusul }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diusulkan oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dept_pengusul"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="dept_pengusul" value="{{ $ofi->dept_pengusul }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="tgl_diusulkan"
                                        value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda tangan disetujui
                                    oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_ofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
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
                                    <input type="text" name="disetujui_oleh"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="disetujui_oleh" value="{{ $ofi->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan disetujui
                                    oleh(M/SM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh_jabatan"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="disetujui_oleh_jabatan" class="form-control">
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
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama jabatan disetujui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh_jabatan_nm"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        id="disetujui_oleh_jabatan_nm" value="{{ $ofi->disetujui_oleh_jabatan_nm }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} class="form-control"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="tgl_disetujui"
                                        value="{{ $ofi->tgl_disetujui }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="disposisi" class="form-control" onchange="doChangeDisposisi(this)">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->disposisi == 'OFI ditolak' ? 'selected' : '' }}>OFI ditolak
                                        </option>
                                        <option {{ $ofi->disposisi == 'OFI diterima' ? 'selected' : '' }}>OFI diterima
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda tangan diselesaikan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disposisi" class="form-control" id="ttd_disposisi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        value="{{ $ofi->ttd_disposisi }}">
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
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin2' ? 'disabled' : 'disabled' }}>
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
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tindak lanjut usulan
                                    peningkatan</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="tl_usulanofi"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        class="form-control" id="tl_usulanofi" rows="5" placeholder="Masukkan uraian verifikasi"
                                        style="font-style:italic">{{ isset($tlofi->tl_usulanofi) ? $tlofi->tl_usulanofi : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda tangan ditindaklanjuti
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tlofi_oleh"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        value="{{ isset($tlofi->ttd_tlofi_oleh) ? $tlofi->ttd_tlofi_oleh : '' }}"
                                        class="form-control" id="ttd_tlofi_oleh" style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        value="{{ isset($tlofi->ttd_tlofi_oleh) ? $tlofi->ttd_tlofi_oleh : '' }}"
                                        class="form-control" style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Nama ditindaklanjuti
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_pekerjatl"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        value="{{ isset($tlofi->nama_pekerjatl) ? $tlofi->nama_pekerjatl : '' }}"
                                        class="form-control" id="nama_pekerjatl" placeholder="Masukkan disini"
                                        style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal tindak lanjut</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_tl"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{ isset($tlofi->tgl_tl) ? $tlofi->tgl_tl : '' }}" class="form-control"
                                        id="tgl_tl">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bukti</label>
                                <div class="col-sm-6">
                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept="application/pdf"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                    <p class="help-block">
                                        <font color="red">"Format file .pdf"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 1</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran1" id="lampiran1" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran1 }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 2</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran2" id="lampiran2" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran2 }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 3</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran3" id="lampiran3" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran3 }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 4</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran4" id="lampiran4" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran4 }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 5</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran5" id="lampiran5" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran5 }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Lampiran 6</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lampiran6" id="lampiran6" class="form-control"
                                        placeholder="Masukkan nama lampiran jika ada" value="{{ $ofi->lampiran6 }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Uraian verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="uraian_verif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        class="form-control" id="uraian_verif" rows="5" placeholder="Masukkan uraian verifikasi"
                                        style="font-style:italic">{{ isset($tlofi->uraian_verif) ? $tlofi->uraian_verif : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil verifikasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif"
                                        {{ isset($tlofi->hasil_verif) && $tlofi->hasil_verif == 'efektif' ? 'checked' : '' }}
                                        id="hasil_verif1" value="efektif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}>
                                    <label class="form-check-label" for="hasil_verif1">Efektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif"
                                        {{ isset($tlofi->hasil_verif) && $tlofi->hasil_verif == 'tdk_efektif' ? 'checked' : '' }}
                                        id="hasil_verif2" value="tdk_efektif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}>
                                    <label class="form-check-label" for="hasil_verif2">Tidak Efektif</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda tangan diverifikasi
                                    Oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tlofi_verif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        value="{{ isset($tlofi->ttd_tlofi_verif) ? $tlofi->ttd_tlofi_verif : '' }}"
                                        class="form-control" id="ttd_tlofi_verif" style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        value="{{ isset($tlofi->ttd_tlofi_verif) ? $tlofi->ttd_tlofi_verif : '' }}"
                                        class="form-control" style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_verifikator"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        value="{{ isset($tlofi->nama_verifikator) ? $tlofi->nama_verifikator : '' }}"
                                        class="form-control" id="nama_verifikator" placeholder="Masukkan disini"
                                        style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal verifikasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        value="{{ isset($tlofi->tgl_verif) ? $tlofi->tgl_verif : '' }}"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control"
                                        id="tgl_verif">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->status == 'Tindak Lanjut Belum Sesuai' ? 'selected' : '' }}>
                                            Tindak
                                            Lanjut Belum Sesuai</option>
                                        <option {{ $ofi->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum
                                            Ditindaklanjuti</option>
                                        <option {{ $ofi->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah
                                            Ditindaklanjuti</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-ofi') }}" title="Batal"
                                class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        doChangeDisposisi(document.getElementById('disposisi'));

        function doChangeDisposisi(doc_id) {

            if (doc_id.value == 'OFI diterima') {

                @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Admin2')
                    document.getElementById('ttd_disposisi').disabled = false;

                    document.getElementById('disposisi_diselesaikan_oleh').disabled = false;

                    // document.getElementById('tgl_deadline').disabled = false;
                @endif

                @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Auditee')
                    document.getElementById('tl_usulanofi').disabled = false;

                    document.getElementById('ttd_tlofi_oleh').disabled = false;

                    document.getElementById('nama_pekerjatl').disabled = false;

                    document.getElementById('tgl_tl').disabled = false;

                    document.getElementById('bukti').disabled = false;

                    document.getElementById('lampiran1').disabled = false;

                    document.getElementById('lampiran2').disabled = false;

                    document.getElementById('lampiran3').disabled = false;

                    document.getElementById('lampiran4').disabled = false;

                    document.getElementById('lampiran5').disabled = false;

                    document.getElementById('lampiran6').disabled = false;
                @endif

                @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Auditor')
                    document.getElementById('uraian_verif').disabled = false;

                    document.getElementById('hasil_verif1').disabled = false;

                    document.getElementById('hasil_verif2').disabled = false;

                    document.getElementById('ttd_tlofi_verif').disabled = false;

                    document.getElementById('nama_verifikator').disabled = false;

                    document.getElementById('tgl_verif').disabled = false;

                    @if (auth()->user()->role == 'Auditor')
                        document.getElementById('status').disabled = true;
                    @else
                        document.getElementById('status').disabled = false;
                    @endif
                @endif
            } else {

                @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Admin2')
                    document.getElementById('ttd_disposisi').value = '';
                    document.getElementById('ttd_disposisi').disabled = true;

                    document.getElementById('disposisi_diselesaikan_oleh').value = '';
                    document.getElementById('disposisi_diselesaikan_oleh').disabled = true;

                    // document.getElementById('tgl_deadline').value = '';
                    // document.getElementById('tgl_deadline').disabled = true;
                @endif

                @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Auditee')
                    document.getElementById('tl_usulanofi').value = '';
                    document.getElementById('tl_usulanofi').disabled = true;

                    document.getElementById('ttd_tlofi_oleh').value = '';
                    document.getElementById('ttd_tlofi_oleh').disabled = true;

                    document.getElementById('nama_pekerjatl').value = '';
                    document.getElementById('nama_pekerjatl').disabled = true;

                    document.getElementById('tgl_tl').value = '';
                    document.getElementById('tgl_tl').disabled = true;

                    document.getElementById('bukti').value = '';
                    document.getElementById('bukti').disabled = true;


                    document.getElementById('lampiran1').value = '';
                    document.getElementById('lampiran1').disabled = true;

                    document.getElementById('lampiran2').value = '';
                    document.getElementById('lampiran2').disabled = true;

                    document.getElementById('lampiran3').value = '';
                    document.getElementById('lampiran3').disabled = true;

                    document.getElementById('lampiran4').value = '';
                    document.getElementById('lampiran4').disabled = true;

                    document.getElementById('lampiran5').value = '';
                    document.getElementById('lampiran5').disabled = true;

                    document.getElementById('lampiran6').value = '';
                    document.getElementById('lampiran6').disabled = true;
                @endif

                @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Auditor')
                    document.getElementById('uraian_verif').value = '';
                    document.getElementById('uraian_verif').disabled = true;

                    document.getElementById('hasil_verif1').checked = false;
                    document.getElementById('hasil_verif1').disabled = true;

                    document.getElementById('hasil_verif2').checked = false;
                    document.getElementById('hasil_verif2').disabled = true;

                    document.getElementById('ttd_tlofi_verif').value = '';
                    document.getElementById('ttd_tlofi_verif').disabled = true;

                    document.getElementById('nama_verifikator').value = '';
                    document.getElementById('nama_verifikator').disabled = true;

                    document.getElementById('tgl_verif').value = '';
                    document.getElementById('tgl_verif').disabled = true;

                    document.getElementById('status').value = '';
                    document.getElementById('status').disabled = true;
                @endif
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

        @if (auth()->user()->role == 'Admin2')
            @if (!$tlofi->tgl_tl)
                document.getElementById('uraian_verif').disabled = true;
                document.getElementById('ttd_tlofi_verif').disabled = true;
                document.getElementById('nama_verifikator').disabled = true;
                document.getElementById('tgl_verif').disabled = true;
            @endif
        @endif
    </script>
@endsection
