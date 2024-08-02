<!DOCTYPE html>
<html>

<head>
    <title>Nilai {{ $tahfidz->nama }}</title>
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

        .footer {
            position: absolute;
            right: 0;
            text-align: right;
            padding: 20px;
        }

        .footer img {
            width: 150px;
            /* Adjust the size of the signature image */
            height: auto;
            margin-top: 10px;
        }
    </style>
    <center class="my-3">
        <h3>LAPORAN HASIL HAFALAN SISWA</h4>
    </center>
    <hr class="garis" />

    <table>
        <tr>
            <th>NIS</th>
            <td>: {{ $tahfidz->nis }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>: {{ $tahfidz->nama }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>: {{ $tahfidz->alamat }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>: {{ $tahfidz->jenis_kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>: {{ $tahfidz->kategori == 'ANAK_PONDOK' ? 'ANAK PONDOK' : 'TPQ' }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>: {{ \Carbon\Carbon::createFromFormat('Y-m-d', $tahfidz->tgl_lahir)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Nama Ayah</th>
            <td>: {{ $tahfidz->nama_ayah }}</td>
        </tr>
        <tr>
            <th>Nama Ibu</th>
            <td>: {{ $tahfidz->nama_ibu }}</td>
        </tr>
        <tr>
            <th>No Telp</th>
            <td>: {{ $tahfidz->no_telp }}</td>
        </tr>
    </table>
    <br>

    <table class='table-bordered table'>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Surat</th>
                <th scope="col">Total Ayat</th>
                <th scope="col">Juz</th>
                <th scope="col">Penilai</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilai as $i => $row)
                <tr>
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $row->nama_surat }}</td>
                    <td>{{ $row->total_ayat }}</td>
                    <td>{{ $row->juz }}</td>
                    <td>{{ $row->user->nama . ($row->user->gelar ? '.' . $row->user->gelar : '') }}</td>
                    <td>
                        @if ($row->status == 0)
                            <span class="badge bg-success">Lulus</span>
                        @elseif ($row->status == 1)
                            <span class="badge bg-danger">Tidak Lulus</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Lembasari, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        <img src="{{ public_path('template/assets/img/ttd.png') }}">
        <p>Ustadz Saekhudin</p>
    </div>
</body>

</html>
