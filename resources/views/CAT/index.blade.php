@extends('layouts.main')

@section('page-title', 'Data CAT')
@section('breadcrumb')
    <li class="active">Data CAT</li>
@endsection

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- Header dan Tombol -->
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Data CAT</h3>
                       <div class="d-flex">
                            <a href="{{ route('cat.exportExcel') }}" class="btn text-white mr-2" style="background-color: #0e7c47;">
                                Excel
                            </a>
                            <a href="{{ route('cat.add') }}" class="btn btn-success">
                                Tambah CAT
                            </a>
                        </div>
                    </div>


                    <!-- Filter Tanggal dan Show Entries -->
                    <div class="form-group mb-3">
                        <label class="form-label d-block">Filter Tanggal</label>
                        <div class="d-flex align-items-center mb-2">
                            <input type="date" class="form-control mr-2" style="width: 180px;">
                            <span class="mx-2">s/d</span>
                            <input type="date" class="form-control ml-2" style="width: 180px;">
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="mr-2 mb-0">Show</label>
                            <select class="form-control styled-select" style="width: 80px;">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                            <span class="ml-2">entries</span>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="catTable">
                            <thead class="thead-dark">
                                <tr class="text-white bg-dark">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Divisi/Departemen</th>
                                    <th>Penyelidikan Ketidaksesuaian</th>
                                    <th>Perbaikan yang Dilakukan</th>
                                    <th>Rencana Tindakan Perbaikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
    @forelse ($catList as $index => $cat)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($cat->tanggal)->format('d/m/Y') }}</td>
            <td>{{ $cat->departemen }}</td>
            <td>{{ $cat->penyelidikan ?? '-' }}</td>
            <td>{{ $cat->perbaikan ?? '-' }}</td>
            <td>{{ $cat->rencana ?? '-' }}</td>
            <td>
    {{-- Edit --}}
    <a href="{{ route('cat.edit', $cat->id) }}" class="btn btn-warning btn-sm" title="Edit">
        <i class="fas fa-pen"></i>
    </a>

    {{-- View --}}
    <a href="{{ route('cat.show', $cat->id) }}" class="btn btn-primary btn-sm" title="Lihat">
        <i class="fas fa-eye"></i>
    </a>

    {{-- Delete --}}
    <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $cat->id }})" title="Hapus">
    <i class="fas fa-trash-alt"></i>
</button>

</td>

        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada data</td>
        </tr>
    @endforelse
</tbody>

                        </table>
                    </div>

                    <!-- Footer info dan pagination dummy -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>Showing 0 to 0 of 0 entries</div>
                        <div>
                            <button class="btn btn-outline-secondary btn-sm" disabled>Previous</button>
                            <button class="btn btn-outline-secondary btn-sm" disabled>Next</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Spinner style for the select box */
    .styled-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 24px;
        background-image: url("data:image/svg+xml,%3Csvg fill='black' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E"),
                          url("data:image/svg+xml,%3Csvg fill='black' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 14l5-5 5 5z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat, no-repeat;
        background-position: right 8px top 6px, right 8px bottom 6px;
        background-size: 10px 10px;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat form dan submit
                const form = document.createElement('form');
                form.action = `/cat/${id}`;
                form.method = 'POST';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = @json(csrf_token());

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#6366f1'
        });
    @endif
</script>
@endpush

@endpush
