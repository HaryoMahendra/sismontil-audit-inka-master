@extends('layouts.main')

@section('page-title', 'Hubungi')
@section('breadcrumb', 'Hubungi')

@section('content')
<style>
    .contact-card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 10px;
        background-color: #ffffff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        padding: 16px;
        font-weight: bold;
        font-size: 1rem;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        text-align: center;
    }

    .card-body {
        text-align: center;
        padding: 24px;
    }

    .card-body p {
        margin-bottom: 6px;
        font-size: 14px;
    }

    .card-body strong {
        font-size: 16px;
        display: block;
        margin-bottom: 6px;
    }

    .card-body a {
        margin: 4px;
        min-width: 100px;
    }

    .contact-icon {
        font-size: 32px;
        margin-bottom: 12px;
        color: #6c757d;
    }

    h2.text-start {
        font-size: 24px;
        margin-bottom: 24px;
    }
</style>

<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold mb-0">Hubungi Kami</h2>
                    </div>
                    <div class="row g-4">
                        {{-- Auditor --}}
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-user-shield me-2"></i> AUDITOR
                                </div>
                                <div class="card-body">
                                    <div class="contact-icon"><i class="fas fa-user"></i></div>
                                    <strong>Auditor QM</strong>
                                    <p>auditorqm@gmail.com</p>
                                    <p>081234567891</p>
                                    <a href="mailto:auditorqm@gmail.com" class="btn btn-outline-primary btn-sm">Email</a>
                                    <a href="https://wa.me/6281234567891" target="_blank" class="btn btn-outline-success btn-sm">WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        {{-- Auditee --}}
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-user-tie me-2"></i> AUDITEE
                                </div>
                                <div class="card-body">
                                    <div class="contact-icon"><i class="fas fa-user"></i></div>
                                    <strong>Auditee PO</strong>
                                    <p>auditeepo@gmail.com</p>
                                    <p>083426451923</p>
                                    <a href="mailto:auditeepo@gmail.com" class="btn btn-outline-primary btn-sm">Email</a>
                                    <a href="https://wa.me/6283426451923" target="_blank" class="btn btn-outline-success btn-sm">WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        {{-- Wakil Manajemen --}}
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-success text-white">
                                    <i class="fas fa-briefcase me-2"></i> WAKIL MANAJEMEN
                                </div>
                                <div class="card-body">
                                    <div class="contact-icon"><i class="fas fa-user"></i></div>
                                    <strong>Wakil Manajemen</strong>
                                    <p>wakilmanajemen@gmail.com</p>
                                    <p>081555766634</p>
                                    <a href="mailto:wakilmanajemen@gmail.com" class="btn btn-outline-primary btn-sm">Email</a>
                                    <a href="https://wa.me/6281555766634" target="_blank" class="btn btn-outline-success btn-sm">WhatsApp</a>
                                </div>
                            </div>
                        </div>

                        {{-- Admin --}}
                        <div class="col-md-6 col-lg-6 mb-4">
                            <div class="card contact-card">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-user-cog me-2"></i> ADMIN
                                </div>
                                <div class="card-body">
                                    <div class="contact-icon"><i class="fas fa-user"></i></div>
                                    <strong>Admin SIMTL</strong>
                                    <p>audmin@gmail.com</p>
                                    <p>089686882211</p>
                                    <a href="mailto:audmin@gmail.com" class="btn btn-outline-primary btn-sm">Email</a>
                                    <a href="https://wa.me/6289686882211" target="_blank" class="btn btn-outline-success btn-sm">WhatsApp</a>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End Row -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
