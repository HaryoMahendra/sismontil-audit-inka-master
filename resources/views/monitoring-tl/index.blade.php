@extends('layouts.main')

@section('page-title', 'Monitoring Tindak Lanjut')
@section('breadcrumb', 'Data Tindak Lanjut')

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Header & Export -->
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        <h2>Data Tindak Lanjut</h2>
                        @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Wakil Manajemen')
                        <a href="#" class="btn btn-success" style="background-color:#107c41;">Excel</a>
                        @endif
                    </div>

                    <!-- Filter Tanggal -->
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

                    <!-- Filter Tahun -->
                    <div class="col-lg-auto mb-3 my-lg-auto ml-auto">
                        <label for="yearFilter" class="form-label">Filter Tahun</label>
                        <select id="yearFilter" class="form-control form-control-sm">
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2020; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table id="dataTable3" class="table table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Temuan</th>
                                    <th>No. Dokumen</th>
                                    <th>Proses</th>
                                    <th>Tema</th>
                                    <th>Objek</th>
                                    <th>Tgl. Deadline</th>
                                    <th>Tgl. Penyelesaian</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data 1 : Audit Internal, NCR -->
                                <tr>
                                    <td>1</td>
                                    <td>NCR</td>
                                    <td>NCR-001</td>
                                    <td>Produksi</td>
                                    <td>Kualitas</td>
                                    <td>Divisi QC</td>
                                    <td>
                                        <span class="badge bg-danger">10-07-2025</span>
                                        <br><small class="text-muted">Audit Internal (NCR, 1 Bulan)</small>
                                    </td>
                                    <td><span class="badge bg-danger">Belum Upload</span></td>
                                    <td><span class="badge bg-warning text-dark">Open</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" title="Lihat Bukti"><i class="bi bi-paperclip"></i></button>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center" style="gap: 4px;">
                                            <a href="#" class="btn btn-sm" style="background-color:#ffc107; color:#fff;" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="btn btn-sm" style="background-color:#007bff; color:#fff;" title="Detail" 
                                               data-bs-toggle="modal" data-bs-target="#previewTemuanModal"
                                               data-nomor="NCR-001"
                                               data-uraian="Kualitas produk tidak sesuai spesifikasi"
                                               data-divisi="Divisi QC"
                                               data-deadline="10-07-2025"
                                               data-penyelesaian="Belum Upload">
                                               <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm" style="background-color:#dc3545; color:#fff;" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 2 : Audit Internal, OFI -->
                                <tr>
                                    <td>2</td>
                                    <td>OFI</td>
                                    <td>OFI-010</td>
                                    <td>Marketing</td>
                                    <td>Proses Digitalisasi</td>
                                    <td>Divisi Marketing</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">25-07-2025</span>
                                        <br><small class="text-muted">Audit Internal (OFI, 2 Bulan)</small>
                                    </td>
                                    <td><span class="badge bg-primary">Dalam Proses</span></td>
                                    <td><span class="badge bg-warning text-dark">Open</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"><i class="bi bi-paperclip"></i></button>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center" style="gap: 4px;">
                                            <a href="#" class="btn btn-sm" style="background-color:#ffc107; color:#fff;" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="btn btn-sm" style="background-color:#007bff; color:#fff;" title="Detail" 
                                               data-bs-toggle="modal" data-bs-target="#previewTemuanModal"
                                               data-nomor="OFI-010"
                                               data-uraian="Proses digitalisasi belum optimal"
                                               data-divisi="Divisi Marketing"
                                               data-deadline="25-07-2025"
                                               data-penyelesaian="Dalam Proses">
                                               <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm" style="background-color:#dc3545; color:#fff;" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 3 : Selesai -->
                                <tr>
                                    <td>3</td>
                                    <td>NCR</td>
                                    <td>NCR-101</td>
                                    <td>Ekspor</td>
                                    <td>Kepatuhan Dokumen</td>
                                    <td>Divisi Ekspor</td>
                                    <td>
                                        <span class="badge bg-danger">05-07-2025</span>
                                        <br><small class="text-muted">Audit Eksternal (NCR, 2 Minggu)</small>
                                    </td>
                                    <td>15-07-2025</td>
                                    <td><span class="badge bg-success">Closed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success" title="Lihat Bukti"><i class="bi bi-file-earmark-check"></i></a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center" style="gap: 4px;">
                                            <a href="#" class="btn btn-sm" style="background-color:#ffc107; color:#fff;" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="btn btn-sm" style="background-color:#007bff; color:#fff;" title="Detail" 
                                               data-bs-toggle="modal" data-bs-target="#previewTemuanModal"
                                               data-nomor="NCR-101"
                                               data-uraian="Dokumen ekspor tidak sesuai persyaratan"
                                               data-divisi="Divisi Ekspor"
                                               data-deadline="05-07-2025"
                                               data-penyelesaian="15-07-2025">
                                               <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm" style="background-color:#dc3545; color:#fff;" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="previewTemuanModal" tabindex="-1" aria-labelledby="previewTemuanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-eye-fill"></i> Detail Hasil Temuan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold text-secondary">Nomor OFI / NCR:</h6>
                <p id="detailNomor"></p>
                <h6 class="fw-bold text-secondary">Uraian Permasalahan:</h6>
                <p id="detailUraian"></p>
                <h6 class="fw-bold text-secondary">Divisi PIC / Auditee:</h6>
                <p id="detailDivisi"></p>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-secondary">Tanggal Deadline:</h6>
                        <p id="detailDeadline" class="text-danger"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-secondary">Tanggal Penyelesaian:</h6>
                        <p id="detailPenyelesaian" class="text-success"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Script untuk isi data modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewModal = document.getElementById('previewTemuanModal');
    previewModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('detailNomor').textContent = button.getAttribute('data-nomor');
        document.getElementById('detailUraian').textContent = button.getAttribute('data-uraian');
        document.getElementById('detailDivisi').textContent = button.getAttribute('data-divisi');
        document.getElementById('detailDeadline').textContent = button.getAttribute('data-deadline');
        document.getElementById('detailPenyelesaian').textContent = button.getAttribute('data-penyelesaian');
    });
});
</script>
@endsection
