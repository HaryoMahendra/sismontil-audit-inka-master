@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak Monitoring TL.xls');
@endphp

<table id="dataTable3" class="display" style="width:100%" border="1">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Jenis Temuan</th>
            <th class="text-center">No. Dokumen</th>
            <th class="text-center">Proses</th>
            <th class="text-center">Tema</th>
            <th class="text-center">Objek</th>
            <th class="text-center">Tgl. Deadline</th>
            <th class="text-center">Tgl. Penyelesaian</th>
            <th class="text-center">Status</th>
            {{-- <th class="text-center">Bukti</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($monitoring as $mon)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">
                    @if (str_contains($mon->no_ncr, 'NCR') )
                        NCR
                    @else
                        OFI
                    @endif
                </td>
                <td class="text-center">{{ $mon->no_ncr }}</td>
                <td class="text-center">{{ $mon->proses_audit }}</td>
                <td class="text-center">{{ $mon->tema->nama_tema }}</td>
                <td class="text-center">
                    @foreach ($departemen as $dept)
                        @if ($mon->name_objek_audit == $dept['div_name'])
                            {{ $dept['div_name'] }}
                        @endif
                    @endforeach
                </td>
                <td class="text-center">{{ $mon->tgl_deadline }}</td>
                <td class="text-center">{{ $mon->tgl_action }}</td>
                <td class="text-center">{{ $mon->status }}</td>
                {{-- <td class="text-center">
                    @if (!empty($mon->bukti))
                        <a href="{{ asset('storage/pdf/' . $mon->bukti) }}" target="_blank">Lihat bukti</a>
                    @endif
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
