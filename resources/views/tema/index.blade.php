@extends('layouts.main')


@section('page-title', 'Tema Audit')
@section('breadcrumb', 'Tema')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Daftar Tema</h2>
                            <a href="{{ route('tema.create') }}" style="margin-bottom:20px"
                                class="btn btn-success col-md-2">Tambah
                            </a>

                        </div><br>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 4%;" class="text-center">No</th>
                                        <th class="text-center">Nama Tema</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tema as $tema)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $tema->nama_tema }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('tema.edit', $tema->id) }}" class="btn btn-primary btn-xs"><i
                                                        class="ti-pencil-alt"></i></a>
                                                <button class="btn btn-xs btn-danger" onclick="confirmDelete(event)"><i
                                                        class="ti-trash" data-toggle="tooltip" data-placement="top"
                                                        title="Hapus"></i></button>
                                            </td>
                                            <form action="{{ route('tema.destroy', $tema->id) }}" method="POST"
                                                id="delete_tema">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </tr>
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
        function confirmDelete(event) {
            var delete_form = $('#delete_tema');
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
