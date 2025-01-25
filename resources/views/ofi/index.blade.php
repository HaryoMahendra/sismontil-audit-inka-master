@extends('layouts.main')

@section('content')
    <div class="main-content-inner">

        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Data OFI</h2>
                            <a href="{{ route('data-ofi.excel') }}" target="_blank"
                                style="background-color: #107c41; margin-bottom: 20px; margin-left: auto; margin-right: 20px;"
                                class="btn btn-success">Excel</a>
                            @if ($user->role->role == 'Auditor' || $user->role->role == 'Admin')
                                <a href="{{ route('data-ofi.create') }}" style="margin-bottom: 20px;"
                                    class="btn btn-success">Tambah OFI</a>
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
                                        <th class="text-center">No. Ofi</th>
                                        <th class="text-center">Kepada</th>
                                        <th class="text-center">Periode</th>
                                        <th class="text-center">Proses</th>
                                        <th class="text-center">Tema</th>
                                        <th class="text-center">Objek</th>
                                        <!-- {{-- <th class="text-center">Diselesaikan Oleh</th> --}} -->
                                        <!--<th class="text-center">Dokumen</th>-->
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Tgl. Deadline</th>
                                        <th class="text-center">Verifikasi Admin</th>
                                        <th class="text-center">Verifikasi Wakil Manajemen</th>
                                        <th class="text-center">Verifikasi Auditee</th>
                                        <th class="text-center">Status Dokumen</th>
                                        <th class="text-center">Bukti</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ofi as $data_ofi)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $data_ofi->no_ofi }}</td>
                                            <td class="text-center">{{ $data_ofi->kepada }}</td>
                                            <td class="text-center">{{ $data_ofi->periode_audit }}</td>
                                            <td class="text-center">{{ $data_ofi->proses_audit }}</td>
                                            <td class="text-center">{{ $data_ofi->tema->nama_tema ?? null }}</td>
                                            <td class="text-center">
                                                @foreach ($departemen as $dept)
                                                    @if ($data_ofi->name_objek_audit == $dept['div_name'])
                                                        {{ $dept['div_name'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <!--<td class="text-center">{{ $data_ofi->dokumen }}</td>-->
                                            <!-- <td class="text-center">
                                                        {{ date('d-m-Y', strtotime($data_ofi->tgl_terbitofi)) }}
                                                        </td>
                                                        <td class="text-center">
                                                        {{ date('d-m-Y', strtotime($data_ofi->tgl_deadline)) }}
                                                        </td> -->
                                            <td class="text-center">
                                                @if ($data_ofi->tgl_terbitofi != null)
                                                    {{ date('d-m-Y', strtotime($data_ofi->tgl_terbitofi)) }}
                                                @endif
                                            </td>
                                            @if ($data_ofi->tgl_deadline != null)
                                                @if ($data_ofi->verif_admin == 'Open' && Carbon\Carbon::now()->gt($data_ofi->tgl_deadline))
                                                    <td class="text-center" style="font-weight: bold; color:red">
                                                        {{ date('d-m-Y', strtotime($data_ofi->tgl_deadline)) }}</td>
                                                @else
                                                    <td class="text-center">
                                                        {{ date('d-m-Y', strtotime($data_ofi->tgl_deadline)) }}</td>
                                                @endif
                                            @else
                                                <td class="text-center">
                                            @endif
                                            <td class="text-center">
                                                <span
                                                    class="p-2 badge
                                                    @if ($data_ofi->verif_admin == 'open') badge-warning
                                                    @elseif ($data_ofi->verif_admin == 'release')
                                                        badge-success @endif">
                                                    @if ($data_ofi->verif_admin == 'open')
                                                        Menunggu Release Admin
                                                    @elseif ($data_ofi->verif_admin == 'release')
                                                        Release
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="p-2 badge
                                                    @if ($data_ofi->disposisi == 'OFI Diterima') badge-success
                                                    @elseif ($data_ofi->disposisi == 'OFI Ditolak')
                                                        badge-danger @endif">
                                                    @if ($data_ofi->disposisi == 'OFI Diterima')
                                                        OFI Diterima
                                                    @elseif ($data_ofi->disposisi == 'OFI Ditolak')
                                                        OFI Ditolak
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($data_ofi->disposisi == 'OFI Diterima')
                                                    <span
                                                        class="p-2 badge
                                                    @if ($data_ofi->submit_auditee == 'submit' && $data_ofi->status_tl_admin != 'Terima') badge-warning
                                                    @elseif ($data_ofi->status_tl_admin == 'Tolak')
                                                        badge-danger
                                                    @elseif ($data_ofi->status_tl_admin == 'Terima')
                                                        badge-success @endif">
                                                        @if ($data_ofi->submit_auditee == 'submit' && $data_ofi->status_tl_admin != 'Terima')
                                                            Menunggu verifikasi Admin
                                                        @elseif ($data_ofi->status_tl_admin == 'Tolak')
                                                            Tolak By Admin
                                                        @elseif ($data_ofi->status_tl_admin == 'Terima')
                                                            Terima By Admin
                                                        @endif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($data_ofi->status_dokumen == 'cancel')
                                                    <span
                                                        class="p-2 badge
                                                    @if ($data_ofi->status_dokumen == 'cancel') badge-danger @endif">
                                                        {{ $data_ofi->status_dokumen }}
                                                    </span>
                                                @endif
                                                @if ($data_ofi->status_dokumen == 'open')
                                                    @if ($data_ofi->status_dokumen == 'open' && $data_ofi->hasil_verif == null)
                                                        <span class="p-2 badge badge-primary">
                                                            {{ $data_ofi->status_dokumen }}
                                                        </span>
                                                    @elseif ($data_ofi->status_dokumen == 'open' && $data_ofi->hasil_verif != null)
                                                        <span class="p-2 badge badge-primary">
                                                            {{ $data_ofi->status_dokumen }}
                                                        </span>
                                                        <span class="p-2 badge badge-secondary">
                                                            {{ $data_ofi->hasil_verif }}
                                                        </span>
                                                    @endif
                                                @endif
                                                @if ($data_ofi->status_dokumen == 'close')
                                                    <span class="p-2 badge badge-success">
                                                        {{ $data_ofi->status_dokumen }}
                                                    </span>
                                                    <span class="p-2 badge badge-secondary">
                                                        {{ $data_ofi->hasil_verif }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                    data-target="#bukti_modal{{ $data_ofi->id }}"><i
                                                        class="far fa-edit fa-fw"></i>
                                                </button>

                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center" style="gap: 4px">
                                                    <a href="{{ url('data-ofi/print/' . $data_ofi->id) }}" target="_blank"
                                                        class="btn btn-xs btn-secondary " data-toggle="tooltip"
                                                        data-placement="top" title="Print"><i class="ti-printer"></i></a>
                                                    @if (
                                                        $user->role->role == 'Admin' ||
                                                            $user->role->role == 'Auditor' ||
                                                            $user->role->role == 'Auditee' ||
                                                            $user->role->role == 'Wakil Manajemen')
                                                        {{-- <a href="{{ url('data-ofi/edit/' . $data_ofi->id_ofi) }}"
                                                    <a href="{{ url('data-ofi/print/' . $data_ofi->id_ofi) }}"
                                                        target="_blank" class="btn btn-xs btn-secondary "
                                                        data-toggle="tooltip" data-placement="top" title="Print"><i
                                                            class="ti-printer"></i></a>
                                                    @endif
                                                    @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditor' || $user->role->role == 'wakil manajemen' || $user->role->role == 'Auditee')
                                                        {{-- <a href="{{ url('data-ofi/edit/' . $data_ofi->id_ofi) }}"
                                                            class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit ofi"><i class="ti-pencil-alt"></i></a> --}}
                                                        {{-- <a href="{{ route('data-ofi.edit', $data_ofi->id_ofi) }}"
                                                            class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit ofi"><i class="ti-pencil-alt"></i></a> --}}
                                                        <a href="{{ route('data-ofi.show', $data_ofi->id) }}"
                                                            class="btn btn-xs btn-primary" data-toggle="tooltip"
                                                            data-placement="top" title="Show ofi"><i
                                                                class="fas fa-eye"></i></a>
                                                    @endif
                                                    @if ($user->role->role == 'Admin')
                                                        <form action="{{ route('data-ofi.destroy', $data_ofi->id) }}"
                                                            method="POST" id="delete_ofi {{ $data_ofi->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-xs btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <i class="ti-trash" data-toggle="tooltip"
                                                                    data-placement="top" title="Hapus"
                                                                    id="hapus"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="bukti_modal{{ $data_ofi->id }}" tabindex="-1"
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
                                                        @foreach ($data_ofi->lampiran as $item)
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
                                </tbody>
                            </table>
                        </div>
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
        function confirmDelete('hapus', event) {
            var delete_form = $(`#delete_ofi${id}`);
            event.preventDefault(); // Menghentikan tautan hapus agar tidak langsung mengarahkan ke URL

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    delete_form.submit();
                    // window.location.href = event.target.href; // Mengarahkan ke URL penghapusan jika pengguna yakin
                }
            });
        }
    </script>
@endsection
