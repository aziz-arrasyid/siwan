<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap data</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 3px;
            text-align: left;
        }

        .kolomKecil {
            width: 65px;
            text-align: center;
        }

        .kolomNormal {
            width: 100%;
        }

        th {
            text-align: center;
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="title">Absensi {{ $namaPDF->classroom->classroom_name }}, {{ $namaPDF->hari }} {{ $namaPDF->tanggal }}</div>
    <table>
        <thead>
            <tr>
                <th class="kolomKecil">No</th>
                <th class="kolomNormal">Nama Guru</th>
                <th class="kolomKecil">L/P</th>
                <th class="kolomKecil">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="kolomKecil">1</td>
                <td class="kolomNormal">{{ $absensikelasGuru->teacher->full_name }}</td>
                <td class="kolomKecil">{{ $absensikelasGuru->teacher->gender }}</td>
                <td class="kolomKecil">{{ $absensikelasGuru->status_guru }}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th class="kolomKecil">No</th>
                <th class="kolomNormal">Nama siswa</th>
                <th class="kolomKecil">L/P</th>
                <th class="kolomKecil">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensikelas as $item)
            <tr>
                <td class="kolomKecil">{{ $loop->iteration }}</td>
                <td class="kolomNormal">{{ $item->student->full_name }}</td>
                <td class="kolomKecil">{{ $item->student->gender }}</td>
                <td class="kolomKecil">{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
