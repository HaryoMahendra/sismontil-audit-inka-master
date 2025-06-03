@extends('layouts.main')

@section('page-title', 'Hubungi')
@section('breadcrumb', 'Hubungi')

@section('content')
<style>
    .contact-card {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 8px;
        background-color: #F4F6F9;
    }

    .card-header {
        padding: 12px;
        font-weight: bold;
        font-size: 16px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        text-align: center;
    }

    .card-body {
        text-align: center;
        padding: 20px;
    }

    .card-body p {
        margin-bottom: 5px;
    }

    .card-body a {
        margin: 5px;
        display: inline-block;
    }

    h2.text-start {
        text-align: left !important;
    }

    footer {
        font-size: 0.9rem;
    }
</style>

<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4 text-start">Hubungi Kami</h2>
                    <div class="row g-4">
                        <!-- Auditor -->
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-primary text-white">AUDITOR</div>
                                <div class="card-body">
                                    <p><strong>Auditor QM</strong></p>
                                    <p>auditorqm@gmail.com</p>
                                    <p>081234567891</p>
                                    <a href="mailto:auditorqm@gmail.com" class="btn btn-outline-primary"><i class="fas fa-envelope"></i> Email</a>
                                    <a href="https://wa.me/6281234567891" target="_blank" class="btn btn-outline-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        <!-- Auditee -->
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-info text-white">AUDITEE</div>
                                <div class="card-body">
                                    <p><strong>Auditee PO</strong></p>
                                    <p>auditeepo@gmail.com</p>
                                    <p>083426451923</p>
                                    <a href="mailto:auditeepo@gmail.com" class="btn btn-outline-primary"><i class="fas fa-envelope"></i> Email</a>
                                    <a href="https://wa.me/6283426451923" target="_blank" class="btn btn-outline-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        <!-- Wakil Manajemen -->
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-success text-white">WAKIL MANAJEMEN</div>
                                <div class="card-body">
                                    <p><strong>Wakil Manajemen</strong></p>
                                    <p>wakilmanajemen@gmail.com</p>
                                    <p>081555766634</p>
                                    <a href="mailto:wakilmanajemen@gmail.com" class="btn btn-outline-primary"><i class="fas fa-envelope"></i> Email</a>
                                    <a href="https://wa.me/6281555766634" target="_blank" class="btn btn-outline-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        <!-- Admin -->
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-warning text-white">ADMIN</div>
                                <div class="card-body">
                                    <p><strong>Admin SIMTL</strong></p>
                                    <p>audmin@gmail.com</p>
                                    <p>089686882211</p>
                                    <a href="mailto:audmin@gmail.com" class="btn btn-outline-primary"><i class="fas fa-envelope"></i> Email</a>
                                    <a href="https://wa.me/6289686882211" target="_blank" class="btn btn-outline-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Row -->
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 text-center text-muted">
        <p>&copy; PT. INKA (Persero)</p>
    </footer>
</div>
@endsection
