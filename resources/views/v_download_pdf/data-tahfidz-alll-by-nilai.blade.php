<!DOCTYPE html>
<html>

<head>
    <title>Data Tahfidz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 7pt;
        }

        .garis {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
        }
    </style>
    <center class="my-3">
        <h3>LAPORAN DATA NILAI HAFALAN SANTRI TERBARU</h4>
    </center>
    <hr class="garis" />

    <table class='table-bordered table'>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Santri</th>
                <th scope="col">Nama Surat</th>
                <th scope="col">Total Ayat</th>
                <th scope="col">Juz</th>
                <th scope="col">Penilai</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
                <tr>
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $row['nama_tahfizh'] }}</td>
                    <td>{{ $row['nama_surat'] }}</td>
                    <td>{{ $row['total_ayat'] }}</td>
                    <td>{{ $row['juz'] }}</td>
                    <td>{{ $row['nama_user'] . ($row['gelar'] ? '.' . $row['gelar'] : '') }}</td>
                    <td>
                        @if ($row['status'] == 0)
                            <span class="badge bg-success">Lulus</span>
                        @elseif ($row['status'] == 1)
                            <span class="badge bg-danger">Tidak Lulus</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        Dicetak Dicetak pada: {{ $date }}
    </div>
</body>

</html>
