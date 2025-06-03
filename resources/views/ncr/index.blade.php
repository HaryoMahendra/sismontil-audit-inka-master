@extends('layouts.main')

@section('page-title', 'Data NCR')
@section('breadcrumb', 'Data NCR')

@section('content')
    <div class="main-content-inner">

        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Data NCR</h2>
                            <a href="{{ route('data-ncr.excel') }}" target="_blank"
                                style="background-color: #107c41; margin-bottom: 20px; margin-left: auto; margin-right: 20px;"
                                class="btn btn-success">Excel</a>
                            @if (auth()->user()->role->role == 'Admin' ||auth()->user()->role->role == 'Auditor')
                                <a href="{{ route('data-ncr.create') }}" style="margin-bottom: 20px;"
                                    class="btn btn-success">Tambah NCR</a>
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
                                        <th class="text-center">No. NCR</th>
                                        <th class="text-center">Periode</th>
                                        <th class="text-center">Proses</th>
                                        <th class="text-center">Tema</th>
                                        <th class="text-center">Objek</th>
                                        <!--<th class="text-center">Dokumen</th>-->
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Tgl. Deadline</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Bukti</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ncr as $data_ncr)
                                    @if ($data_ncr->status == 'Open' && Carbon\Carbon::now()->gt($data_ncr->tgl_deadline) )
                                        <tr style="background-color: rgb(255, 190, 190);">                                                                                   
                                            <td style="background-color: rgb(255, 190, 190);" class="text-center">{{ $loop->index + 1 }}</td>
                                    @else
                                        <tr>                                      
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                    @endif
                                            <td class="text-center">{{ $data_ncr->no_ncr }}<br></td>
                                            <td class="text-center">{{ $data_ncr->periode_audit }}</td>
                                            <td class="text-center">{{ $data_ncr->proses_audit }}</td>
                                            <td class="text-center">{{ $data_ncr->tema->nama_tema }}</td>
                                            <td class="text-center">
                                                @foreach ($departemen as $dept)
                                                    @if ($data_ncr->name_objek_audit == $dept['div_name'])
                                                        {{ $dept['div_name'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <!--<td class="text-center">{{ $data_ncr->dokumen }}</td>-->
                                            <td class="text-center">
                                                @if ($data_ncr->tgl_terbitncr != null) 
                                                {{ date('d-m-Y', strtotime($data_ncr->tgl_terbitncr)) }}
                                                @endif
                                            </td>
                                            @if ($data_ncr->tgl_deadline != null) 
                                                @if ($data_ncr->status == 'Open' && Carbon\Carbon::now()->gt($data_ncr->tgl_deadline) )
                                                    <td class="text-center" style="font-weight: bold; color:red">{{ date('d-m-Y', strtotime($data_ncr->tgl_deadline)) }}</td>
                                                @else
                                                    <td class="text-center">{{ date('d-m-Y', strtotime($data_ncr->tgl_deadline)) }}</td>                                              
                                                @endif                                  
                                            @else
                                                <td class="text-center">
                                            @endif                               
                                            <td class="text-center">
                                                @if ($data_ncr->status == 'Open')
                                                    @if ($data_ncr->status == 'Open' && $data_ncr->hasil_verif == null)
                                                        <span class="p-2 badge badge-primary">
                                                            {{ $data_ncr->status }}
                                                        </span>
                                                    @elseif ($data_ncr->status == 'Open' && $data_ncr->hasil_verif != null)
                                                        <span class="p-2 badge badge-primary">
                                                            {{ $data_ncr->status }}
                                                        </span>
                                                        <span class="p-2 badge badge-secondary">
                                                            {{ $data_ncr->hasil_verif }}
                                                        </span>
                                                    @endif
                                                @endif
                                                @if ($data_ncr->status == 'Closed')
                                                    <span class="p-2 badge badge-success">
                                                        {{ $data_ncr->status }}
                                                    </span>
                                                    <span class="p-2 badge badge-secondary">
                                                        {{ $data_ncr->hasil_verif }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-warning" data-toggle="modal"
                                                    data-target="#bukti_modal{{ $data_ncr->id }}"><i
                                                        class="far fa-edit fa-fw"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center" style="gap: 4px">
                                                    <a href="{{ url('data-ncr/print/' . $data_ncr->id) }}" target="_blank"
                                                        class="btn btn-xs btn-secondary " data-toggle="tooltip" data-placement="top" title="Print"><i class="ti-printer"></i></a>
                                                    {{-- <a href="{{ route('data-ncr.show', $data_ncr->id) }}"
                                                        class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Tindak lanjut NCR"><i class="ti-plus"></i></a> --}}
                                                        {{-- <a href="{{ url('data-ncr/edit/' . $data_ncr->id_ncr) }}"
                                                    <a href="{{ url('data-ncr/print/' . $data_ncr->id_ncr) }}"
                                                        target="_blank" class="btn btn-xs btn-secondary "
                                                        data-toggle="tooltip" data-placement="top" title="Print"><i
                                                            class="ti-printer"></i></a>
                                                    <a href="{{ url('data-ncr/tlncr/input/' . $data_ncr->id_ncr) }}"
                                                        class="btn btn-xs btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title="Tindak lanjut NCR"><i
                                                            class="ti-plus"></i></a>
                                                    @if (auth()->user()->role == 'Admin1' || auth()->user()->role == 'Auditor')
                                                        {{-- <a href="{{ url('data-ncr/edit/' . $data_ncr->id_ncr) }}"
                                                            class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit NCR"><i class="ti-pencil-alt"></i></a> --}}
                                                        {{-- <a href="{{ route('data-ncr.edit', $data_ncr->id_ncr) }}"
                                                            class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit NCR"><i class="ti-pencil-alt"></i></a> --}}
                                                        <a href="{{ route('data-ncr.show', $data_ncr->id) }}"
                                                            class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Show NCR"><i class="fas fa-eye"></i></a>
                                                    @if ($user->role->role == 'Admin')                     
                                                        <form action="{{route('data-ncr.destroy', $data_ncr->id)}}" method="POST" id="delete_ncr">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                            class="ti-trash" data-toggle="tooltip" data-placement="top" title="Hapus" id="hapus"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="bukti_modal{{ $data_ncr->id }}" tabindex="-1"
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
                                                        @foreach ($data_ncr->lampiran as $item)
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
            var delete_form = $(`#delete_${id}`);
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
