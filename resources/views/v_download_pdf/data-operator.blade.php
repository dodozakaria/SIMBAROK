<!DOCTYPE html>
<html>

<head>
    <title>Data Operator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        .garis {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
        }
    </style>
    <center class="my-3">
        <h3>LAPORAN KESELURUHAN DATA OPERATOR</h4>
    </center>
    <hr class="garis" />

    <table class="table-striped table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Peran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
                <tr>
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        @if ($row->status == 0)
                            <span class="badge bg-warning">Menunggu</span>
                        @elseif ($row->status == 1)
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td><span class="fw-bold">{{ $row->roles }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        Dicetak Dicetak pada: {{ $date }}
    </div>
</body>

</html>
