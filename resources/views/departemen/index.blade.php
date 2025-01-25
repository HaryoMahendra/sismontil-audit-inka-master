@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Daftar {{ $title }}</h2>
                            <a href="{{ url('data-departemen/add') }}" style="margin-bottom:20px"
                                class="btn btn-success col-md-2">Tambah
                            </a>

                        </div><br>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 4%;" class="text-center">No</th>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama Departemen</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Username</th>
                                        {{-- <th class="text-center">Password</th> --}}
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $user->nip }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->role_id }}</td>
                                            <td class="text-center">{{ $user->username }}</td>
                                            {{-- <td class="text-center">{{ $user->password }}</td> --}}
                                            <td class="text-center">
                                                <a href="{{ url('data-departemen/edit/' . $user->id) }}"
                                                    class="btn btn-primary"><i class="ti-pencil-alt"></i></a>
                                                <a href="{{ url('data-departemen/delete/' . $user->id) }}"
                                                    class="btn btn-danger"><i class="ti-trash" onclick="confirmDelete(event)"></i></a>
                                            </td>
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
