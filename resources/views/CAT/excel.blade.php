@php
    header("Content-Type: application/vnd.ms-excel");
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Disposition: attachment; filename=Cetak_CAT.xls");
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export CAT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #files-area {
            background-color: rgb(153, 196, 201);
            font-weight: bold;
            vertical-align: middle;
            height: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: top;
        }
        th {
            background-color: #d3d3d3;
        }
        .header-row {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr class="header-row">
                <th colspan="2" style="height: 75px;">
                    <img src="{{ public_path('logoinka.png') }}" alt="Logo INKA" width="80">
                </th>
                <th colspan="5" style="font-size: 16px; font-weight: bold;">LOG STATUS AUDIT CAT (Corrective Action Team)</th>
            </tr>
            <tr>
                <th id="files-area">No</th>
                <th id="files-area">Tanggal</th>
                <th id="files-area">Departemen</th>
                <th id="files-area">Penyelidikan Ketidaksesuaian</th>
                <th id="files-area">Perbaikan</th>
                <th id="files-area">Rencana Tindakan Perbaikan</th>
                <th id="files-area">Verifikator</th>
            </tr>
        </thead>
        <tbody>
            @forelse($catList as $index => $cat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($cat->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $cat->departemen }}</td>
                    <td>{{ $cat->penyelidikan ?? '-' }}</td>
                    <td>{{ $cat->perbaikan ?? '-' }}</td>
                    <td>{{ $cat->rencana ?? '-' }}</td>
                    <td>{{ $cat->verifikator ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
