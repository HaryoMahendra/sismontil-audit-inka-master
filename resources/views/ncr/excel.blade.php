@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak NCR.xls');
@endphp

<style>
    #files-area {
        height: 150px;
        background-color: rgb(153, 196, 201);
    }
</style>

<table id="dataTable3" class="display" style="width:100%" border="1">
    <thead class="thead-dark">
        <tr>
            <th colspan="2" class="d-flex justify-content-center" style="height: 75px;">
                <img src="{{ asset('logoinka.png') }}" alt="logo" width="10%">
            </th>
            <th colspan="15" class="text-center">LOG STATUS AUDIT NCR (Non Conformity Record )</th>
        </tr>
        <tr>
            <th class="text-center" id="files-area">No</th>
            <th class="text-center" id="files-area">No. NCR</th>
            <th class="text-center" id="files-area">Tgl Terbit</th>
            <th class="text-center" id="files-area">Dokumen Acuan</th>
            <th class="text-center" id="files-area">Tema Audit</th>
            <th class="text-center" id="files-area">Periode</th>
            <th class="text-center" id="files-area">Proses</th>
            <th class="text-center" id="files-area">Departemen yang diaudit</th>
            <th class="text-center" id="files-area">Nama Auditor</th>
            <th class="text-center" id="files-area">Uraian Ketidaksesuaian</th>
            <th class="text-center" id="files-area">Akar penyebab permasalahan</th>
            <th class="text-center" id="files-area">Uraian Perbaikan</th>
            <th class="text-center" id="files-area">Uraian Pencegahan untuk menjamin tidak terulang</th>
            <th class="text-center" id="files-area">Uraian Verifikasi</th>
            <th class="text-center" id="files-area">Tanggal Verifikasi Wakil Manajemen</th>
            <th class="text-center" id="files-area">Tgl Deadline</th>
            <th class="text-center" id="files-area">Status</th>
            {{-- <th class="text-center">Bukti</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($ncr as $data_ncr)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $data_ncr->no_ncr }}<br>
                </td>
                <td class="text-center">{{ $data_ncr->tgl_terbitncr }}</td>
                <td class="text-center">{{ $data_ncr->dok_acuan }}</td>
                <td class="text-center">{{ $data_ncr->tema->nama_tema }}</td>
                <td class="text-center">{{ $data_ncr->periode_audit }}</td>
                <td class="text-center">{{ $data_ncr->proses_audit }}</td>
                <td class="text-center">
                    @foreach ($departemen as $dept)
                        @if ($data_ncr->name_objek_audit == $dept['div_name'])
                            {{ $dept['div_name'] }}
                        @endif
                    @endforeach
                </td>
                <td class="text-center">
                    @if ($data_ncr->auditor_eksternal != null)
                    {{ $data_ncr->auditor_eksternal }}
                    @else
                    {{ $data_ncr->nama_auditor }}
                    @endif
                </td>
                <td class="text-center">{{ $data_ncr->uraian_ncr }}</td>
                <td class="text-center">{{ $data_ncr->akar_masalah }}</td>
                <td class="text-center">{{ $data_ncr->uraian_perbaikan }}</td>
                <td class="text-center">{{ $data_ncr->uraian_pencegahan }}</td>
                <td class="text-center">{{ $data_ncr->uraian_verif }}</td>
                <td class="text-center">{{ $data_ncr->tgl_verif_wm }}</td>
                <td class="text-center">{{ $data_ncr->tgl_deadline }}</td>
                <td class="text-center">{{ $data_ncr->status }}
                    @if ($data_ncr->status == 'close')
                        {{ $data_ncr->hasil_verif }}
                    @endif
                </td>
                {{-- <td class="text-center">
                    @if (!empty($data_ncr->bukti))
                        <a href="{{ asset('storage/' . $data_ncr->bukti) }}" target="_blank">Lihat Bukti</a>
                    @endif
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
