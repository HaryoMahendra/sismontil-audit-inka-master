@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Data Tindak Lanjut</h2>
                            @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen')
                            <a href="{{ url('monitoring-tl/excel') }}" target="_blank"
                                style="background-color: #107c41; margin-bottom: 20px;" class="btn btn-success">Excel</a>
                            @endif
                        </div><br>
                        <div class="row mb-0 mb-lg-3">
                            <div class="col-12">
                                <label for="minDateFilter" class="form-label">Filter Tanggal</label>
                            </div>
                            <div class="col-lg-auto mb-3 my-lg-auto">
                                <input type="date" id="minDateFilter" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-auto mb-3 my-lg-auto">
                                s/d
                            </div>
                            <div class="col-lg-auto mb-3 my-lg-auto">
                                <input type="date" id="maxDateFilter" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Jenis Temuan</th>
                                        <th class="text-center">No. Dokumen</th>
                                        <th class="text-center">Proses</th>
                                        <th class="text-center">Tema</th>
                                        <th class="text-center">Objek</th>
                                        <th class="text-center">Tgl. Deadline</th>
                                        <th class="text-center">Tgl. Penyelesaian</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Bukti</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($monitoringncr != null)
                                        @foreach ($monitoringncr as $ncr)
                                            <tr>
                                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                                <td class="text-center">NCR</td>
                                                <td class="text-center">{{ $ncr->no_ncr }}<br>
                                                    <a href="{{ url('data-ncr/' . $ncr->id. '?page=monitoring-tl.index') }}">see detail</a>
                                                </td>
                                                </td>
                                                <td class="text-center">{{ $ncr->proses_audit }}</td>
                                                <td class="text-center">{{ $ncr->tema->nama_tema }}</td>
                                                <td class="text-center">
                                                    @foreach ($departemen as $dept)
                                                        @if ($ncr->name_objek_audit == $dept['div_name'])
                                                            {{ $dept['div_name'] }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d-m-Y', strtotime($ncr->tgl_deadline)) }}</td>
                                                <td class="text-center">
                                                    @if ($ncr->tgl_action != null)         
                                                        @php
                                                            $tgl_deadline = new DateTime($ncr->tgl_deadline);
                                                            $tgl_penyelesaian = new DateTime($ncr->tgl_action);
                                                            $interval = $tgl_penyelesaian->diff($tgl_deadline);
                                                            $daysDiff = $interval->format('%r%a');
                                                        @endphp
                                                        @if ($daysDiff < 0)
                                                            <span
                                                                class="p-2 badge badge-danger">{{ date('d-m-Y', strtotime($ncr->tgl_action)) }}</span>
                                                        @elseif ($daysDiff < 7)
                                                            <span
                                                                class="p-2 badge badge-warning">{{ date('d-m-Y', strtotime($ncr->tgl_action)) }}</span>
                                                        @else
                                                            <span
                                                                class="p-2 badge badge-primary">{{ date('d-m-Y', strtotime($ncr->tgl_action)) }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($ncr->status == 'Open')
                                                        @if ($ncr->status == 'Open' && $ncr->hasil_verif == null)
                                                            <span class="p-2 badge badge-primary">
                                                                {{ $ncr->status }}
                                                            </span>
                                                        @elseif ($ncr->status == 'Open' && $ncr->hasil_verif != null)
                                                            <span class="p-2 badge badge-primary">
                                                                {{ $ncr->status }}
                                                            </span>
                                                            <span class="p-2 badge badge-secondary">
                                                                {{ $ncr->hasil_verif }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                    @if ($ncr->status == 'Closed')
                                                        <span class="p-2 badge badge-success">
                                                            {{ $ncr->status }}
                                                        </span>
                                                        <span class="p-2 badge badge-secondary">
                                                            {{ $ncr->hasil_verif }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                        data-target="#bukti_modal_ncr{{ $ncr->id }}"><i
                                                            class="far fa-edit fa-fw"></i>
                                                    </button>
    
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center" style="gap: 4px">
                                                        <a href="{{ url('data-ncr/print/' . $ncr->id) }}" target="_blank"
                                                            class="btn btn-xs btn-secondary " data-toggle="tooltip"
                                                            data-placement="top" title="Print"><i
                                                                class="ti-printer"></i></a>
                                                        @if (auth()->user()->role->role == 'Admin')
                                                            <form action="{{ route('data-ncr.destroy', $ncr->id) }}"
                                                                method="POST" id="delete_ncr">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-xs btn-danger"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                                        class="ti-trash" data-toggle="tooltip"
                                                                        data-placement="top" title="Hapus"
                                                                        id="hapus"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <span style="color: white;">{{ $total = $loop->index + 1 }}</span>
                                            <div class="modal fade" id="bukti_modal_ncr{{ $ncr->id }}" tabindex="-1"
                                                aria-labelledby="admin1_modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="admin1_modalLabel">
                                                                List Evidence/Bukti
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($ncr->lampiran as $item)
                                                            {{ $loop->iteration }}.
                                                            <a href="{{ asset('storage/pdf/' . $item->nama_lampiran) }}"
                                                                target="_blank">{{ $item['nama_lampiran'] }}</a> <hr>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if ($monitoringofi != null)
                                        @foreach ($monitoringofi as $ofi)
                                            <tr>
                                                <td class="text-center">
                                                    @if (isset($total))
                                                        {{ $total + 1 }}
                                                    @else
                                                        {{ $loop->index + 1 }}
                                                    @endif
                                                </td>
                                                <td class="text-center">OFI</td>
                                                <td class="text-center">{{ $ofi->no_ofi }}<br>
                                                    <a href="{{ url('data-ofi/' . $ofi->id. '?page=monitoring-tl.index') }}">see detail</a>
                                                </td>
                                                </td>
                                                <td class="text-center">{{ $ofi->proses_audit }}</td>
                                                <td class="text-center">{{ $ofi->tema->nama_tema }}</td>
                                                <td class="text-center">
                                                    @foreach ($departemen as $dept)
                                                        @if ($ofi->name_objek_audit == $dept['div_name'])
                                                            {{ $dept['div_name'] }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d-m-Y', strtotime($ofi->tgl_deadline)) }}</td>
                                                <td class="text-center">
                                                    @if ($ofi->tgl_tl != null)
                                                        @php
                                                        $tgl_deadline = new DateTime($ofi->tgl_deadline);
                                                        $tgl_penyelesaian = new DateTime($ofi->tgl_tl);
                                                        $interval = $tgl_penyelesaian->diff($tgl_deadline);
                                                        $daysDiff = $interval->format('%r%a');
                                                        @endphp
                                                        @if ($daysDiff < 0)
                                                            <span
                                                                class="p-2 badge badge-danger">{{ date('d-m-Y', strtotime($ofi->tgl_tl)) }}</span>
                                                        @elseif ($daysDiff < 7)
                                                            <span
                                                                class="p-2 badge badge-warning">{{ date('d-m-Y', strtotime($ofi->tgl_tl)) }}</span>
                                                        @else
                                                            <span
                                                                class="p-2 badge badge-primary">{{ date('d-m-Y', strtotime($ofi->tgl_tl)) }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($ofi->status_dokumen == 'cancel')
                                                        <span
                                                            class="p-2 badge
                                                        @if ($ofi->status_dokumen == 'cancel') badge-danger @endif">
                                                            {{ $ofi->status_dokumen }}
                                                        </span>
                                                    @endif
                                                    @if ($ofi->status_dokumen == 'open')
                                                        @if ($ofi->status_dokumen == 'open' && $ofi->hasil_verif == null)
                                                            <span class="p-2 badge badge-primary">
                                                                {{ $ofi->status_dokumen }}
                                                            </span>
                                                        @elseif ($ofi->status_dokumen == 'open' && $ofi->hasil_verif != null)
                                                            <span class="p-2 badge badge-primary">
                                                                {{ $ofi->status_dokumen }}
                                                            </span>
                                                            <span class="p-2 badge badge-secondary">
                                                                {{ $ofi->hasil_verif }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                    @if ($ofi->status_dokumen == 'close')
                                                        <span class="p-2 badge badge-success">
                                                            {{ $ofi->status_dokumen }}
                                                        </span>
                                                        <span class="p-2 badge badge-secondary">
                                                            {{ $ofi->hasil_verif }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                        data-target="#bukti_modal_ofi{{ $ofi->id }}"><i
                                                            class="far fa-edit fa-fw"></i>
                                                    </button>
    
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center" style="gap: 4px">
                                                        <a href="{{ url('data-ofi/print/' . $ofi->id) }}" target="_blank"
                                                            class="btn btn-xs btn-secondary " data-toggle="tooltip"
                                                            data-placement="top" title="Print"><i
                                                                class="ti-printer"></i></a>
                                                        @if (auth()->user()->role->role == 'Admin')
                                                            <form action="{{ route('data-ofi.destroy', $ofi->id) }}"
                                                                method="POST" id="delete_ofi">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-xs btn-danger"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                                        class="ti-trash" data-toggle="tooltip"
                                                                        data-placement="top" title="Hapus"
                                                                        id="hapus"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @if (isset($total))
                                                <span style="color: white;">{{ $total = $total + 1 }}</span>
                                            @endif
                                            <div class="modal fade" id="bukti_modal_ofi{{ $ofi->id }}" tabindex="-1"
                                                aria-labelledby="admin1_modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="admin1_modalLabel">
                                                                List Evidence/Bukti
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($ofi->lampiran as $item)
                                                            {{ $loop->iteration }}.
                                                            <a href="{{ asset('storage/pdf/' . $item->nama_lampiran) }}"
                                                                target="_blank">{{ $item['nama_lampiran'] }}</a> <hr>
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('swal_msg'))
        <script>
            Swal.fire({
                title: 'Hapus Data Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {})
        </script>
    @endif

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Menghentikan tautan hapus agar tidak langsung mengarahkan ke URL

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.target.href; // Mengarahkan ke URL penghapusan jika pengguna yakin
                }
            });
        }
    </script>
@endsection
