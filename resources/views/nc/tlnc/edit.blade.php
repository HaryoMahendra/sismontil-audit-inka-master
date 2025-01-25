@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-nc/tlnc/input/' . $nc->id_nc . (!empty($ref_page) ? '/' . $ref_page : '')) }}"
            method="post" enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Form NC</h2>
                            </div><br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Opsi Temuan</label>
                                <div class="col-sm-6">
                                    <select name="opsi_temuan" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}
                                        id="opsi_temuan" class="form-control" readonly>
                                        <option value="NCR" {{ $nc->opsi_temuan == 'NCR' ? 'selected' : '' }}>NCR
                                        </option>
                                        <option value="OFI" {{ $nc->opsi_temuan == 'OFI' ? 'selected' : '' }}>OFI
                                        </option>
                                        <option value="Observasi" {{ $nc->opsi_temuan == 'Observasi' ? 'selected' : '' }}>
                                            Observasi</option>
                                        <option value="CAR" {{ $nc->opsi_temuan == 'CAR' ? 'selected' : '' }}>CAR
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NC</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_nc" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="no_nc"
                                        value="{{ $nc->no_nc }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" id="proses_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} readonly>
                                        <option value="Internal" {{ $nc->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $nc->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->tema_audit == 'ISO 9001' ? 'selected' : '' }}>ISO 9001</option>
                                        <option {{ $nc->tema_audit == 'ISO 45001' ? 'selected' : '' }}>ISO 45001</option>
                                        <option {{ $nc->tema_audit == 'ISO 14001' ? 'selected' : '' }}>ISO 14001</option>
                                        <option {{ $nc->tema_audit == 'ISO 37001' ? 'selected' : '' }}>ISO 37001</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} readonly>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $nc->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
                                                {{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" id="objek_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? 'disabled' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $nc->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="NC" id="jenis_temuan"
                                        name="jenis_temuan" readonly>
                                    {{-- <select name="jenis_temuan" id="jenis_temuan" class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->jenis_temuan == 'Ketidaksesuaian' ? 'selected' : '' }}>
                                            Ketidaksesuaian</option>
                                        <option {{ $nc->jenis_temuan == 'Potensi Peningkatan' ? 'selected' : '' }}>Potensi
                                            Peningkatan</option>
                                    </select> --}}
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit NC</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitnc" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="tgl_terbitnc"
                                        value="{{ $nc->tgl_terbitnc }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        value="{{ $nc->tgl_deadline }}"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                </div>
                            </div>

                            {{-- <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->status == 'Tindak Lanjut Belum Sesuai' ? 'selected' : '' }}>Tindak Lanjut Belum Sesuai</option>
                                        <option {{ $nc->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum Ditindaklanjuti</option>
                                        <option {{ $nc->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah Ditindaklanjuti</option>
                                    </select>
                                </div>
                            </div> --}}
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
                            <!--<input type='hidden' class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} name="id_nc" value=""readonly>-->

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bab Yang Diaudit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bab_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="bab_audit"
                                        value="{{ $nc->bab_audit }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dok_acuan" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="dok_acuan"
                                        value="{{ $nc->dok_acuan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} name="uraian_nc"
                                        id="uraian_nc" rows="5">{{ $nc->uraian_nc }}</textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" id="kategori" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->kategori == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                                        <option {{ $nc->kategori == 'Minor' ? 'selected' : '' }}>Minor</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Auditor</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditor_nc" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="ttd_auditor_nc"
                                        value="{{ $nc->ttd_auditor_nc }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $nc->ttd_auditor_nc }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                                <div class="col-sm-6">
                                    <input type="name" name="nama_auditor" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} id="nama_auditor"
                                        value="{{ $nc->nama_auditor }}">
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda Tangan Diakui Oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_diakui_oleh_nc" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="ttd_diakui_oleh_nc" value="{{ $nc->ttd_diakui_oleh_nc }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $nc->ttd_diakui_oleh_nc }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Diakui Oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="diakui_oleh" value="{{ $nc->diakui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan Diakui Oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <select name="diakui_oleh_jabatan" id="diakui_oleh_jabatan" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->diakui_oleh_jabatan == 'Manager' ? 'selected' : '' }}>Manager
                                        </option>
                                        <option {{ $nc->diakui_oleh_jabatan == 'Senior manager' ? 'selected' : '' }}>
                                            Senior Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Jabatan Diakui Oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh_jabatan_nm" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="diakui_oleh_jabatan_nm" value="{{ $nc->diakui_oleh_jabatan_nm }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_nc" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="ttd_disetujui_oleh_nc" value="{{ $nc->ttd_disetujui_oleh_nc }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $nc->ttd_disetujui_oleh_nc }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="disetujui_oleh" value="{{ $nc->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh1_jabatan" id="disetujui_oleh1_jabatan"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->disetujui_oleh1_jabatan == 'Senior Manager' ? 'selected' : '' }}>
                                            Senior Manager</option>
                                        <option {{ $nc->disetujui_oleh1_jabatan == 'General manager' ? 'selected' : '' }}>
                                            General Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Jabatan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh1_jabatan_nm" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="disetujui_oleh1_jabatan_nm" value="{{ $nc->disetujui_oleh1_jabatan_nm }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui GM</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_accgm" value="{{ $nc->tgl_accgm }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal
                                    Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_planaction" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_planaction" value="{{ $nc->tgl_planaction }}">
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
                                <h2>Input Tindak Lanjut NC</h2>
                            </div><br>
                            <!--<input type='hidden' class="form-control" {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }} name="id_nc" value=""readonly>-->

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Akar Penyebab Masalah</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="akar_masalah"
                                        value="{{ isset($tlnc->akar_masalah) ? $tlnc->akar_masalah : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="akar_masalah" placeholder="Masukkan akar penyebab masalah"
                                        style="font-style:italic"> --}}
                                    <textarea name="akar_masalah" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="akar_masalah" rows="10" placeholder="Masukkan akar penyebab masalah" style="font-style:italic">{{ isset($tlnc->akar_masalah) ? $tlnc->akar_masalah : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Perbaikan</label>
                                <div class="col-sm-6">
                                    <textarea name="uraian_perbaikan" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="uraian_perbaikan" rows="10" placeholder="Masukkan uraian perbaikan" style="font-style:italic">{{ isset($tlnc->uraian_perbaikan) ? $tlnc->uraian_perbaikan : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Pencegahan Untuk Menjamin
                                    Tidak Terulang</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        name="uraian_pencegahan" id="uraian_pencegahan" rows="5" placeholder="Masukkan uraian pencegahan"
                                        style="font-style:italic">{{ isset($tlnc->uraian_pencegahan) ? $tlnc->uraian_pencegahan : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_action"
                                        value="{{ isset($tlnc->tgl_action) ? $tlnc->tgl_action : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_action">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_tlnc" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="ttd_disetujui_oleh_tlnc"
                                        value="{{ isset($tlnc->ttd_disetujui_oleh_tlnc) ? $tlnc->ttd_disetujui_oleh_tlnc : '' }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="name" class="form-control"
                                        value="{{ isset($tlnc->ttd_disetujui_oleh_tlnc) ? $tlnc->ttd_disetujui_oleh_tlnc : '' }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh_tl" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="disetujui_oleh_tl"
                                        value="{{ isset($tlnc->disetujui_oleh_tl) ? $tlnc->disetujui_oleh_tl : '' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh_tl_jabatan" id="disetujui_oleh_tl_jabatan"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ isset($tlnc->disetujui_oleh_tl_jabatan) && $tlnc->disetujui_oleh_tl_jabatan == 'Senior Manager' ? 'selected' : '' }}>
                                            Senior Manager</option>
                                        <option {{ isset($tlnc->disetujui_oleh_tl_jabatan) && $tlnc->disetujui_oleh_tl_jabatan == 'General manager' ? 'selected' : '' }}>
                                            General Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Jabatan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh_tl_jabatan_nm" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="disetujui_oleh_tl_jabatan_nm"
                                        value="{{ isset($tlnc->disetujui_oleh_tl_jabatan_nm) ? $tlnc->disetujui_oleh_tl_jabatan_nm : '' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui GM</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm"
                                        value="{{ isset($tlnc->tgl_accgm) ? $tlnc->tgl_accgm : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_accgm">
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
                            <br>

                            <div class="mb-3">
                                <div class="col-sm-6">
                                    <h6>Verifikasi diisi setelah data tindak lanjut dari auditee sudah lengkap</h6>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        name="uraian_verifikasi" id="uraian_verifikasi" rows="10" placeholder="Masukkan uraian verifikasi"
                                        style="font-style:italic">{{ isset($tlnc->uraian_verifikasi) ? $tlnc->uraian_verifikasi : '' }}</textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil Verifikasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif"
                                        {{ isset($tlnc->hasil_verif) && $tlnc->hasil_verif == 'efektif' ? 'checked' : '' }}
                                        id="inlineRadio1" value="efektif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                    <label class="form-check-label" for="inlineRadio1">Efektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif"
                                        {{ isset($tlnc->hasil_verif) && $tlnc->hasil_verif == 'tdk_efektif' ? 'checked' : '' }}
                                        id="inlineRadio2" value="tdk_efektif"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                    <label class="form-check-label" for="inlineRadio2">Tidak Efektif</label>
                                </div>
                            </div>

                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diverifikasi
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_verifikator_tlnc"
                                        value="{{ isset($tlnc->ttd_verifikator_tlnc) ? $tlnc->ttd_verifikator_tlnc : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        id="ttd_verifikator_tlnc" style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        value="{{ isset($tlnc->ttd_verifikator_tlnc) ? $tlnc->ttd_verifikator_tlnc : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi Oleh</label>
                                <div class="col-sm-6">
                                    <input type="name" name="verifikator"
                                        value="{{ isset($tlnc->verifikator) ? $tlnc->verifikator : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        id="verifikator" placeholder="Masukkan nama verifikator"
                                        style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif"
                                        value="{{ isset($tlnc->tgl_verif) ? $tlnc->tgl_verif : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        id="tgl_verif">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Rekomendasi Tinjauan
                                    manajemen</label>
                                <div class="col-sm-6">
                                    <textarea type="name" name="rekomendasi" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }} id="rekomendasi"
                                        rows="5" placeholder="Masukkan rekomendasi tinjauan" style="font-style:italic">{{ isset($tlnc->rekomendasi) ? $tlnc->rekomendasi : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda Tangan Diverifikasi Oleh
                                    SM Departemen Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_verifsm_tlnc"
                                        value="{{ isset($tlnc->ttd_verifsm_tlnc) ? $tlnc->ttd_verifsm_tlnc : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="ttd_verifsm_tlnc" style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        value="{{ isset($tlnc->ttd_verifsm_tlnc) ? $tlnc->ttd_verifsm_tlnc : '' }}"
                                        class="form-control" style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Diverifikasi Oleh SM Departemen
                                    Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="name" name="namasm_verif"
                                        value="{{ isset($tlnc->namasm_verif) ? $tlnc->namasm_verif : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="namasm_verif" placeholder="Masukkan nama SM Dept. TKP"
                                        style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanggal Verifikasi SM Departemen
                                    Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verifsm"
                                        value="{{ isset($tlnc->tgl_verifsm) ? $tlnc->tgl_verifsm : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="tgl_verifsm">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->status == 'Tindak Lanjut Belum Sesuai' ? 'selected' : '' }}>Tindak
                                            Lanjut Belum Sesuai</option>
                                        <option {{ $nc->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum
                                            Ditindaklanjuti</option>
                                        <option {{ $nc->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah
                                            Ditindaklanjuti</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-nc') }}" title="Batal"
                                class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
