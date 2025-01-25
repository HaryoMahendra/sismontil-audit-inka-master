@extends('layouts.main')

@section('content')
    <style>
        #files-area {
            width: 100%;
            margin: 0 auto;
        }

        input[type="file"] {
            width: 370px;
        }

        .file-block {
            border-radius: 10px;
            background-color: rgba(144, 163, 203, 0.2);
            margin: 5px;
            color: initial;
            display: inline-flex;

            &>span.name {
                padding-right: 10px;
                max-width: 200px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }

        .file-delete {
            display: flex;
            width: 24px;
            color: initial;
            background-color: #6eb4ff00;
            font-size: large;
            justify-content: center;
            margin-right: 3px;
            cursor: pointer;

            &:hover {
                background-color: rgba(144, 163, 203, 0.2);
                border-radius: 10px;
            }

            &>span {
                transform: rotate(45deg);
            }
        }
    </style>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5>Show data</h5>
                    </div>

                    <!--form penerbitan ncr -->
                    <div class="card-body">
                        <div class="row" style="">
                            <div class="col-12 my-2 bg-light p-2 text-center">
                                <h5>Penerbitan NCR</h5>
                            </div>

                            <!-- form auditor pertama -->
                            <div class="col-md-6 border border-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <div><span class="font-weight-bold badge badge-info p-2"><i
                                                class="far fa-user fa-fw"></i>Auditor</span></div>
                                    @if (request()->query('page') != 'monitoring-tl.index')
                                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditor')
                                            <button id="edit-button" class="btn btn-xs btn-warning" data-toggle="modal"
                                                data-target="#auditor1_modal"
                                                {{ $ncr->disetujui_oleh_admin == 'approve' ? 'disabled' : '' }}><i
                                                    class="far fa-edit fa-fw"></i></button>
                                        @endif
                                    @endif
                                </div>
                                <div style="">
                                    <table class="table mt-2" width="100%">
                                        <tr>
                                            <td>No NCR</td>
                                            <td>:</td>
                                            <td>{{ $ncr->no_ncr }}</td>
                                        </tr>
                                        <tr>
                                            <td>Periode Audit</td>
                                            <td>:</td>
                                            <td>{{ $ncr->periode_audit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Proses Audit</td>
                                            <td>:</td>
                                            <td>{{ $ncr->proses_audit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tema Audit</td>
                                            <td>:</td>
                                            <td>{{ $ncr->tema->nama_tema }}</td>
                                        </tr>
                                        <tr>
                                            <td>Objek Audit</td>
                                            <td>:</td>
                                            <td>
                                                @foreach ($data as $dat)
                                                    @if ($ncr->name_objek_audit == $dat['div_name'])
                                                        {{ $dat['div_name'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bab yang di audit</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->bab_audit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dokumen Acuan</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->dok_acuan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Uraian Ketidaksesuaian</td>
                                            <td>:</td>
                                            <td style="display: inline-block; width: 400px;">{{ $ncr->uraian_ncr }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->kategori }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Auditor</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->nama_auditor }}</td>
                                        </tr>
                                        @if ($ncr->proses_audit == 'Eksternal')
                                            <tr>
                                                <td>Nama auditor eksternal</td>
                                                <td>:</td>
                                                <td> {{ $ncr->auditor_eksternal }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Tanggal Terbit NCR</td>
                                            <td>:</td>
                                            <td>{{ $ncr->tgl_terbitncr }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Deadline NCR</td>
                                            <td>:</td>
                                            <td>{{ $ncr->tgl_deadline }}
                                                @if ($ncr->tgl_deadline != null)
                                                    @if ($ncr->tgl_deadline < Carbon\Carbon::now()->format('Y-m-d'))
                                                        <span class="font-weight-bold text-danger">(Overdue)</span>
                                                    @else
                                                        <span class="font-weight-bold text-success">(
                                                            {{ \Carbon\Carbon::parse($ncr->tgl_deadline)->diffInDays(\Carbon\Carbon::now()) }}
                                                            days later)</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @if ($ncr->disetujui_oleh_admin != null)
                                    <div class="text-center bg-success p-2">
                                        <h6 class="text-white">Released By Admin</h5>
                                    </div>
                                @endif
                                @if (auth()->user()->role->role == 'Admin')
                                    @if ($ncr->disetujui_oleh_admin == null)
                                        <div>
                                            <form action="{{ route('data-ncr.approveAdmin', $ncr->id) }}" method="POST"
                                                id="approveAdmin">
                                                @csrf
                                                <input type="hidden" name="approveAdmin" id="approveAdmin" value="approve">
                                                <button onclick="return confirm('Apakah Anda yakin ingin merilis NCR ini?')"
                                                    class="btn btn-primary btn-block" id="approve-button">Release</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <!-- Form penerbitan auditee -->
                            <div class="col-md-6 border border-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <div><span class="font-weight-bold badge badge-warning p-2"><i
                                                class="far fa-user fa-fw"></i>Auditee</span></div>
                                    @if (request()->query('page') != 'monitoring-tl.index')
                                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditee')
                                            @if ($ncr->disetujui_oleh_admin != null)
                                                <button id="edit-button-auditee" class="btn btn-xs btn-warning"
                                                    data-toggle="modal" data-target="#auditee_modal"
                                                    {{ $ncr->disetujui_oleh_auditor != null ? 'disabled' : '' }}> <i
                                                        class="far fa-edit fa-fw"></i></button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div style="">
                                    <table class="table mt-2" width="100%">
                                        <tr>
                                            <td>Nama diakui oleh (M/SM)</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->nama_diakui_m_sm }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan diakui oleh (M/SM)</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->jabatan_diakui_m_sm }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama disetujui oleh (SM/GM)</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->nama_disetujui_sm_gm }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan disetujui oleh (SM/GM)</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->jabatan_disetujui_sm_gm }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal disetujui SM/GM</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->tgl_acc_gm }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rencana tanggal penyelesaian</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->tgl_plan_action }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- button penerbitan auditee -->
                                {{-- @if ($ncr->disetujui_oleh_auditee != null)
                                    <div class="text-center bg-success p-2">
                                        <h6 class="text-white">Submitted by Auditee</h5>
                                    </div>
                                @endif
                                @if ($ncr->disetujui_oleh_admin != null && $ncr->disetujui_oleh_auditee == null)
                                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditee')
                                        @if ($ncr->disetujui_oleh_auditee == null)
                                            <div>
                                                <form action="{{ route('data-ncr.approveAuditee', $ncr->id) }}"
                                                    method="POST" id="approveAuditee">
                                                    @csrf
                                                    <input type="hidden" name="approveAuditee" id="approveAuditee"
                                                        value="approve">
                                                    <button onclick="document.getElementById('approveAuditee').submit()"
                                                        class="btn btn-primary btn-block"
                                                        id="approve-button-auditee">Submit</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                @endif --}}
                            </div>
                        </div>

                        <!-- form tl  -->
                        <hr size='10'>
                        <div class="row">
                            <div class="col-12 my-2 bg-light p-2 text-center">
                                <h5>Tindak lanjut NCR</h5>
                            </div>

                            <!-- form tl auditee -->
                            <div class="col-md-6 border border-light p-3 rounded mt-2">
                                <div class="d-flex justify-content-between">
                                    <div><span class="font-weight-bold badge badge-warning p-2"><i
                                                class="far fa-user fa-fw"></i>Auditee</span></div>
                                    @if (request()->query('page') != 'monitoring-tl.index')
                                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditee')
                                            @if ($ncr->tgl_plan_action != null)
                                                <button id="edit-button-auditee2" class="btn btn-xs btn-warning"
                                                    data-toggle="modal" data-target="#auditee2_modal"
                                                    {{ $ncr->disetujui_oleh_auditor != null ? 'disabled' : '' }}> <i
                                                        class="far fa-edit fa-fw"></i></button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div style="">
                                    <table class="table mt-2" width="100%">
                                        <tr>
                                            <td>Akar penyebab masalah</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->akar_masalah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Uraian perbaikan</td>
                                            <td>:</td>
                                            <td style="display: inline-block; width: 400px;">{{ $ncr->uraian_perbaikan }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Uraian pencegahan untuk menjamin tidak terulang</td>
                                            <td>:</td>
                                            <td style="display: inline-block; width: 400px;">{{ $ncr->uraian_pencegahan }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal penyelesaian</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->tgl_action }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama disetujui oleh (SM/GM)</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->nama_sm_verif }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan disetujui oleh (SM/GM)</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->jabatan_disetujui_sm_gm2 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal disetujui SM/GM</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ncr->tgl_acc_gm2 }}</td>
                                        </tr>
                                        @foreach ($lampiran as $lamp)
                                            <tr>
                                                <td>Lampiran {{ $loop->iteration }}</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($ncr->id == $lamp['id_ncr'])
                                                        <a href="{{ asset('storage/pdf/' . $lamp->nama_lampiran) }}"
                                                            target="_blank">{{ $lamp['nama_lampiran'] }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                {{-- @if ($ncr->disetujui_oleh_auditee2 != null)
                                    <div class="text-center bg-success p-2">
                                        <h6 class="text-white">Submitted by Auditee</h5>
                                    </div>
                                @endif
                                @if ($ncr->disetujui_oleh_admin != null && $ncr->bukti != null && $ncr->disetujui_oleh_auditee2 == null)
                                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditee')
                                        <div>
                                            <form action="{{ route('data-ncr.approveAuditee2', $ncr->id) }}"
                                                method="POST" id="approveAuditee2">
                                                @csrf
                                                <input type="hidden" name="approveAuditee2" id="approveAuditee2"
                                                    value="approve">
                                                <button
                                                    onclick="return confirm('Apakah Anda yakin ingin mensubmit NCR ini?')"
                                                    class="btn btn-primary btn-block"
                                                    id="approve-button-auditee2">Submit</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif --}}
                            </div>

                            <!-- form tl auditor -->
                            <div class="col-md-6 border border-light p-3 rounded mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <div><span class="font-weight-bold badge badge-info p-2"><i
                                                        class="far fa-user fa-fw"></i>Auditor</span></div>
                                            @if (request()->query('page') != 'monitoring-tl.index')
                                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditor')
                                                    @if ($ncr->akar_masalah != null)
                                                        <button id="edit-button-auditor2" class="btn btn-xs btn-warning"
                                                            data-toggle="modal" data-target="#auditor2_modal"
                                                            {{ $ncr->disetujui_oleh_auditor != null ? 'disabled' : '' }}>
                                                            <i class="far fa-edit fa-fw"></i></button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <div style="">
                                            <table class="table mt-2" width="100%">
                                                <tr>
                                                    <td>Uraian verifikasi</td>
                                                    <td>:</td>
                                                    <td style="display: inline-block; width: 400px;">
                                                        {{ $ncr->uraian_verif }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hasil verifikasi</td>
                                                    <td>:</td>
                                                    <td width="50%">{{ $ncr->hasil_verif }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Diverifikasi oleh</td>
                                                    <td>:</td>
                                                    <td width="50%">{{ $ncr->diverif_oleh_auditor }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal verifikasi</td>
                                                    <td>:</td>
                                                    <td width="50%">{{ $ncr->tgl_verif }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- button submit tl auditor -->
                                        @if ($ncr->disetujui_oleh_auditor != null)
                                            <div class="text-center bg-success p-2">
                                                <h6 class="text-white">Approved by Auditor</h5>
                                            </div>
                                        @endif
                                        @if ($ncr->uraian_verif != null)
                                            @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditor')
                                                @if ($ncr->disetujui_oleh_auditor == null)
                                                    <div>
                                                        <form action="{{ route('data-ncr.approveAuditor2', $ncr->id) }}"
                                                            method="POST" id="approveAuditor2">
                                                            @csrf
                                                            <input type="hidden" name="approveAuditor2"
                                                                id="approveAuditor2" value="approve">
                                                            <button
                                                                onclick="return confirm('Apakah Anda yakin ingin mengapprove NCR ini?')"
                                                                class="btn btn-primary btn-block"
                                                                id="approve-button-auditor2">Approve</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    </div>

                                    <!-- form wm -->
                                    <div class="col-12 mt-5">
                                        <div class="d-flex justify-content-between">
                                            <div><span class="font-weight-bold badge badge-danger p-2"><i
                                                        class="far fa-user fa-fw"></i>Wakil manajemen</span></div>
                                            @if (request()->query('page') != 'monitoring-tl.index')
                                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen')
                                                    @if ($ncr->disetujui_oleh_auditor != null)
                                                        <button id="edit-button-wm" class="btn btn-xs btn-warning"
                                                            data-toggle="modal" data-target="#wm_modal"
                                                            {{ $ncr->disetujui_oleh_wm != null ? 'disabled' : '' }}> <i
                                                                class="far fa-edit fa-fw"></i></button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <div style="">
                                            <table class="table mt-2" width="100%">
                                                <tr>
                                                    <td>Verifikasi wakil manajemen</td>
                                                    <td>:</td>
                                                    <td style="display: inline-block; width: 400px;">{{ $ncr->verif_wm }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Wakil Manajemen</td>
                                                    <td>:</td>
                                                    <td width="50%">{{ $ncr->diverif_oleh_wm }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal verifikasi</td>
                                                    <td>:</td>
                                                    <td width="50%">{{ $ncr->tgl_verif_wm }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- button wm -->
                                        @if ($ncr->disetujui_oleh_wm != null)
                                            <div class="text-center bg-success p-2">
                                                <h6 class="text-white">Closed By Wakil Manajemen</h5>
                                            </div>
                                        @endif
                                        @if ($ncr->disetujui_oleh_auditor != null && $ncr->verif_wm != null)
                                            @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen')
                                                @if ($ncr->disetujui_oleh_wm == null)
                                                    <div>
                                                        <form action="{{ route('data-ncr.approvewm', $ncr->id) }}"
                                                            method="POST" id="approvewm">
                                                            @csrf
                                                            <input type="hidden" name="approvewm" id="approvewm"
                                                                value="approve">
                                                            <button
                                                                onclick="return confirm('Apakah Anda yakin ingin close NCR ini?')"
                                                                class="btn btn-primary btn-block"
                                                                id="approve-button-wm">Close</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="auditor1_modal" tabindex="-1" aria-labelledby="auditor1_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditor1_modalLabel">Edit data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-ncr.update', $ncr->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_audit">Periode Audit <span
                                                class="text-danger">*</span></label>
                                        <select name="periode_audit" id="periode_audit" class="form-control">
                                            <option {{ $ncr->periode_audit == 'I' ? 'selected' : '' }} value="I">I
                                            </option>
                                            <option {{ $ncr->periode_audit == 'II' ? 'selected' : '' }} value="II">II
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="proses_audit">Proses Audit <span class="text-danger">*</span></label>
                                        <select name="proses_audit" id="proses_audit"
                                            onchange="disableAuditorEksternal(this)" class="form-control">
                                            <option {{ $ncr->proses_audit == 'Internal' ? 'selected' : '' }}
                                                value="Internal">Internal</option>
                                            <option {{ $ncr->proses_audit == 'Eksternal' ? 'selected' : '' }} value="Eksternal">Eksternal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tema_audit">Tema Audit <span class="text-danger">*</span></label>
                                        <select name="tema_audit" id="tema_audit" class="form-control">
                                            @foreach ($temas as $tema)
                                                <option value="{{ $tema['id'] }}"
                                                    {{ $ncr->tema_audit == $tema['id'] ? 'selected' : '' }}>
                                                    {{ $tema['nama_tema'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="objek_audit">Objek Audit <span class="text-danger">*</span></label>
                                        <select name="objek_audit" id="objek_audit" class="selectpicker form-control"
                                            data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            @foreach ($data as $dat)
                                                <option value="{{ $dat['div_code'] }}"
                                                    {{ $ncr->name_objek_audit == $dat['div_name'] ? 'selected' : '' }}
                                                    name_objek_audit="{{ $dat['div_name'] }}">
                                                    {{ $dat['div_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="name_objek_audit" id="name_objek_audit" value="{{ old('name_objek_audit') }} {{ $ncr->name_objek_audit }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bab_audit">Bab yang di audit <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="bab_audit" id="bab_audit"
                                            class="form-control  form-control-sm" value="{{ $ncr->bab_audit }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dok_acuan">Dokumen Acuan <span class="text-danger">*</span></label>
                                        <input type="text" name="dok_acuan" id="dok_acuan"
                                            class="form-control  form-control-sm" value="{{ $ncr->dok_acuan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="" selected disabled>- Pilih -</option>
                                            <option {{ $ncr->kategori == 'Mayor' ? 'selected' : '' }} value="Mayor">Mayor
                                            </option>
                                            <option {{ $ncr->kategori == 'Minor' ? 'selected' : '' }} value="Minor">Minor
                                            </option>
                                            <option {{ $ncr->kategori == 'Kritikal' ? 'selected' : '' }} value="Kritikal">
                                                Kritikal
                                            </option>
                                            <option {{ $ncr->kategori == 'Observasi' ? 'selected' : '' }}
                                                value="Observasi">Observasi
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uraian_ncr">Uraian Ketidaksesuaian <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="uraian_ncr" id="uraian_ncr" rows="5">{{ $ncr->uraian_ncr }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_auditor">Nama Auditor <span class="text-danger">*</span></label>
                                        <select name="nama_auditor" id="nama_auditor" class="selectpicker form-control"
                                            data-live-search="true" data-size="5">
                                            @foreach ($pegawai as $peg)
                                                <option value="{{ $peg['name'] }}"
                                                    {{ $ncr->nama_auditor == $peg['name'] ? 'selected' : '' }}
                                                    nip_penerbitan_auditor="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_penerbitan_auditor" id="nip_penerbitan_auditor"
                                            value="{{ old('nip_penerbitan_auditor') }} {{ $ncr->nip_penerbitan_auditor }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="auditor_eksternal">Nama Auditor Eksternal <span class="text-danger">
                                                *</span></label>
                                        <input type="text" name="auditor_eksternal" id="auditor_eksternal"
                                            class="form-control  form-control-sm" value="{{ $ncr->auditor_eksternal }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Auditee-->
        <div class="modal fade" id="auditee_modal" tabindex="-1" aria-labelledby="auditee_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditee_modalLabel">
                            @if ($ncr->nama_diakui_m_sm == null)
                                Tambah data
                            @else
                                Edit data
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-ncr.updatencr_auditee', $ncr->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_diakui_m_sm">Nama diakui oleh (M/SM) <span
                                                class="text-danger">*</span></label>
                                        <select name="nama_diakui_m_sm" id="nama_diakui_m_sm"
                                            class="selectpicker form-control" data-live-search="true" data-size="5">
                                            <option disabled selected value="">-- Pilih --</option>
                                            @foreach ($pegawai as $peg)
                                                <option value="{{ $peg['name'] }}"
                                                    {{ $ncr->nama_diakui_m_sm == $peg['name'] ? 'selected' : '' }}
                                                    @if (old('nama_diakui_m_sm') == $peg['name']) selected @endif
                                                    jabatan_diakui_m_sm="{{ $peg['label'] }}"
                                                    nip_m_sm="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_m_sm" id="nip_m_sm"
                                            value="{{ old('nip_m_sm') }} {{ $ncr->nip_m_sm }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan_diakui_m_sm">Jabatan diakui oleh (M/SM) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="jabatan_diakui_m_sm" id="jabatan_diakui_m_sm"
                                            class="form-control" value="{{ old('jabatan_diakui_m_sm') }} {{ $ncr->jabatan_diakui_m_sm }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_disetujui_sm_gm">Nama disetujui oleh (SM/GM) <span
                                                class="text-danger">*</span></label>
                                        <select name="nama_disetujui_sm_gm" id="nama_disetujui_sm_gm"
                                            class="selectpicker form-control" data-live-search="true" data-size="5">
                                            <option disabled selected value="">-- Pilih --</option>
                                            @foreach ($pegawai as $peg)
                                                <option value="{{ $peg['name'] }}"
                                                    {{ $ncr->nama_disetujui_sm_gm == $peg['name'] ? 'selected' : '' }}
                                                    @if (old('nama_disetujui_sm_gm') == $peg['name']) selected @endif
                                                    jabatan_disetujui_sm_gm="{{ $peg['label'] }}"
                                                    nip_sm_gm="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_sm_gm" id="nip_sm_gm"
                                            value="{{ old('nip_sm_gm') }} {{ $ncr->nip_sm_gm }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan_disetujui_sm_gm">Jabatan disetujui oleh (SM/GM) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="jabatan_disetujui_sm_gm" id="jabatan_disetujui_sm_gm"
                                            class="form-control" value="{{ old('jabatan_disetujui_sm_gm') }} {{ $ncr->jabatan_disetujui_sm_gm }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- {{-- <!-- Modal Tindak Lanjut Auditee--> --}}
        <div class="modal fade" id="auditee2_modal" tabindex="-1" aria-labelledby="auditee2_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditee2_modalLabel">
                            @if ($ncr->akar_masalah == null)
                                Tambah data
                            @else
                                Edit data
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-ncr.updatencr_auditee2', $ncr->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_sm_verif">Nama disetujui oleh (SM/GM) <span
                                                class="text-danger">*</span></label>
                                        <select name="nama_sm_verif" id="nama_sm_verif" class="selectpicker form-control"
                                            data-live-search="true" data-size="5">
                                            <option disabled selected value="">-- Pilih --</option>
                                            @foreach ($pegawai as $peg)
                                                <option value="{{ $peg['name'] }}"
                                                    {{ $ncr->nama_sm_verif == $peg['name'] ? 'selected' : '' }}
                                                    @if (old('nama_sm_verif') == $peg['name']) selected @endif
                                                    jabatan_disetujui_sm_gm2="{{ $peg['label'] }}"
                                                    nip_sm_gm2="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_sm_gm2" id="nip_sm_gm2"
                                            value="{{ old('nip_sm_gm2') }} {{ $ncr->nip_sm_gm2 }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan_disetujui_sm_gm2">Jabatan disetujui oleh (SM/GM) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="jabatan_disetujui_sm_gm2"
                                            id="jabatan_disetujui_sm_gm2" class="form-control"
                                            value="{{ old('jabatan_disetujui_sm_gm2') }} {{ $ncr->jabatan_disetujui_sm_gm2 }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uraian_perbaikan">Uraian perbaikan <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="uraian_perbaikan" id="uraian_perbaikan" rows="5">{{ old('uraian_perbaikan') }} {{ $ncr->uraian_perbaikan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uraian_pencegahan">Uraian pencegahan untuk menjamin tidak terulang
                                            <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="uraian_pencegahan" id="uraian_pencegahan" rows="5">{{ old('uraian_pencegahan') }} {{ $ncr->uraian_pencegahan }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akar_masalah">Akar penyebab masalah <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="akar_masalah" id="akar_masalah"
                                            class="form-control  form-control-sm" value="{{ old('akar_masalah') }} {{ $ncr->akar_masalah }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div
                                            class="md:flex pb-5  md:space-x-5  md:justify-between my-auto items-center w-full">
                                            <label for="">Lampiran</label>
                                            <div class="md:w-3/5 ">
                                                <input name="lampiran[]" id="lampiran"
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    aria-describedby="file_input_help" type="file"
                                                    accept="application/pdf" multiple>
                                                <p id="files-area" class="">
                                                    <span id="filesList">
                                                        @foreach ($lampiran as $lamp)
                                                            <span class="file-block" id="file-{{ $lamp->id }}">
                                                                <span class="file-delete">
                                                                    <span>+</span>
                                                                </span>
                                                                <span class="name">{{ $lamp->nama_lampiran }}</span>
                                                            </span>
                                                            <input type="hidden" name="nama_lampiran[]"
                                                                value={{ $lamp->nama_lampiran }}
                                                                id="file-hidden-{{ $lamp->id }}">
                                                        @endforeach
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tindak Lanjut Auditor-->
        <div class="modal fade" id="auditor2_modal" tabindex="-1" aria-labelledby="auditor2_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditor2_modalLabel">
                            @if ($ncr->uraian_verif == null)
                                Tambah data
                            @else
                                Edit data
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-ncr.updatencr_auditor2', $ncr->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uraian_verif">Uraian verifikasi <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="uraian_verif" id="uraian_verif" rows="5">{{ old('uraian_verif') }} {{ $ncr->uraian_verif }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hasil_verif">Hasil verifikasi <span
                                                class="text-danger">*</span></label>
                                        <select name="hasil_verif" id="hasil_verif" class="form-control">
                                            <option selected disabled value="">-- Pilih --</option>
                                            <option {{ $ncr->hasil_verif == 'efektif' ? 'selected' : '' }}
                                                value="efektif" @selected(old('hasil_verif') == 'efektif')>Efektif
                                            </option>
                                            <option {{ $ncr->hasil_verif == 'tdk_efektif' ? 'selected' : '' }}
                                                value="tdk_efektif" @selected(old('hasil_verif') == 'tdk_efektif')>Tidak Efektif
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="diverif_oleh_auditor">Diverifikasi oleh <span
                                                class="text-danger">*</span></label>
                                        <select name="diverif_oleh_auditor" id="diverif_oleh_auditor"
                                            class="selectpicker form-control" data-live-search="true" data-size="5">
                                            <option disabled selected value="">-- Pilih --</option>
                                            @foreach ($pegawai as $peg)
                                                <option value="{{ $peg['name'] }}"
                                                    {{ $ncr->diverif_oleh_auditor == $peg['name'] ? 'selected' : '' }}
                                                    @if (old('diverif_oleh_auditor') == $peg['name']) selected @endif
                                                    nip_tl_auditor="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_tl_auditor" id="nip_tl_auditor"
                                            value="{{ old('nip_tl_auditor') }} {{ $ncr->nip_tl_auditor }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Wakil Manajemen-->
        <div class="modal fade" id="wm_modal" tabindex="-1" aria-labelledby="wm_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="wm_modalLabel">
                            @if ($ncr->verif_wm == null)
                                Tambah data
                            @else
                                Edit data
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('data-ncr.updatencr_wm', $ncr->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="verif_wm">Verifikasi Wakil Manajemen <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="verif_wm" id="verif_wm" rows="5">{{ old('verif_wm') }} {{ $ncr->verif_wm }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function disableAuditorEksternal() {
            var prosesAudit = $('#proses_audit').val();
            console.log("proses_audit value:", prosesAudit);
            if (prosesAudit === 'Eksternal') {
                document.getElementById('auditor_eksternal').disabled = false;
                console.log("auditor_eksternal is enabled");
            } else {
                document.getElementById('auditor_eksternal').disabled = true;
                console.log("auditor_eksternal is disabled");
            }
        }

        $(document).ready(function() {
            disableAuditorEksternal();
            $('#proses_audit').on('change', function() {
                disableAuditorEksternal();
            });
            $('#auditor1_modal').on('show.bs.modal', function() {
                disableAuditorEksternal();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker({
                var name = selectedOption.text().slice(0, selectedOption.text().indexOf('/'));
            });
        });
    </script>

    <script>
        document.getElementById("nama_auditor").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var nip = selectedOption.getAttribute("nip_penerbitan_auditor");

            document.getElementById("nip_penerbitan_auditor").value = nip;
        });

        document.getElementById("nama_diakui_m_sm").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var jabatan = selectedOption.getAttribute("jabatan_diakui_m_sm");
            var nip = selectedOption.getAttribute("nip_m_sm");

            document.getElementById("jabatan_diakui_m_sm").value = jabatan;
            document.getElementById("nip_m_sm").value = nip;
        });

        document.getElementById("nama_disetujui_sm_gm").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var jabatan = selectedOption.getAttribute("jabatan_disetujui_sm_gm");
            var nip = selectedOption.getAttribute("nip_sm_gm");

            document.getElementById("jabatan_disetujui_sm_gm").value = jabatan;
            document.getElementById("nip_sm_gm").value = nip;
        });

        document.getElementById("nama_sm_verif").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var jabatan = selectedOption.getAttribute("jabatan_disetujui_sm_gm2");
            var nip = selectedOption.getAttribute("nip_sm_gm2");

            document.getElementById("jabatan_disetujui_sm_gm2").value = jabatan;
            document.getElementById("nip_sm_gm2").value = nip;
        });

        document.getElementById("diverif_oleh_auditor").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var nip = selectedOption.getAttribute("nip_tl_auditor");

            document.getElementById("nip_tl_auditor").value = nip;
        });

        document.getElementById("objek_audit").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var name_objek_audit = selectedOption.getAttribute("name_objek_audit");

            document.getElementById("name_objek_audit").value = name_objek_audit;
        });
    </script>

    <script>
        const dt = new DataTransfer();
        let fileIdCounter = 1;
        const maxFiles = 6;

        $("#lampiran").on('change', function(e) {
            let existingFilesCount = $("#filesList").children(".file-block").length;
            let totalFilesCount = existingFilesCount + this.files.length;

            if (totalFilesCount > maxFiles) {
                alert(`Anda hanya dapat mengunggah maksimal ${maxFiles} file.`);
                let excessFiles = Array.from(this.files).slice(0, maxFiles - existingFilesCount);
                this.files = new FileList(excessFiles);

                $("#lampiran").val('');
            }

            for (var i = 0; i < this.files.length; i++) {
                let fileBloc = $('<span/>', {
                        class: 'file-block',
                        id: 'file-' + fileIdCounter
                    }),
                    fileName = $('<span/>', {
                        class: 'name',
                        text: this.files.item(i).name
                    });
                fileBloc.append('<span class="file-delete"><span>+</span></span>')
                    .append(fileName);
                $("#filesList").append(fileBloc);

                let hiddenInput = $('<input/>', {
                    type: 'hidden',
                    name: 'nama_lampiran[]',
                    value: this.files.item(i).name
                });
                hiddenInput.attr('id', 'file-hidden-' + fileIdCounter);
                $("#filesList").append(hiddenInput);

                fileIdCounter++;
            };

            for (let file of this.files) {
                dt.items.add(file);
            }

            this.files = dt.files;
        });

        $(document).on('click', 'span.file-delete', function() {
            let fileId = $(this).parent().attr('id');
            let fileName = $(this).prev('.name').text();

            $(this).parent().remove();

            $('#file-hidden-' + fileId.substring(5)).remove();

            for (let i = 0; i < dt.items.length; i++) {
                if (fileName === dt.items[i].getAsFile().name) {
                    dt.items.remove(i);
                    break;
                }
            }

            document.getElementById('lampiran').files = dt.files;

            let deletedFileId = fileId.substring(5);
            $('<input>').attr({
                type: 'hidden',
                name: 'deleted_lampiran[]',
                value: deletedFileId
            }).appendTo('form');
        });
    </script>
@endsection
