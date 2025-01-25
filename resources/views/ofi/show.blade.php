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

                    <!--Form Penerbitan OFI-->
                    <div class="card-body">
                        <div class="row" style="">
                            <div class="col-12 my-2 bg-light p-2 text-center">
                                <h5>Penerbitan OFI</h5>
                            </div>

                            <!--Form Auditor-->
                            <div class="col-md-6 border border-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <div><span class="font-weight-bold badge badge-info p-2"><i
                                                class="far fa-user fa-fw"></i>Auditor</span>
                                    </div>
                                    @if (request()->query('page') != 'monitoring-tl.index')
                                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditor')
                                            <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                data-target="#auditor1_modal"
                                                {{ $ofi->verif_admin == 'release' ? 'disabled' : '' }}><i
                                                    class="far fa-edit fa-fw"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table mt-2" width="100%">
                                        <tr>
                                            <td>No OFI</td>
                                            <td>:</td>
                                            <td>{{ $ofi->no_ofi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kepada</td>
                                            <td>:</td>
                                            <td>{{ $ofi->kepada }}</td>
                                        </tr>
                                        <tr>
                                            <td>Periode Audit</td>
                                            <td>:</td>
                                            <td>{{ $ofi->periode_audit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Proses Audit</td>
                                            <td>:</td>
                                            <td>{{ $ofi->proses_audit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tema Audit</td>
                                            <td>:</td>
                                            <td>{{ $ofi->tema->nama_tema }}</td>
                                        </tr>
                                        <tr>
                                            <td>Objek Audit</td>
                                            <td>:</td>
                                            <td>
                                                @foreach ($data as $dat)
                                                    @if ($ofi->name_objek_audit == $dat['div_name'])
                                                        {{ $dat['div_name'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Terbit OFI</td>
                                            <td>:</td>
                                            <td>
                                                {{ $ofi->tgl_terbitofi }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Deadline OFI</td>
                                            <td>:</td>
                                            <td>
                                                @if ($ofi->verif_admin != 'open')
                                                    {{ $ofi->tgl_deadline }}
                                                    @php
                                                        $days = \Carbon\Carbon::parse($ofi->tgl_deadline)->diffInDays(
                                                            \Carbon\Carbon::now(),
                                                        );
                                                    @endphp

                                                    @if ($days < 0)
                                                        <span class="font-weight-bold text-danger">(Overdue)</span>
                                                    @else
                                                        <span class="font-weight-bold text-success">(
                                                            {{ \Carbon\Carbon::parse($ofi->tgl_deadline)->diffInDays(\Carbon\Carbon::now()) }}
                                                            days later)</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dari Bagian Departemen</td>
                                            <td>:</td>
                                            <td width="50%">
                                                @foreach ($data as $dat)
                                                    @if ($ofi->dari_bagian_dept == $dat['div_code'])
                                                        {{ $dat['div_name'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Proyek</td>
                                            <td>:</td>
                                            <td>{{ $ofi->proyek }}</td>
                                        </tr>
                                        <tr>
                                            <td>Usulan peningkatan (Produk/Proses/Sistem Mutu)</td>
                                            <td>:</td>
                                            <td>{{ $ofi->usulan_peningkatan }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Identitas (No.Part/No.Tack/No.Dokumen)</td>
                                            <td>:</td>
                                            <td>{{ $ofi->identitas }}</td>
                                        </tr>
                                        <tr>
                                            <td>No.Identitas</td>
                                            <td>:</td>
                                            <td>{{ $ofi->no_identitas }}</td>
                                        </tr>
                                        <tr>
                                            <td>Departemen yang mengerjakan</td>
                                            <td>:</td>
                                            <td width="50%">
                                                @foreach ($data as $dat)
                                                    @if ($ofi->dept_ygmngrjkn == $dat['div_code'])
                                                        {{ $dat['div_name'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Uraian Permasalahan</td>
                                            <td>:</td>
                                            <td>
                                                {{ $ofi->uraian_permasalahan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Uraian Peningkatan</td>
                                            <td>:</td>
                                            <td>{{ $ofi->uraian_peningkatan }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Diusulkan oleh</td>
                                            <td>:</td>
                                            <td> {{ $ofi->diusulkan_oleh }}</td>
                                        </tr>
                                        @if ($ofi->proses_audit == 'Eksternal')
                                        <tr>
                                            <td>Nama auditor eksternal</td>
                                            <td>:</td>
                                            <td> {{ $ofi->auditor_eksternal }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>Tanggal diusulkan</td>
                                            <td>:</td>
                                            <td width="50%">{{ $ofi->tgl_diusulkan }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Tanda tangan diusulkan oleh</td>
                                            <td>:</td>
                                            <td width="50%">
                                                @if ($ofi->ttd_dept_pengusul != null)
                                                    <img src="{{ asset('storage/ttd/' . $ofi->ttd_dept_pengusul) }}"
                                                        alt="{{ $ofi->ttd_dept_pengusul }}" width="50" height="50">
                                                @endif
                                            </td>
                                        </tr> --}}
                                    </table>
                                </div>

                                <!--Button submit auditor-->
                                {{-- @if ($ofi->submit_auditor != null)
                                    <div class="text-center bg-success p-2">
                                        <h6 class="text-white">Released By Auditor</h5>
                                    </div>
                                @endif
                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditor')
                                    @if ($ofi->submit_auditor == null)
                                        <div>
                                            <form action="{{ route('data-ofi.submit_auditor', $ofi->id) }}" method="POST"
                                                id="submit_auditor">
                                                @csrf
                                                <input type="hidden" name="submit_auditor" id="submit_auditor" value="submit_auditor">
                                                <button
                                                    onclick="return confirm('Apakah Anda yakin ingin submit data OFI ini?')"
                                                    class="btn btn-primary btn-block" id="submit_auditor-button">Submit</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif --}}
                            </div>

                            <!--form admin pertama-->
                            <div class="col-md-6 border border-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <div><span class="font-weight-bold badge badge-success p-2"><i
                                                class="far fa-user fa-fw"></i>Admin</span></div>
                                    @if (request()->query('page') != 'monitoring-tl.index')
                                        @if (auth()->user()->role->role == 'Admin')
                                            <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                data-target="#admin1_modal"
                                                {{ $ofi->verif_admin == 'release' ? 'disabled' : '' }}><i
                                                    class="far fa-edit fa-fw"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table mt-4" width="100%">
                                        <tr>
                                            <td>Nama disetujui oleh</td>
                                            <td>:</td>
                                            <td width="65%">{{ $ofi->nama_disetujui_oleh }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan disetujui oleh</td>
                                            <td>:</td>
                                            <td>{{ $ofi->jabatan_disetujui_oleh }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal disetujui</td>
                                            <td>:</td>
                                            <td>{{ $ofi->tgl_disetujui_admin }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- button admin pertama -->
                                @if ($ofi->verif_admin == 'release')
                                    <div class="text-center bg-success p-2">
                                        <h6 class="text-white">Released By Admin</h6>
                                    </div>
                                @endif
                                @if (auth()->user()->role->role == 'Admin')
                                    @if ($ofi->nama_disetujui_oleh != null && $ofi->verif_admin != 'release')
                                        <div>
                                            <form action="{{ route('data-ofi.release', $ofi->id) }}" method="POST"
                                                id="release">
                                                @csrf
                                                <input type="hidden" name="release" id="release" value="release">
                                                <button
                                                    onclick="return confirm('Apakah Anda yakin ingin merilis data OFI ini?')"
                                                    class="btn btn-primary btn-block" id="release-button">Release</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif

                                <!--Form Wakil Manajemen Pertama-->
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <div><span class="font-weight-bold badge badge-danger p-2"><i
                                                        class="far fa-user fa-fw"></i>Wakil Manajemen</span></div>

                                            @if (request()->query('page') != 'monitoring-tl.index')
                                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen')
                                                    @if ($ofi->verif_admin == 'release')
                                                        <button id="edit-button-wm1" class="btn btn-xs btn-warning"
                                                            data-toggle="modal" data-target="#wakilmanajemen1_modal"
                                                            {{ $ofi->disposisi != null ? 'disabled' : '' }}>
                                                            <i class="far fa-edit fa-fw"></i></button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mt-3" width="100%">
                                                <tr>
                                                    <td>Disposisi Wakil Manajemen </td>
                                                    <td>:</td>
                                                    <td>{{ $ofi->disposisi }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Disetujui oleh</td>
                                                    <td>:</td>
                                                    <td width="65%">{{ $ofi->disetujui_oleh }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Disetujui oleh jabatan</td>
                                                    <td>:</td>
                                                    <td>{{ $ofi->disetujui_oleh_jabatan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal disetujui</td>
                                                    <td>:</td>
                                                    <td>{{ $ofi->tgl_disetujui_wm }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Diselesaikan oleh </td>
                                                    <td>:</td>
                                                    <td>
                                                        @foreach ($data as $dat)
                                                            @if ($ofi->diselesaikan_oleh == $dat['div_code'])
                                                                {{ $dat['div_name'] }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- button wakil manajemen pertama -->
                                        <form action="{{ route('data-ofi.open', $ofi->id) }}" method="POST"
                                            id="open">
                                            @if ($ofi->disposisi == 'OFI Diterima')
                                                <div class="text-center bg-success p-2">
                                                    <h6 class="text-white">OFI Diterima By Wakil Manajemen</h6>
                                                </div>
                                            @elseif ($ofi->disposisi == 'OFI Ditolak')
                                                <div class="text-center bg-danger p-2">
                                                    <h6 class="text-white">OFI Ditolak By Wakil Manajemen</h6>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="">
                            <div class="col-12 my-2 bg-light p-2 text-center">
                                <h5>Tindak lanjut OFI</h5>
                            </div>

                            <!--Form Tindak Lanjut OFI Auditee-->
                            <div class="col-md-6 border border-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <div><span class="font-weight-bold badge badge-warning p-2"><i
                                                class="far fa-user fa-fw"></i>Auditee</span></div>

                                    @if (request()->query('page') != 'monitoring-tl.index')
                                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditee')
                                            @if ($ofi->disposisi == 'OFI Diterima')
                                                <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                    data-target="#auditee1_modal"
                                                    {{ $ofi->submit_auditee == 'submit' ? 'disabled' : '' }}><i
                                                        class="far fa-edit fa-fw"></i></button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table class="table mt-2" width="100%">
                                        <tr>
                                            <td>Tindak lanjut usulan peningkatan</td>
                                            <td>:</td>
                                            <td width="48%">
                                                {{ $ofi->tl_usulanofi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama ditindaklanjuti oleh (M/SM)</td>
                                            <td>:</td>
                                            <td>{{ $ofi->nama_tl_oleh }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan ditindaklanjuti oleh (M/SM)</td>
                                            <td>:</td>
                                            <td>{{ $ofi->jabatan_tl_oleh }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal tindak lanjut</td>
                                            <td>:</td>
                                            <td>{{ $ofi->tgl_tl }}</td>
                                        </tr>
                                        {{-- <tr>
                                                        <td style="font-size: 25px;">Bukti</td>
                                                        <td ></td>
                                                        <td></td>
                                                    </tr> --}}
                                        @foreach ($lampiran as $lamp)
                                            <tr>
                                                <td>Lampiran {{ $loop->iteration }}</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($ofi->id == $lamp['id_ofi'])
                                                        <a href="{{ asset('storage/pdf/' . $lamp->nama_lampiran) }}"
                                                            target="_blank">{{ $lamp['nama_lampiran'] }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            @if ($ofi->status_tl_admin == 'Tolak')
                                                <td>Alasan</td>
                                                <td>:</td>
                                                <td width="48%">
                                                    {{ $ofi->alasan }}
                                                </td>
                                            @endif
                                        </tr>
                                        </tr>
                                    </table>
                                </div>

                                <!--Button Submit Tindak Lanjut Auditee-->
                                @if ($ofi->submit_auditee != null)
                                    <div class="text-center bg-success p-2">
                                        <h6 class="text-white">Submited By Auditee</h5>
                                    </div>
                                @endif

                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Auditee')
                                    @if ($ofi->tl_usulanofi != null && $ofi->submit_auditee == null)
                                        <div>
                                            <form action="{{ route('data-ofi.submit', $ofi->id) }}" method="POST"
                                                id="submit_auditee">
                                                @csrf
                                                <input type="hidden" name="submit_auditee" id="submit_auditee"
                                                    value="submit">
                                                <button
                                                    onclick="return confirm('Apakah anda yakin ingin submit data OFI ini?')"
                                                    class="btn btn-primary btn-block" id="submit-button">Submit</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <!--Form TL Admin-->
                            <div class="col-md-6 border border-light p-3 rounded">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <div><span class="font-weight-bold badge badge-success p-2"><i
                                                        class="far fa-user fa-fw"></i>Admin</span></div>

                                            @if (request()->query('page') != 'monitoring-tl.index')
                                                @if (auth()->user()->role->role == 'Admin')
                                                    @if ($ofi->submit_auditee != null)
                                                        <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                            data-target="#admin2_modal"
                                                            {{ $ofi->status_tl_admin == 'Terima' ? 'disabled' : '' }}><i
                                                                class="far fa-edit fa-fw"></i></button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <div style="">
                                            <table class="table mt-2" width="100%">
                                                <tr>
                                                    <td>Status Tindak Lanjut Admin</td>
                                                    <td>:</td>
                                                    <td width="65%">
                                                        {{ $ofi->status_tl_admin }}</td>
                                                </tr>
                                                <tr>
                                                    @if ($ofi->status_tl_admin == 'Tolak')
                                                        <td>Alasan</td>
                                                        <td>:</td>
                                                        <td>
                                                            {{ $ofi->alasan }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </div>

                                        <!--button tl admin -->
                                        @if ($ofi->status_tl_admin == 'Terima')
                                            <div class="text-center bg-success p-2">
                                                <h6 class="text-white">OFI Diterima By Admin</h5>
                                            </div>
                                        @endif

                                        <!--Form Wakil Manajemen Kedua-->
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold badge badge-danger p-2"><i
                                                                class="far fa-user fa-fw"></i>Wakil manajemen</span>
                                                    </div>

                                                    @if (request()->query('page') != 'monitoring-tl.index')
                                                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen' || auth()->user()->role->role == 'Auditor')
                                                            @if ($ofi->status_tl_admin == 'Terima')
                                                                <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                                    data-target="#wakilmanajemen2_modal"
                                                                    {{ $ofi->status_dokumen == 'close' ? 'disabled' : '' }}><i
                                                                        class="far fa-edit fa-fw"></i></button>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table mt-2" width="100%">
                                                        <tr>
                                                            <td>Uraian Verifikasi</td>
                                                            <td>:</td>
                                                            <td width="63%">
                                                                {{ $ofi->uraian_verif }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hasil Verifikasi</td>
                                                            <td>:</td>
                                                            <td> {{ $ofi->hasil_verif }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Verifikator</td>
                                                            <td>:</td>
                                                            <td>{{ $ofi->nama_verifikator }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Verifikasi</td>
                                                            <td>:</td>
                                                            <td>{{ $ofi->tgl_verif }}</td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <!--Button Close Wakil Manajemen Kedua-->
                                                <div class="card-footer bg-white">
                                                    @if ($ofi->status_dokumen == 'close')
                                                        <div class="text-center bg-success p-2">
                                                            <h6 class="text-white">Closed By Wakil Manajemen</h5>
                                                        </div>
                                                    @endif
                                                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen')
                                                        @if ($ofi->hasil_verif != null && $ofi->status_dokumen != 'close')
                                                            <div>
                                                                <form action="{{ route('data-ofi.close_wm', $ofi->id) }}"
                                                                    method="POST" id="status_dokumen">
                                                                    @csrf
                                                                    <input type="hidden" name="status_dokumen"
                                                                        id="status_dokumen" value="">
                                                                    <button
                                                                        onclick="return confirm('Apakah anda yakin ingin mengakhiri proses audit ini?')"
                                                                        class="btn btn-primary btn-block"
                                                                        id="close-button">Close</button>
                                                                </form>
                                                            </div>
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
                        <div class="modal-body">
                            <form id="editForm" action="{{ route('ofi.update_auditor', $ofi->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                            </form>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kepada">Kepada <span class="text-danger"> *</span></label>
                                    <select name="kepada" id="kepada" class="form-control">
                                        <option {{ $ofi->kepada == 'WakilManajemen' ? 'selected' : '' }}
                                            value="Wakil Manajemen">Wakil Manajemen
                                        </option>
                                        <option
                                            {{ $ofi->kepada == 'Ketua Fungsi Kepatuhan Anti Penyuapan' ? 'selected' : '' }}
                                            value="Ketua Fungsi Kepatuhan Anti Penyuapan">Ketua Fungsi Kepatuhan Anti
                                            Penyuapan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="periode_audit">Periode Audit <span class="text-danger">*</span></label>
                                    <select name="periode_audit" id="periode_audit" class="form-control">
                                        <option {{ $ofi->periode_audit == 'I' ? 'selected' : '' }} value="I">I
                                        </option>
                                        <option {{ $ofi->periode_audit == 'II' ? 'selected' : '' }} value="II">II
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="diusulkan_oleh">Diusulkan oleh<span class="text-danger">*</span></label>
                                    <select name="diusulkan_oleh" id="diusulkan_oleh" class="selectpicker form-control"
                                        data-live-search="true" data-size="5">
                                        @foreach ($pegawai as $peg)
                                            <option value="{{ $peg['name'] }}"
                                                {{ $ofi->diusulkan_oleh == $peg['name'] ? 'selected' : '' }}
                                                nip_auditor="{{ $peg['nip'] }}">
                                                {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="nip_auditor" id="nip_auditor"
                                        value="{{ old('nip_auditor') }} {{ $ofi->nip_auditor }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="auditor_eksternal">Nama Auditor Eksternal <span class="text-danger"> *</span></label>
                                    <input type="text" name="auditor_eksternal" id="auditor_eksternal"
                                        class="form-control  form-control-sm" value="{{ $ofi->auditor_eksternal }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="proses_audit">Proses Audit <span class="text-danger"> *</span></label>
                                    <select name="proses_audit" id="proses_audit"  onchange="disableAuditorEksternal(this)" class="form-control">
                                        <option {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }} value="Internal">Internal
                                        </option>
                                        <option {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }} value="Eksternal">Eksternal
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tema_audit">Tema Audit <span class="text-danger"> *</span></label>
                                    <select name="tema_audit" id="tema_audit" class="form-control">
                                        @foreach ($temas as $tema)
                                            <option value="{{ $tema['id'] }}"
                                                {{ $ofi->tema_audit == $tema['id'] ? 'selected' : '' }}>
                                                {{ $tema['nama_tema'] }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="objek_audit">Objek Audit <span class="text-danger"> *</span></label>
                                    <select name="objek_audit" id="objek_audit" class="selectpicker form-control"
                                        data-live-search="true" data-size="5">
                                        <option value="">- Pilih -</option>
                                        @foreach ($data as $dat)
                                            <option value="{{ $dat['div_code'] }}"
                                                {{ $ofi->name_objek_audit == $dat['div_name'] ? 'selected' : '' }}
                                                name_objek_audit="{{ $dat['div_name'] }}">
                                                {{ $dat['div_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="name_objek_audit" id="name_objek_audit"
                                        value="{{ old('name_objek_audit') }} {{ $ofi->name_objek_audit }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dari_bagian_dept">Dari bagian departemen <span
                                            class="text-danger">*</span></label>
                                    <select name="dari_bagian_dept" id="dari_bagian_dept"
                                        class="selectpicker form-control" data-live-search="true" data-size="5">
                                        <option value="">- Pilih -</option>
                                        @foreach ($data as $dat)
                                            <option value="{{ $dat['div_code'] }}"
                                                {{ $ofi->dari_bagian_dept == $dat['div_code'] ? 'selected' : '' }}>
                                                {{ $dat['div_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="proyek">Proyek <span class="text-danger"> *</span></label>
                                    <input type="text" name="proyek" id="proyek"
                                        class="form-control  form-control-sm" value="{{ $ofi->proyek }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usulan_peningkatan">Usulan peningkatan (Produk/Proses/Sistem
                                        Mutu)
                                        mutu <span class="text-danger"> *</span></label>
                                    <select name="usulan_peningkatan" id="usulan_peningkatan" class="form-control">
                                        <option disabled selected value="">-- Pilih --</option>
                                        <option {{ $ofi->usulan_peningkatan == 'Produk' ? 'selected' : '' }}
                                            value="Produk">
                                            Produk
                                        </option>
                                        <option {{ $ofi->usulan_peningkatan == 'Proses' ? 'selected' : '' }}
                                            value="Proses">
                                            Proses
                                        </option>
                                        <option {{ $ofi->usulan_peningkatan == 'Sistem Mutu' ? 'selected' : '' }}
                                            value="Sistem Mutu">
                                            Sistem Mutu
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="identitas">Identitas (No.Part/No.Tack/No.Dokumen) <span
                                            class="text-danger">*</span></label>
                                    <select name="identitas" id="identitas" class="form-control">
                                        <option disabled selected value="">-- Pilih --</option>
                                        <option {{ $ofi->identitas == 'No.Part' ? 'selected' : '' }} value="No.Part">
                                            No.Part
                                        </option>
                                        <option {{ $ofi->identitas == 'No.Tack' ? 'selected' : '' }} value="No.Tack">
                                            No.Tack
                                        </option>
                                        <option {{ $ofi->identitas == 'No.Dokumen' ? 'selected' : '' }}
                                            value="No.Dokumen">
                                            No.Dokumen
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_identitas">No.Identitas</label>
                                    <input type="text" name="no_identitas" id="no_identitas"
                                        class="form-control  form-control-sm" value="{{ $ofi->no_identitas }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dept_ygmngrjkn">Departemen yang mengerjakan <span
                                            class="text-danger">*</span></label>
                                    <select name="dept_ygmngrjkn" id="dept_ygmngrjkn" class="selectpicker form-control"
                                        data-live-search="true" data-size="5">
                                        <option value="">- Pilih -</option>
                                        @foreach ($data as $dat)
                                            <option value="{{ $dat['div_code'] }}"
                                                {{ $ofi->dept_ygmngrjkn == $dat['div_code'] ? 'selected' : '' }}>
                                                {{ $dat['div_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uraian_permasalahan">Uraian Permasalahan <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="uraian_permasalahan" id="uraian_permasalahan" rows="5">{{ $ofi->uraian_permasalahan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uraian_peningkatan">Uraian Peningkatan <span class="text-danger">
                                            *</span></label>
                                    <textarea class="form-control" name="uraian_peningkatan" id="uraian_peningkatan" rows="5">{{ $ofi->uraian_peningkatan }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_diusulkan">Tanggal diusulkan <span
                                            class="text-danger">*</span></label>
                                    <input type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                        max="{{ Carbon\Carbon::now()->addDays(60)->format('Y-m-d') }}"
                                        name="tgl_diusulkan" id="tgl_diusulkan" class="form-control  form-control-sm"
                                        value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="editForm" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal admin pertama --}}
        <div class="modal fade" id="admin1_modal" tabindex="-1" aria-labelledby="admin1_modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="admin1_modalLabel">
                            @if ($ofi->jabatan_disetujui_oleh == null)
                                Tambah data
                            @else
                                Edit data
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm2" action="{{ route('ofi.update_penerbitan_admin', $ofi->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                        </form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_disetujui_oleh">Nama disetujui oleh<span
                                        class="text-danger">*</span></label>
                                <select name="nama_disetujui_oleh" id="nama_disetujui_oleh"
                                    class="selectpicker form-control" data-live-search="true" data-size="5">
                                    <option disabled selected value="">-- Pilih --</option>
                                    @foreach ($pegawai as $peg)
                                        <option value="{{ $peg['name'] }}"
                                            {{ $ofi->nama_disetujui_oleh == $peg['name'] ? 'selected' : '' }}
                                            jabatan_disetujui_oleh="{{ $peg['label'] }}"
                                            nip_penerbitan_admin="{{ $peg['nip'] }}">
                                            {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="nip_penerbitan_admin" id="nip_penerbitan_admin"
                                    value="{{ old('nip_penerbitan_admin') }} {{ $ofi->nip_penerbitan_admin }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan_disetujui_oleh">Jabatan disetujui oleh <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="jabatan_disetujui_oleh" id="jabatan_disetujui_oleh"
                                    class="form-control" value="{{ $ofi->jabatan_disetujui_oleh }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="editForm2" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal wakil manajemen pertama --}}
    <div class="modal fade" id="wakilmanajemen1_modal" tabindex="-1" aria-labelledby="wakilmanajemen1_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wakilmanajemen1_modalLabel">
                        @if ($ofi->disposisi == null)
                            Tambah data
                        @else
                            Edit data
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm3" action="{{ route('ofi.update_penerbitan_wm', $ofi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                    </form>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="disposisi">Disposisi Wakil Manajemen<span class="text-danger">
                                *</span></label>
                            <select name="disposisi" id="disposisi" onchange="disableOFIDitolak(this)"
                                class="form-control">
                                <option disabled selected value="">-- Pilih --</option>
                                <option {{ $ofi->disposisi == 'OFI Ditolak' ? 'selected' : '' }} value="OFI Ditolak" @selected(old('disposisi') == 'OFI Ditolak')>OFI Ditolak</option>
                                <option {{ $ofi->disposisi == 'OFI Diterima' ? 'selected' : '' }} value="OFI Diterima" @selected(old('disposisi') == 'OFI Diterima')>OFI Diterima</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diselesaikan_oleh">Diselesaikan oleh <span class="text-danger">
                                    *</span></label>
                            <select name="diselesaikan_oleh" id="diselesaikan_oleh" class="selectpicker form-control"
                                data-live-search="true" data-size="5">
                                <option value="">- Pilih -</option>
                                @foreach ($data as $dat)
                                    <option value="{{ $dat['div_code'] }}"
                                        {{ $ofi->diselesaikan_oleh == $dat['div_code'] ? 'selected' : '' }}
                                        @if (old('diselesaikan_oleh') == $dat['div_code']) selected @endif
                                        diselesaikan_oleh="{{ $dat['div_name'] }}">
                                        {{ $dat['div_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="editForm3" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
    </div>

    {{-- modal auditee --}}
    <div class="modal fade" id="auditee1_modal" tabindex="-1" aria-labelledby="auditee1_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="auditee1_modalLabel">
                        @if ($ofi->nama_tl_oleh == null)
                            Tambah data
                        @else
                            Edit data
                        @endif
                    </h5>
                    <button type="button" id= "simpanButton" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm4" action="{{ route('ofi.update_auditee', $ofi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                    </form>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tl_usulanofi">Tindak lanjut usulan peningkatan <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="tl_usulanofi" id="tl_usulanofi" rows="5">{{ old('tl_usulanofi') }} {{ $ofi->tl_usulanofi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="nama_tl_oleh">Nama ditindaklanjuti oleh (M/SM)<span class="text-danger">*</span></label>
                            <select name="nama_tl_oleh" id="nama_tl_oleh" class="selectpicker form-control"
                                data-live-search="true" data-size="5">
                                <option disabled selected value="">-- Pilih --</option>
                                @foreach ($pegawai as $peg)
                                    <option value="{{ $peg['name'] }}"
                                        {{ $ofi->nama_tl_oleh == $peg['name'] ? 'selected' : '' }}
                                        @if (old('nama_tl_oleh') == $peg['name']) selected @endif
                                        jabatan_tl_oleh="{{ $peg['label'] }}" nip_auditee="{{ $peg['nip'] }}">
                                        {{ $peg['name'] }} / {{ $peg['nip'] }} / {{ $peg['label'] }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="nip_auditee" id="nip_auditee" value="{{ old('nip_auditee') }} {{ $ofi->nip_auditee }}">
                        </div>
                        <div class="form-group">
                            <label for="jabatan_tl_oleh">Jabatan ditindaklanjuti oleh (M/SM)<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="jabatan_tl_oleh" id="jabatan_tl_oleh" class="form-control"
                                value="{{ old('jabatan_tl_oleh') }} {{ $ofi->jabatan_tl_oleh }}" readonly>
                        </div>
                    </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="lampiran1">Lampiran 1</label>
                        <input type="text" name="NamaLampiran1" id="NamaLampiran1"
                            class="form-control  form-control-sm" value="{{ $ofi->NamaLampiran1 }}">
                        <input type="file" name="lampiran1" id="lampiran1" accept="application/pdf"
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="lampiran2">Lampiran 2</span></label>
                        <input type="text" name="NamaLampiran2" id="NamaLampiran2"
                            class="form-control  form-control-sm" value="{{ $ofi->NamaLampiran2 }}">
                        <input type="file" name="lampiran2" id="lampiran2" accept="application/pdf"
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="lampiran3">Lampiran 3</label>
                        <input type="text" name="NamaLampiran3" id="NamaLampiran3"
                            class="form-control  form-control-sm" value="{{ $ofi->NamaLampiran3 }}">
                        <input type="file" name="lampiran3" id="lampiran3" accept="application/pdf"
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="lampiran4">Lampiran 4</label>
                        <input type="text" name="NamaLampiran4" id="NamaLampiran4"
                            class="form-control  form-control-sm" value="{{ $ofi->NamaLampiran4 }}">
                        <input type="file" name="lampiran4" id="lampiran4" accept="application/pdf"
                            class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="lampiran5">Lampiran 5</label>
                        <input type="text" name="NamaLampiran5" id="NamaLampiran5"
                            class="form-control  form-control-sm" value="{{ $ofi->NamaLampiran5 }}">
                        <input type="file" name="lampiran5" id="lampiran5" accept="application/pdf"
                            class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <label for="lampiran6">Lampiran 6</label>
                        <input type="text" name="NamaLampiran6" id="NamaLampiran6"
                            class="form-control  form-control-sm" value="{{ $ofi->NamaLampiran6 }}">
                        <input type="file" name="lampiran6" id="lampiran6" accept="application/pdf"
                            class="form-control form-control-sm">
                    </div>
                </div> --}}
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <div class="card">
                                <label for="lampiran1">Lampiran1</label>
                                <div class="card">
                                    <div class="card border border-gray-600 p-2">
                                        <label for="lampiran1" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload" display="inline-block" padding="8px 12px" background-color="#007bff"></i> Pilih File
                                        </label>
                                        <input type="file" name="lampiran1" id="lampiran1" accept="application/pdf" class="input-file" style="display: none;" multiple>
                                        <input readonly="" id="lampiran1_input" tabindex="-1" placeholder="" class="card border border-white" value="{{ substr($ofi->lampiran1, strpos($ofi->lampiran1, '_') + 1) }}">
                                        <span id="clear_lampiran1" class="clear-input" style="position: absolute; right: 10px; top: 75%; transform: translateY(-50%); cursor: pointer; color: red;">&#10006;</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                     --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="md:flex pb-5  md:space-x-5  md:justify-between my-auto items-center w-full">
                                <label for="">Lampiran</label>
                                <div class="md:w-3/5 ">
                                    <input name="lampiran[]" id="lampiran"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="file_input_help" type="file" accept="application/pdf"
                                        multiple>
                                    <p id="files-area" class="">
                                        <span id="filesList">
                                            @foreach ($lampiran as $lamp)
                                                <span class="file-block" id="file-{{ $lamp->id }}">
                                                    <span class="file-delete">
                                                        <span>+</span>
                                                    </span>
                                                    <span class="name">{{ $lamp->nama_lampiran }}</span>
                                                </span>
                                                <input type="hidden" name="nama_lampiran[]" value={{ $lamp->nama_lampiran }} id="file-hidden-{{ $lamp->id }}">
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
                <button type="submit" form="editForm4" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
    </div>

    {{-- modal Admin TL --}}
    <div class="modal fade" id="admin2_modal" tabindex="-1" aria-labelledby="admin2_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="admin2_modalLabel">
                        @if ($ofi->status_tl_admin == null)
                            Tambah data
                        @else
                            Edit data
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm5" action="{{ route('ofi.update_tl_admin', $ofi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                    </form>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status_tl_admin">Status<span class="text-danger"> *</span></label>
                            <select name="status_tl_admin" id="status_tl_admin" onchange="disableAdmin(this)"
                                class="form-control">
                                <option selected disabled value="">-- Pilih --</option>
                                <option {{ $ofi->status_tl_admin == 'Terima' ? 'selected' : '' }} value="Terima" @selected(old('status_tl_admin') == 'Terima')>
                                    Terima
                                </option>
                                <option {{ $ofi->status_tl_admin == 'Tolak' ? 'selected' : '' }} value="Tolak" @selected(old('status_tl_admin') == 'Tolak')>
                                    Tolak
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control" name="alasan" id="alasan" rows="5">{{ old('alasan') }} {{ $ofi->alasan }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="editForm5" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
    </div>

    {{-- modal wakil manajemen kedua --}}
    <div class="modal fade" id="wakilmanajemen2_modal" tabindex="-1" aria-labelledby="wakilmanajemen2_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wakilmanajemen2_modalLabel">
                        @if ($ofi->hasil_verif == null)
                            Tambah data
                        @else
                            Edit data
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm6" action="{{ route('ofi.update_tl_wm', $ofi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                    </form>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="uraian_verif">Uraian verifikasi <span class="text-danger"> *</span></label>
                            <textarea class="form-control" name="uraian_verif" id="uraian_verif" rows="5">{{ old('uraian_verif') }} {{ $ofi->uraian_verif }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hasil_verif">Hasil verifikasi <span class="text-danger"> *</span></label>
                            <select name="hasil_verif" id="hasil_verif" class="form-control">
                                <option selected disabled value="">-- Pilih --</option>
                                <option {{ $ofi->hasil_verif == 'efektif' ? 'selected' : '' }} value="efektif" @selected(old('hasil_verif') == 'efektif')>Efektif
                                </option>
                                <option {{ $ofi->hasil_verif == 'tidak_efektif' ? 'selected' : '' }} value="tidak_efektif" @selected(old('hasil_verif') == 'tidak_efektif')>Tidak Efektif
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="editForm6" class="btn btn-primary">Save</button>
            </div>
        </div>
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
            $('#auditor1_modal').on('show.bs.modal', function () {
                disableAuditorEksternal();
            });
        });
    </script>

    <script>
        function disableOFIDitolak() {
            var disposisi = $('#disposisi').val();
            if (disposisi === 'OFI Diterima') {
                $('#diselesaikan_oleh').prop('disabled', false).selectpicker('refresh');;
            } else {
                $('#diselesaikan_oleh').prop('disabled', true).selectpicker('refresh');;
            }
        }
    </script>

    <script>
        function disableAdmin() {
            var status_tl_admin = $('#status_tl_admin').val();
            console.log("status_tl_admin value:", status_tl_admin);
            if (status_tl_admin === 'Tolak') {
                document.getElementById('alasan').disabled = false;
                console.log("alasan is enabled");
            } else {
                document.getElementById('alasan').disabled = true;
                console.log("alasan is disabled");
            }
        }

        $(document).ready(function() {
            disableAdmin();
            $('#status_tl_admin').on('change', function() {
                disableAdmin();
            });
            $('#admin2_modal').on('show.bs.modal', function () {
                disableAdmin();
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
        document.getElementById("diusulkan_oleh").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var nip = selectedOption.getAttribute("nip_auditor");

            document.getElementById("nip_auditor").value = nip;
        });

        document.getElementById("nama_disetujui_oleh").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var jabatan = selectedOption.getAttribute("jabatan_disetujui_oleh");
            var nip = selectedOption.getAttribute("nip_penerbitan_admin");

            document.getElementById("jabatan_disetujui_oleh").value = jabatan;
            document.getElementById("nip_penerbitan_admin").value = nip;
        });

        document.getElementById("nama_tl_oleh").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var jabatan = selectedOption.getAttribute("jabatan_tl_oleh");
            var nip = selectedOption.getAttribute("nip_auditee");

            document.getElementById("jabatan_tl_oleh").value = jabatan;
            document.getElementById("nip_auditee").value = nip;
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
