<html>

<head>
    <style>
        @page {
            margin: 10px;
        }

        table {
            border-collapse: collapse;
            border-width: 1px;
            border-style: solid;
            border-color: #000;
        }

        th,
        td {}

        th,
        td {
            padding: 5px;
            font-family: 'Open Sans', sans-serif;
            border-width: 1px 0px 1px 0px;
            border-style: solid;
            border-color: #000;
            line-height: 17px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td style="width: 45%; vertical-align: middle; text-align: center;">
                <img src="{{ asset('assets/images/logo-inka.png') }}" style="width: 50%;">
            </td>
            <td style="width: 55%; vertical-align: middle; text-align: center; border-left-width: 1px;">
                @if ($ncr->tema->nama_tema == 'SMK3 PP 50 Tahun 2012')
                    <span style="font-size: 20px; font-weight: bold; text-transform: uppercase;">Laporan Ketidak Sesuaian
                        Audit SMK3LH</span><br>
                @else
                    <span style="font-size: 20px; font-weight: bold; text-transform: uppercase;">Laporan Ketidak Sesuaian
                        Audit</span><br>
                @endif
                <span style="font-size: 17px; text-transform: uppercase; font-style: italic;">(Non Conformity Report For
                    Audit)</span>
            </td>
        </tr>
    </table>


    <table style="width: 100%; padding-top: 5px;">
        <tr>
            <td style="width: 20%; vertical-align: middle;">
                NCR No.
            </td>
            <td style="width: 60%; vertical-align: middle;">
                : {{ $ncr->no_ncr }}
            </td>
            <td style="width: 20%; vertical-align: middle; border-left-width: 1px;">
                Tanggal: {{ $ncr->tgl_terbitncr ? date('d-m-Y', strtotime($ncr->tgl_terbitncr)) : '' }}
            </td>
        </tr>
        <tr>
            <td style="width: 20%; vertical-align: middle;">
                Departemen yang diaudit
            </td>
            <td style="width: 80%; vertical-align: middle;" colspan="2">
                :
                @foreach ($departemen as $dept)
                    @if ($ncr->name_objek_audit == $dept['div_name'])
                        {{ $dept['div_name'] }}
                    @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <td style="width: 20%; vertical-align: middle;">
                Bab yang diaudit
            </td>
            <td style="width: 80%; vertical-align: middle;" colspan="2">
                : {{ $ncr->bab_audit }}
            </td>
        </tr>
        <tr>
            <td style="width: 20%; vertical-align: middle;">
                Dokumen Acuan
            </td>
            <td style="width: 80%; vertical-align: middle;" colspan="2">
                : {{ $ncr->dok_acuan }}
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="2">
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span
                        style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 45px;">
                        Uraian&nbsp;ketidaksesuaian
                    </span>
                    <span style="padding-bottom: 2.55px; word-wrap: break-word; border-bottom: 1px solid #000; line-height: 27px;">
                        : {{ $ncr->uraian_ncr }}
                    </span>
                </div>
                @if (strlen($ncr->uraian_ncr) <= 100)
                    <div style="text-align: justify; border-bottom: 1px solid #000;">
                        <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                            &nbsp;
                        </span>
                    </div>
                @endif
            </td>
        </tr>

        <tr>
            <td style="width: 80%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
                <div style="border-bottom: 1px solid #000;">&nbsp;</div>
            </td>
            <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-left-width: 0px;">
                <table style="width: 100%; border: 0px;">
                    <tr>
                        <td style="width: 60%; border: 0px; text-align: right;">
                            Kategori:
                        </td>
                        <td style="width: 20%; border: 0px;">
                            <span
                                style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ncr->kategori == 'Mayor' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                        </td>
                        <td style="width: 20%; border: 0px;">
                            Mayor
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%; border: 0px; text-align: right;">

                        </td>
                        <td style="width: 20%; border: 0px;">
                            <span
                                style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ncr->kategori == 'Minor' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                        </td>
                        <td style="width: 20%; border: 0px;">
                            Minor
                        </td>
                    </tr>
                    @if ($ncr->tema->nama_tema == 'SMK3 PP 50 Tahun 2012')
                        <tr>
                            <td style="width: 60%; border: 0px; text-align: right;">

                            </td>
                            <td style="width: 20%; border: 0px;">
                                <span
                                    style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ncr->kategori == 'Kritikal' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                            </td>
                            <td style="width: 20%; border: 0px;">
                                Kritikal
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 60%; border: 0px; text-align: right;">

                            </td>
                            <td style="width: 20%; border: 0px;">
                                <span
                                    style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ncr->kategori == 'Observasi' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                            </td>
                            <td style="width: 20%; border: 0px;">
                                Observasi
                            </td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td
                style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
                Auditor:
            </td>
            <td style="width: 40%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 7%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 45%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;"
                colspan="3">
                Diakui oleh *:
            </td>
        </tr>
        <tr>
            <td style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 40%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                @if($qr1 != null)
                <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(50)->generate($qr1)) }} ">
                @endif
                <br>
                <div style="border-bottom: 1px dotted #000;">
                    @if ($ncr->auditor_eksternal != null)
                        {{ $ncr->auditor_eksternal }}
                    @else
                        {{ $ncr->nama_auditor }}
                    @endif
                </div>
            </td>
            <td style="width: 7%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td
                style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;">
                (M/SM)
            </td>
            <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                @if($qr2 != null && $ncr->nama_diakui_m_sm != null)
                <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(50)->generate($qr2)) }} ">
                @endif
                <br>
                <div>
                    {{ $ncr->nama_diakui_m_sm }}
                </div>
                <div style="border-bottom: 1px dotted #000;">{{ $ncr->jabatan_diakui_m_sm }}</div>
            </td>
            <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                Disetujui General Manager/Senior Manager *
            </td>
            <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                :
            </td>
            <td style="width: 23%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                @if($qr3!= null && $ncr->nama_disetujui_sm_gm != null)
                <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(50)->generate($qr3)) }} ">
                @endif
                <br>
                <div>{{ $ncr->nama_disetujui_sm_gm }}</div>
                <div style="border-bottom: 1px dotted #000;">{{ $ncr->jabatan_disetujui_sm_gm }}</div>
            </td>
            <td style="width: 4%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td
                style="width: 19%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
                Tanggal Disetujui *
            </td>
            <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                :
            </td>
            <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                <div style="border-bottom: 1px dotted #000;">
                    {{ $ncr->tgl_acc_gm ? date('d-m-Y', strtotime($ncr->tgl_acc_gm)) : '' }}
                </div>
            </td>
            <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                Rencana tanggal penyelesaian *
            </td>
            <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                :
            </td>
            <td style="width: 34%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="3">
                <div style="border-bottom: 1px dotted #000;">
                    {{ $ncr->tgl_plan_action ? date('d-m-Y', strtotime($ncr->tgl_plan_action)) : '' }}
                </div>
            </td>
            <td style="width: 30%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="3">
                &nbsp;
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 100%; border: 0px; padding: 0;">
                <table style="width: 100%; border: 0px;">
                    <tr>
                        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                            colspan="2">
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                                    Akar&nbsp;penyebab&nbsp;permasalahan&nbsp;*&nbsp;:
                                </span>
                                <span
                                    style="padding-bottom: 2.55px; word-wrap: break-word; border-bottom: 1px solid #000; line-height: 27px;">
                                    {{ !empty($ncr->akar_masalah) ? $ncr->akar_masalah : '' }}
                                </span>
                            </div>
                            @if (strlen(!empty($ncr->akar_masalah) ? $ncr->akar_masalah : '') <= 100)
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 100%; border: 0px; padding: 0;">
                <table style="width: 100%; border: 0px;">
                    <tr>
                        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                            colspan="2">
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                                    Uraian&nbsp;Perbaikan&nbsp;*&nbsp;:
                                </span>
                                <span
                                    style="padding-bottom: 2.55px; word-wrap: break-word; border-bottom: 1px solid #000; line-height: 27px;">
                                    {{ !empty($ncr->uraian_perbaikan) ? $ncr->uraian_perbaikan : '' }}
                                </span>
                            </div>
                            @if (strlen(!empty($ncr->uraian_perbaikan) ? $ncr->uraian_perbaikan : '') <= 100)
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 100%; border: 0px; padding: 0;">
                <table style="width: 100%; border: 0px;">
                    <tr>
                        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                            colspan="2">
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                                    Uraian&nbsp;Pencegahan&nbsp;untuk&nbsp;menjamin&nbsp;tidak&nbsp;terulang&nbsp;*&nbsp;:
                                </span>
                                <span
                                    style="padding-bottom: 2.55px; word-wrap: break-word; border-bottom: 1px solid #000; line-height: 27px;">
                                    {{ !empty($ncr->uraian_pencegahan) ? $ncr->uraian_pencegahan : '' }}
                                </span>
                            </div>
                            @if (strlen(!empty($ncr->uraian_pencegahan) ? $ncr->uraian_pencegahan : '') <= 100)
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                Tanggal penyelesaian *
            </td>
            <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                :
            </td>
            <td style="width: 34%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="3">
                <div style="border-bottom: 1px dotted #000;">
                    {{ !empty($ncr->tgl_action) ? date('d-m-Y', strtotime($ncr->tgl_action)) : '' }}
                </div>
            </td>
            <td style="width: 30%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="3">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                Disetujui General Manager/Senior Manager *
            </td>
            <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                :
            </td>
            <td style="width: 23%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                {{-- <img width="50" height="60"
                    src="{{ !empty($ncr->ttd_acc_gm2) ? asset('storage/ttd/' . $ncr->ttd_acc_gm2) : '' }}"
                    alt="Ttd disetujui oleh"> --}}
                    @if($qr4 != null && $ncr->nama_sm_verif != null)
                    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(50)->generate($qr4)) }} ">
                    @endif
                <br>
                <div>{{ !empty($ncr->nama_sm_verif) ? $ncr->nama_sm_verif : '' }}</div>
                <div style="border-bottom: 1px dotted #000;">
                    {{ !empty($ncr->jabatan_disetujui_sm_gm2) ? $ncr->jabatan_disetujui_sm_gm2 : '' }}</div>
            </td>
            <td style="width: 4%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td
                style="width: 19%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
                Tanggal Disetujui *
            </td>
            <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                :
            </td>
            <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                <div style="border-bottom: 1px dotted #000;">
                    {{ !empty($ncr->tgl_acc_gm2) ? date('d-m-Y', strtotime($ncr->tgl_acc_gm2)) : '' }}
                </div>
            </td>
            <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 80%; border: 0px; padding: 0; vertical-align: top;">
                <table style="width: 100%; border: 0px;">
                    <tr>
                        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                            colspan="2">
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px;">
                                    Verifikasi&nbsp;Auditor&nbsp;:
                                </span>
                                <span
                                    style="padding-bottom: 2.55px; word-wrap: break-word; border-bottom: 1px solid #000; line-height: 27px;">
                                    {{ !empty($ncr->uraian_verif) ? $ncr->uraian_verif : '' }}
                                </span>
                            </div>
                            @if (strlen(!empty($ncr->hasil_verif) ? $ncr->hasil_verif : '') <= 100)
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                            @elseif (strlen(!empty($ncr->hasil_verif) ? $ncr->hasil_verif : '') <= 200)
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                                <div style="text-align: justify; border-bottom: 1px solid #000;">
                                    <span
                                        style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                        &nbsp;
                                    </span>
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 20%; padding: 0; border-left-width: 1px; vertical-align: top;">
                <table style="width: 100%; border: 0px;">
                    <tr>
                        <td style="width: 100%: text-align: center; border-top-width: 0px;" align="center"
                            colspan="2">Hasil Verifikasi</td>
                    </tr>
                    <tr>
                        <td style="width: 35%; border: 0px; padding-top: 15px;" align="right">
                            <span
                                style="padding: 0px 6px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! (!empty($ncr->hasil_verif) ? $ncr->hasil_verif : '') == 'efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                        </td>
                        <td style="width: 65%; border: 0px; padding-top: 15px;">
                            Efektif
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 35%; border: 0px;" align="right">
                            <span
                                style="padding: 0px 6px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! (!empty($ncr->hasil_verif) ? $ncr->hasil_verif : '') == 'tdk_efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                        </td>
                        <td style="width: 65%; border: 0px;">
                            Tidak efektif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 14%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                Diverifikasi oleh:
            </td>
            <td
                style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
                (Auditor)
            </td>
            <td style="width: 46%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="2">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 14%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                @if($qr6 != null && $ncr->diverif_oleh_auditor != null)
                <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(50)->generate($qr6)) }} ">
                @endif
                <br>
                <div style="border-bottom: 1px dotted #000;">
                    {{ !empty($ncr->diverif_oleh_auditor) ? $ncr->diverif_oleh_auditor : '' }}
                </div>
            </td>
            <td
                style="width: 46%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
                Tanggal:
            </td>
            <td style="width: 18%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                <div style="border-bottom: 1px dotted #000;">
                    {{ !empty($ncr->tgl_verif) ? date('d-m-Y', strtotime($ncr->tgl_verif)) : '' }}
                </div>
            </td>
            <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="2">
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span
                        style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                        Verifikasi&nbsp;Wakil&nbsp;Manajemen :
                    </span>
                    <span style="padding-bottom: 2.55px; word-wrap: break-word; border-bottom: 1px solid #000; line-height: 27px;">
                        {{ !empty($ncr->verif_wm) ? $ncr->verif_wm : '' }}
                    </span>
                </div>
                @if (strlen(!empty($ncr->verif_wm) ? $ncr->verif_wm : '') <= 100)
                    <div style="text-align: justify; border-bottom: 1px solid #000;">
                        <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                            &nbsp;
                        </span>
                    </div>
                @endif
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px;">
        <tr>
            <td style="width: 44%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                Diverifikasi oleh : (Wakil Manajemen)
                @if($ncr->diverif_oleh_wm != null)
                <br><br>
                <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(50)->generate($qr5)) }} ">
                <br>
                {{ !empty($ncr->diverif_oleh_wm) ? $ncr->diverif_oleh_wm : '' }}
                @endif
            </td>
            <td
                style="width: 10%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
                &nbsp;
            </td>
            <td style="width: 26%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                colspan="2">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 44%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td style="width: 10%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
            <td
                style="width: 26%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
                Tanggal:
            </td>
            <td style="width: 18%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                <div style="border-bottom: 1px dotted #000;">
                    {{ !empty($ncr->tgl_verif_wm) ? date('d-m-Y', strtotime($ncr->tgl_verif_wm)) : '' }}
                </div>
            </td>
            <td
                style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                &nbsp;
            </td>
        </tr>
    </table>

    <table style="width: 100%; padding-top: 1px; border: 0px;">
        <tr>
            <td style="width: 100%; font-size: 14px; border: 0px;">* Diisi oleh auditee</td>
        </tr>
        <tr>
            <td style="width: 100%; font-size: 14px; border: 0px;">Form No.: IV-01.016 Rev. G</td>
        </tr>
    </table>
</body>

</html>
