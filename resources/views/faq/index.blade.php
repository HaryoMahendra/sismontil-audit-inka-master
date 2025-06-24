@extends('layouts.main')

@section('title', 'FAQ')
@section('page-title', 'FAQ')
@section('breadcrumb', 'FAQ')

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold mb-0">FAQ</h2>
                    </div>

                    <div class="faq-wrapper">
                        @php
                            $faqs = [
                                [
                                    'q' => 'Apa itu SIM-TL?', 
                                    'a' => 'SIM-TL adalah Sistem Informasi Monitoring Tindak Lanjut yang digunakan untuk memantau dan mengelola tindak lanjut hasil audit secara terstruktur dan efisien.'
                                ],
                                [
                                    'q' => 'Bagaimana cara melaporkan tindak lanjut hasil audit?', 
                                    'a' => 'Untuk melaporkan tindak lanjut hasil audit, pengguna harus masuk ke dalam sistem dengan akun yang valid, lalu memilih menu "Monitoring Tindak Lanjut". Setelah itu, pilih audit yang ingin ditindaklanjuti dan lengkapi form pelaporan yang tersedia. Pastikan seluruh informasi yang dimasukkan sudah akurat dan lengkap, termasuk bukti pendukung jika diperlukan.'
                                ],
                                [
                                    'q' => 'Apakah data di SIM-TL aman?', 
                                    'a' => 'Keamanan data menjadi prioritas utama dalam SIM-TL. Sistem ini menggunakan autentikasi pengguna, enkripsi data, dan pencatatan log aktivitas untuk memastikan bahwa setiap perubahan tercatat dengan baik. Selain itu, sistem secara berkala melakukan backup data ke server cadangan untuk mencegah kehilangan data akibat kerusakan atau gangguan sistem.'
                                ],
                                [
                                    'q' => 'Ketika terjadi kendala, harus menghubungi siapa?', 
                                    'a' => 'Anda dapat memilih email salah satu petugas, pilih salah satu:<br><br><a href="' . url('/hubungi') . '" class="contact-btn">Hubungi Kami</a>'
                                ],
                            ];
                        @endphp

                        @foreach ($faqs as $index => $faq)
                            <div class="faq-item">
                                <button class="faq-question" onclick="toggleAnswer({{ $index }})">
                                    {{ $faq['q'] }}
                                    <span class="arrow-icon" id="arrow{{ $index }}">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </button>
                                <div class="faq-answer" id="answer{{ $index }}">
                                    {!! $faq['a'] !!}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .faq-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    .faq-item {
        margin-bottom: 16px;
        border-radius: 8px;
        overflow: hidden;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease;
    }

    .faq-item:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .faq-question {
        width: 100%;
        font-size: 18px;
        font-weight: 600;
        text-align: left;
        padding: 18px 22px;
        background-color: #f8f9fa;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s ease;
    }

    .faq-question:hover {
        background-color: #e9ecef;
    }

    .faq-answer {
        padding: 20px 25px;
        display: none;
        background-color: #fff;
        font-size: 16px;
        color: #444;
        line-height: 1.7;
        text-align: justify;
        border-top: 1px solid #e0e0e0;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .arrow-icon i {
        transition: transform 0.3s ease;
        margin-left: 10px;
    }

    .arrow-icon.rotate i {
        transform: rotate(180deg);
    }

    .contact-btn {
        display: inline-block;
        padding: 10px 18px;
        background-color: #0d6efd;
        color: white;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .contact-btn:hover {
        background-color: #0b5ed7;
    }
</style>

<script>
    function toggleAnswer(id) {
        const answer = document.getElementById('answer' + id);
        const icon = document.getElementById('arrow' + id);
        const faqItem = answer.closest('.faq-item');

        const isVisible = answer.style.display === 'block';

        // Close all
        document.querySelectorAll('.faq-answer').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('open'));
        document.querySelectorAll('.arrow-icon i').forEach(i => {
            i.classList.remove('fa-angle-up');
            i.classList.add('fa-angle-down');
        });

        // Toggle current
        if (!isVisible) {
            answer.style.display = 'block';
            icon.querySelector('i').classList.remove('fa-angle-down');
            icon.querySelector('i').classList.add('fa-angle-up');
            faqItem.classList.add('open');
        }
    }
</script>
@endsection
