@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak OFI.xls');
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
            <th colspan="13" class="text-center">LOG STATUS AUDIT OFI (Opportunity for Improvement)</th>
        </tr>
        <tr>
            <th class="text-center" id="files-area">No</th>
            <th class="text-center" id="files-area">No. Ofi</th>
            <th class="text-center" id="files-area">Tgl. Terbit OFI</th>
            <th class="text-center" id="files-area">Klausul</th>
            <th class="text-center" id="files-area">Tema</th>
            <th class="text-center" id="files-area">Periode</th>
            <th class="text-center" id="files-area">Proses</th>
            <th class="text-center" id="files-area">Auditor</th>
            <th class="text-center" id="files-area">Departemen yang mengerjakan</th>
            <th class="text-center" id="files-area">Uraian Permasalahan</th>
            <th class="text-center" id="files-area">Usulan Peningkatan</th>
            <th class="text-center" id="files-area">Tindak Lanjut Usulan Peningkatan</th>
            <th class="text-center" id="files-area">Tgl. Tindak Lanjut Auditee</th>
            <th class="text-center" id="files-area">Uraian Verifikasi</th>
            <th class="text-center" id="files-area">Tgl. Verifikasi</th>
            <th class="text-center" id="files-area">Tgl. Deadline OFI</th>
            <th class="text-center" id="files-area">Status Dokumen</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ofi as $data_ofi)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $data_ofi->no_ofi }}<br>
                </td>
                <td class="text-center">{{ $data_ofi->tgl_terbitofi }}</td>
                <td class="text-center">{{ $data_ofi->no_identitas }}</td>
                <td class="text-center">{{ $data_ofi->tema->nama_tema}}</td>
                <td class="text-center">{{ $data_ofi->periode_audit }}</td>
                <td class="text-center">{{ $data_ofi->proses_audit }}</td>
                <td class="text-center">
                    @if ($data_ofi->auditor_eksternal != null)
                    {{ $data_ofi->auditor_eksternal }}
                    @else
                    {{ $data_ofi->diusulkan_oleh }}
                    @endif
                </td>
                <td class="text-center">
                @foreach ($departemen as $dept)
                        @if ($data_ofi->name_objek_audit == $dept['div_name'])
                            {{ $dept['div_name'] }}
                        @endif
                    @endforeach
                </td>
                <td class="text-center">{{ $data_ofi->uraian_permasalahan }}</td>
                <td class="text-center">{{ $data_ofi->uraian_peningkatan }}</td>
                <td class="text-center">{{ $data_ofi->tl_usulanofi }}</td>
                <td class="text-center">{{ $data_ofi->tgl_tl }}</td>
                <td class="text-center">{{ $data_ofi->uraian_verif }}</td>
                <td class="text-center">{{ $data_ofi->tgl_verif }}</td>
                <td class="text-center">{{ $data_ofi->tgl_deadline }}</td>
                <td class="text-center">{{ $data_ofi->status_dokumen }}
                    @if ($data_ofi->status_dokumen == 'close')
                        {{ $data_ofi->hasil_verif }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
