@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
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
                                <select name="opsi_temuan" disabled id="opsi_temuan" class="form-control">
                                    <option value="NCR" {{ $nc->opsi_temuan == 'NCR' ? 'selected' : '' }}>NCR</option>
                                    <option value="OFI" {{ $nc->opsi_temuan == 'OFI' ? 'selected' : '' }}>OFI</option>
                                    <option value="Observasi" {{ $nc->opsi_temuan == 'Observasi' ? 'selected' : '' }}>
                                        Observasi</option>
                                    <option value="CAR" {{ $nc->opsi_temuan == 'CAR' ? 'selected' : '' }}>CAR</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">No. NC</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_nc" disabled class="form-control" id="no_nc"
                                    value="{{ $nc->no_nc }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                            <div class="col-sm-6">
                                <select name="proses_audit" disabled id="proses_audit" class="form-control">
                                    <option value="Internal" {{ $nc->proses_audit == 'Internal' ? 'selected' : '' }}>
                                        Internal</option>
                                    <option value="Eksternal" {{ $nc->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                        Eksternal</option>
                                </select>
                            </div>
                        </div>
                       

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                            <div class="col-sm-6">
                                <select name="tema_audit" id="tema_audit" class="form-control" disabled>
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
                                <select name="objek_audit" id="objek_audit" class="form-control" disabled>
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
                                    name="jenis_temuan" disabled>
                                {{-- <select name="jenis_temuan" disabled id="jenis_temuan" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option {{ $nc->jenis_temuan == 'Ketidaksesuaian' ? 'selected' : '' }}>Ketidaksesuaian
                                    </option>
                                    <option {{ $nc->jenis_temuan == 'Potensi Peningkatan' ? 'selected' : '' }}>Potensi
                                        Peningkatan</option>
                                </select> --}}
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit NC</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_terbitnc" disabled class="form-control" id="tgl_terbitnc"
                                    value="{{ $nc->tgl_terbitnc }}">
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" disabled id="status" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option {{ $nc->status == 'Data Belum Lengkap' ? 'selected' : '' }}>Data Belum Lengkap
                                    </option>
                                    <option {{ $nc->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum
                                        Ditindaklanjuti</option>
                                    <option {{ $nc->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah
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
                        <!--<input type='hidden' class="form-control" name="id_nc" disabled value=""readonly>-->

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                            <div class="col-sm-6">
                                <input type="text" name="bab_audit" disabled class="form-control" id="bab_audit"
                                    value="{{ $nc->bab_audit }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                            <div class="col-sm-6">
                                <input type="text" name="dok_acuan" disabled class="form-control" id="dok_acuan"
                                    value="{{ $nc->dok_acuan }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="uraian_nc" disabled id="uraian_nc" rows="5">{{ $nc->uraian_nc }}</textarea>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                                <select name="kategori" disabled id="kategori" class="form-control">
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
                                <input type="file" name="ttd_auditor_nc" disabled class="form-control"
                                    id="ttd_auditor_nc" value="{{ $nc->ttd_auditor_nc }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled class="form-control" value="{{ $nc->ttd_auditor_nc }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                            <div class="col-sm-6">
                                <input type="name" name="nama_auditor" disabled class="form-control"
                                    id="nama_auditor" value="{{ $nc->nama_auditor }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diakui oleh
                                (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_diakui_oleh_nc" disabled class="form-control"
                                    id="ttd_diakui_oleh_nc" value="{{ $nc->ttd_diakui_oleh_nc }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled class="form-control"
                                    value="{{ $nc->ttd_diakui_oleh_nc }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Diakui oleh (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="name" name="diakui_oleh" disabled class="form-control" id="diakui_oleh"
                                    value="{{ $nc->diakui_oleh }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui oleh
                                (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_disetujui_oleh_nc" disabled class="form-control"
                                    id="ttd_disetujui_oleh_nc" value="{{ $nc->ttd_disetujui_oleh_nc }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled class="form-control"
                                    value="{{ $nc->ttd_disetujui_oleh_nc }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="name" name="disetujui_oleh" disabled class="form-control"
                                    id="disetujui_oleh" value="{{ $nc->disetujui_oleh }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui GM</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_accgm" disabled class="form-control" id="tgl_accgm"
                                    value="{{ $nc->tgl_accgm }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal
                                Penyelesaian</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_planaction" disabled class="form-control"
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
                        <!--<input type='hidden' class="form-control" name="id_nc" disabled value=""readonly>-->

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Akar Penyebab Masalah</label>
                            <div class="col-sm-6">
                                <input type="text" name="akar_masalah" disabled value="{{ $tlnc->akar_masalah }}"
                                    class="form-control" id="akar_masalah" placeholder="Masukkan akar penyebab masalah"
                                    style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Perbaikan</label>
                            <div class="col-sm-6">
                                <textarea name="uraian_perbaikan" disabled class="form-control" id="uraian_perbaikan" rows="5"
                                    placeholder="Masukkan uraian perbaikan" style="font-style:italic">{{ $tlnc->uraian_perbaikan }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Pencegahan untuk menjamin
                                tidak terulang</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="uraian_pencegahan" disabled id="uraian_pencegahan" rows="5"
                                    placeholder="Masukkan uraian pencegahan" style="font-style:italic">{{ $tlnc->uraian_pencegahan }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Penyelesaian</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_action" disabled value="{{ $tlnc->tgl_action }}"
                                    class="form-control" id="tgl_action">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui oleh
                                (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_disetujui_oleh_tlnc" class="form-control" disabled
                                    id="ttd_disetujui_oleh_tlnc" value="{{ $tlnc->ttd_disetujui_oleh_tlnc }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text"class="form-control" disabled
                                    value="{{ $tlnc->ttd_disetujui_oleh_tlnc }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="name" name="disetujui_oleh" class="form-control" disabled
                                    id="disetujui_oleh" value="{{ $tlnc->disetujui_oleh }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui GM</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_accgm" disabled value="{{ $tlnc->tgl_accgm }}"
                                    class="form-control" id="tgl_accgm">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Verifikasi</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="uraian_verifikasi" disabled id="uraian_verifikasi" rows="5"
                                    placeholder="Masukkan uraian verifikasi" style="font-style:italic">{{ $tlnc->uraian_verifikasi }}</textarea>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil Verifikasi</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                    {{ $tlnc->hasil_verif == 'efektif' ? 'checked' : '' }} id="inlineRadio1"
                                    value="efektif">
                                <label class="form-check-label" for="inlineRadio1">Efektif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                    {{ $tlnc->hasil_verif == 'tdk_efektif' ? 'checked' : '' }} id="inlineRadio2"
                                    value="tdk_efektif">
                                <label class="form-check-label" for="inlineRadio2">Tidak Efektif</label>
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diverifikasi
                                oleh</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_verifikator_tlnc" disabled
                                    value="{{ $tlnc->ttd_verifikator_tlnc }}" class="form-control"
                                    id="ttd_verifikator_tlnc" style="font-style:italic">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled value="{{ $tlnc->ttd_verifikator_tlnc }}"
                                    class="form-control" style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi oleh</label>
                            <div class="col-sm-6">
                                <input type="name" name="verifikator" disabled value="{{ $tlnc->verifikator }}"
                                    class="form-control" id="verifikator" placeholder="Masukkan nama verifikator"
                                    style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_verif" disabled value="{{ $tlnc->tgl_verif }}"
                                    class="form-control" id="tgl_verif">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Rekomendasi tinjauan
                                manajemen</label>
                            <div class="col-sm-6">
                                <textarea type="name" name="rekomendasi" disabled class="form-control" id="rekomendasi" rows="5"
                                    placeholder="Masukkan rekomendasi tinjauan" style="font-style:italic">{{ $tlnc->rekomendasi }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda Tangan Diverifikasi oleh SM
                                Departemen
                                Tata Kelola Perusahaan</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_verifsm_tlnc" disabled
                                    value="{{ $tlnc->ttd_verifsm_tlnc }}" class="form-control" id="ttd_verifsm_tlnc"
                                    style="font-style:italic">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled value="{{ $tlnc->ttd_verifsm_tlnc }}"
                                    class="form-control" style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Diverifikasi oleh SM Departemen
                                Tata Kelola Perusahaan</label>
                            <div class="col-sm-6">
                                <input type="name" name="namasm_verif" disabled value="{{ $tlnc->namasm_verif }}"
                                    class="form-control" id="namasm_verif" placeholder="Masukkan nama SM Dept. TKP"
                                    style="font-style:italic">
                            </div>
                        </div>
                        <br>
                        <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-nc') }}" title="Kembali"
                            class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
