@extends('layouts.main')

@section('title', 'FAQ')
@section('page-title', 'FAQ')
@section('breadcrumb', 'FAQ')


@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     <h2>FAQ</h2>


                    <div class="faq-wrapper">
                        @php
                            $faqs = [
                                [
                                    'q' => 'Apa itu SIM-TL?', 
                                    'a' => 'SIM-TL (Sistem Informasi Monitoring Tindak Lanjut) adalah sebuah platform yang dirancang untuk mempermudah pelaporan, pengawasan, dan tindak lanjut hasil temuan audit. Sistem ini memungkinkan auditor dan auditee untuk berinteraksi dalam satu tempat yang terintegrasi, sehingga mempercepat proses tindak lanjut dan memastikan bahwa semua temuan ditindaklanjuti dengan tepat waktu.'
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
                                    'q' => 'Siapa yang dapat mengakses SIM-TL?', 
                                    'a' => 'Hanya pengguna yang telah terdaftar dan diberikan hak akses oleh administrator yang dapat menggunakan SIM-TL. Setiap pengguna memiliki peran masing-masing, seperti auditor, auditee, dan admin. Hak akses ditentukan berdasarkan peran tersebut untuk menjaga keamanan dan kerahasiaan informasi audit.'
                                ],
                                [
                                    'q' => 'Ketika terjadi kendala, harus menghubungi siapa?', 
                                    'a' => 'Jika Anda mengalami kesulitan dalam menggunakan SIM-TL atau menemukan kesalahan sistem, Anda dapat langsung menghubungi tim dukungan teknis melalui menu "Hubungi" yang tersedia di sidebar. Tim akan merespons dan membantu Anda secepat mungkin, termasuk memberikan panduan atau memperbaiki kendala teknis yang muncul.'
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
                                    
                                    @if ($index === 4)
                                    <div style="margin-top: 15px;">
                                        <a href="{{ url('/hubungi') }}" class="contact-btn">Hubungi Kami</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .faq-wrapper {
        max-width: 1100px;
        margin: 30px auto;
    }

    .faq-title {
        font-size: 30px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .faq-item {
    margin-bottom: 15px;
    border: none; /* Default: tanpa border */
    border-radius: 5px;
    overflow: hidden;
    min-height: 80px;
    
}

.faq-item.open {
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06); /* Mirip shadow di gambar */
}



    .faq-question {
        width: 100%;
        font-size: 19px;
        text-align: left;
        padding: 18px 22px;
        background-color: #f0f0f0;
        border: none;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .faq-question:hover {
        background-color: #e0e0e0;
    }

    .faq-answer {
        padding: 20px 25px;
        display: none;
        background-color: #fff;
        font-size: 17px;
        color: #444;
        line-height: 1.7;
        text-align: justify;
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
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.contact-btn:hover {
    background-color: #218838;
}


</style>

<script>
    function toggleAnswer(id) {
    const answer = document.getElementById('answer' + id);
    const icon = document.getElementById('arrow' + id);
    const faqItem = answer.closest('.faq-item');

    const isVisible = answer.style.display === 'block';

    // Tutup semua
    document.querySelectorAll('.faq-answer').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('open'));
    document.querySelectorAll('.arrow-icon i').forEach(icon => {
        icon.classList.remove('fa-angle-up');
        icon.classList.add('fa-angle-down');
    });

    // Buka jika belum terlihat
    if (!isVisible) {
        answer.style.display = 'block';
        icon.querySelector('i').classList.remove('fa-angle-down');
        icon.querySelector('i').classList.add('fa-angle-up');
        faqItem.classList.add('open');
    }
}

</script>
@endsection
