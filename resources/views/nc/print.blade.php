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

<table style="width: 100%;">
    <tr>
        <td style="width: 45%; vertical-align: middle; text-align: center;">
            <img src="{{ asset('assets/images/logo-inka.png') }}" style="width: 50%;">
        </td>
        <td style="width: 55%; vertical-align: middle; text-align: center; border-left-width: 1px;">
            <span style="font-size: 20px; font-weight: bold; text-transform: uppercase;">Laporan Ketidak Sesuaian
            </span><br>
            <span style="font-size: 17px; text-transform: uppercase; font-style: italic;">(Non Conformity Report)</span>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 5px;">
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            NC No.
        </td>
        <td style="width: 60%; vertical-align: middle;">
            : {{ $nc->no_nc }}
        </td>
        <td style="width: 20%; vertical-align: middle; border-left-width: 1px;">
            Tanggal: {{ $nc->tgl_terbitnc ? date('d-m-Y', strtotime($nc->tgl_terbitnc)) : '' }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Temuan
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $nc->opsi_temuan }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Departemen yang diaudit
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $nc->users->name }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Bab yang diaudit
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $nc->bab_audit }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Dokumen Acuan
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $nc->dok_acuan }}
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;" colspan="2">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 45px;">
                    Uraian ketidaksesuaian
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    : {{ $nc->uraian_nc }}
                </span>
            </div>
            @if (strlen($nc->uraian_nc) <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>
    {{-- <tr>
        <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="3">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="3">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
    </tr> --}}
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
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $nc->kategori == 'Mayor' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
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
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $nc->kategori == 'Minor' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 20%; border: 0px;">
                        Minor
                    </td>
                </tr>
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
            <img width="50" height="60" src="{{ asset('storage/' . $nc->ttd_auditor_nc) }}" alt="ttd_auditor">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ $nc->nama_auditor }}</div>
        </td>
        <td style="width: 7%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td
            style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;">
            (M/SM)
        </td>
        <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <img width="50" height="60" src="{{ asset('storage/' . $nc->ttd_diakui_oleh_nc) }}" alt="">
            <br>
            <div>
                {{ $nc->diakui_oleh }}
            </div>
            <div style="border-bottom: 1px dotted #000;">{{ $nc->diakui_oleh_jabatan }}
                {{ $nc->diakui_oleh_jabatan_nm }}</div>
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
            <img width="50" height="60" src="{{ asset('storage/' . $nc->ttd_disetujui_oleh_nc) }}"
                alt="ttd_disetujui_oleh">
            <br>
            <div>{{ $nc->disetujui_oleh }}</div>
            <div style="border-bottom: 1px dotted #000;">{{ $nc->disetujui_oleh1_jabatan }}
                {{ $nc->disetujui_oleh1_jabatan_nm }}</div>
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
                {{-- {{ $nc->tgl_accgm }} --}}
                {{ $nc->tgl_accgm ? date('d-m-Y', strtotime($nc->tgl_accgm)) : '' }}
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
        <td style="width: 34%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;" colspan="3">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ $nc->tgl_planaction }} --}}
                {{ $nc->tgl_planaction ? date('d-m-Y', strtotime($nc->tgl_planaction)) : '' }}
            </div>
        </td>
        <td style="width: 30%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;" colspan="3">
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
                                Akar penyebab permasalahan * :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlnc->akar_masalah) ? $tlnc->akar_masalah : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlnc->akar_masalah) ? $tlnc->akar_masalah : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @endif
                    </td>
                </tr>
                {{-- <tr>
                    <td style="width: 25%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        Akar penyebab permasalahan * :
                    </td>
                    <td style="width: 75%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        <div style="border-bottom: 1px solid #000;">{{ !empty($tlnc->akar_masalah) ? $tlnc->akar_masalah : '' }}</div>
                    </td>
                </tr> --}}
                {{-- <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr> --}}
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
                                Uraian Perbaikan * :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlnc->uraian_perbaikan) ? $tlnc->uraian_perbaikan : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlnc->uraian_perbaikan) ? $tlnc->uraian_perbaikan : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @endif
                    </td>
                </tr>
                {{-- <tr>
                    <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        Uraian Perbaikan * :
                    </td>
                    <td style="width: 85%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        <div style="border-bottom: 1px solid #000;">{{ !empty($tlnc->uraian_perbaikan) ? $tlnc->uraian_perbaikan : '' }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr> --}}
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
                                Uraian Pencegahan untuk menjamin tidak terulang * :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlnc->uraian_pencegahan) ? $tlnc->uraian_pencegahan : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlnc->uraian_pencegahan) ? $tlnc->uraian_pencegahan : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @endif
                    </td>
                </tr>
                {{-- <tr>
                    <td style="width: 40%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        Uraian Pencegahan untuk menjamin tidak terulang * :
                    </td>
                    <td style="width: 60%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        <div style="border-bottom: 1px solid #000;">{{ !empty($tlnc->uraian_pencegahan) ? $tlnc->uraian_pencegahan : '' }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr> --}}
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
                {{-- {{ !empty($tlnc->tgl_action) ? $tlnc->tgl_action : '' }} --}}
                {{ !empty($tlnc->tgl_action) ? date('d-m-Y', strtotime($tlnc->tgl_action)) : '' }}
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
            <img width="50" height="60"
                src="{{ !empty($tlnc->ttd_disetujui_oleh_tlnc) ? asset('storage/' . $tlnc->ttd_disetujui_oleh_tlnc) : '' }}"
                alt="Ttd disetujui oleh">
            <br>
            <div>{{ !empty($tlnc->disetujui_oleh_tl) ? $tlnc->disetujui_oleh_tl : '' }}</div>
            <div style="border-bottom: 1px dotted #000;">
                {{ !empty($tlnc->disetujui_oleh_tl_jabatan) ? $tlnc->disetujui_oleh_tl_jabatan : '' }}
                {{ !empty($tlnc->disetujui_oleh_tl_jabatan_nm) ? $tlnc->disetujui_oleh_tl_jabatan_nm : '' }}</div>
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
                {{-- {{ !empty($tlnc->tgl_accgm) ? $tlnc->tgl_accgm : '' }} --}}
                {{ !empty($tlnc->tgl_accgm) ? date('d-m-Y', strtotime($tlnc->tgl_accgm)) : '' }}
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
                            <span style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px;">
                                Verifikasi
                            </span>
                            <span style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px;">
                                :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlnc->uraian_verifikasi) ? $tlnc->uraian_verifikasi : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlnc->uraian_verifikasi) ? $tlnc->uraian_verifikasi : '') <= 100)
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
                        @elseif (strlen(!empty($tlnc->uraian_verifikasi) ? $tlnc->uraian_verifikasi : '') <= 200)
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
                {{-- <tr>
                    <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        Verifikasi
                    </td>
                    <td style="width: 5%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        :
                    </td>
                    <td style="width: 80%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
                        <div style="border-bottom: 1px solid #000;">{{ !empty($tlnc->uraian_verifikasi) ? $tlnc->uraian_verifikasi : '' }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="3">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="3">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="3">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="3">
                        <div style="border-bottom: 1px solid #000;">&nbsp;</div>
                    </td>
                </tr> --}}
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
                            style="padding: 0px 6px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! (!empty($tlnc->hasil_verif) ? $tlnc->hasil_verif : '') == 'efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 65%; border: 0px; padding-top: 15px;">
                        Efektif
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;" align="right">
                        <span
                            style="padding: 0px 6px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! (!empty($tlnc->hasil_verif) ? $tlnc->hasil_verif : '') == 'tdk_efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 65%; border: 0px;">
                        Tidak efektif
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%: text-align: center; border: 0px; font-size: 13px;" align="center"
                        colspan="2">(Akan dibahas dalam Tinjauan Manajemen)</td>
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
            <img width="50" height="60"
                src="{{ !empty($tlnc->ttd_verifikator_tlnc) ? asset('storage/' . $tlnc->ttd_verifikator_tlnc) : '' }}"
                alt="Ttd verif oleh">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ !empty($tlnc->verifikator) ? $tlnc->verifikator : '' }}
            </div>
        </td>
        <td
            style="width: 46%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
            Tanggal:
        </td>
        <td style="width: 18%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ !empty($tlnc->tgl_verif) ? $tlnc->tgl_verif : '' }} --}}
                {{ !empty($tlnc->tgl_verif) ? date('d-m-Y', strtotime($tlnc->tgl_verif)) : '' }}
            </div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;" colspan="2">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                    Rekomendasi Tinjauan Manajemen :
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    {{ !empty($tlnc->rekomendasi) ? $tlnc->rekomendasi : '' }}
                </span>
            </div>
            @if (strlen(!empty($tlnc->rekomendasi) ? $tlnc->rekomendasi : '') <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>
    {{-- <tr>
        <td style="width: 25%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Rekomendasi Tinjauan Manajemen :
        </td>
        <td style="width: 75%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">{{ !empty($tlnc->rekomendasi) ? $tlnc->rekomendasi : '' }}</div>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="2">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
        <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="2">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
        <td style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="2">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
    </tr> --}}
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 44%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Diverifikasi oleh Senior Manager Tata Kelola Perusahaan:
            <br>
            <img width="50" height="60"
                src="{{ !empty($tlnc->ttd_verifsm_tlnc) ? asset('storage/' . $tlnc->ttd_verifsm_tlnc) : '' }}"
                alt="Ttd verif oleh">
            <br>
            {{ !empty($tlnc->namasm_verif) ? $tlnc->namasm_verif : '' }}
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
                {{ !empty($tlnc->tgl_verifsm) ? date('d-m-Y', strtotime($tlnc->tgl_verifsm)) : '' }}
            </div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px; border: 0px;">
    <tr>
        <td style="width: 100%; font-size: 14px; border: 0px;">* Diisi oleh auditee</td>
    </tr>
</table>
