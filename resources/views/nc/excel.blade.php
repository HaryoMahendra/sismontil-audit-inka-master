@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak NC.xls');
@endphp

<table id="dataTable3" class="display" style="width:100%" border="1">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">No. NC</th>
            <th class="text-center">Periode</th>
            <th class="text-center">Proses</th>
            <th class="text-center">Tema</th>
            <th class="text-center">Objek</th>
            <th class="text-center">Uraian Temuan</th>
            {{-- <th class="text-center">Uraian Perbaikan</th> --}}
            <!--<th class="text-center">Dokumen</th>-->
            <th class="text-center">Tgl terbit</th>
            <th class="text-center">Tgl Deadline</th>
            <th class="text-center">Status</th>
            {{-- <th class="text-center">Bukti</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($nc as $data_nc)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $data_nc->no_nc }}<br>

                </td>
                <td class="text-center">{{ $data_nc->periode_audit }}</td>
                <td class="text-center">{{ $data_nc->proses_audit }}</td>
                <td class="text-center">{{ $data_nc->users_tema->name }}</td>
                <td class="text-center">{{ $data_nc->users->name }}</td>
                <td class="text-center">{{ $data_nc->uraian_nc }}</td>
                <!--<td class="text-center">{{ $data_nc->dokumen }}</td>-->
                <td class="text-center">{{ date('d-m-Y', strtotime($data_nc->tgl_terbitnc)) }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($data_nc->tgl_deadline)) }}</td>
                <td class="text-center">{{ $data_nc->status }}</td>
                {{-- <td class="text-center">
                    @if (!empty($data_nc->bukti))
                        <a href="{{ asset('storage/' . $data_nc->bukti) }}" target="_blank">Lihat Bukti</a>
                    @endif
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
