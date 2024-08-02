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
        <h3>LAPORAN KESELURUHAN DATA TAHFIDZ</h4>
    </center>
    <hr class="garis" />

    <table class="table-striped table">
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Kategori</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Nama Ayah</th>
                <th scope="col">Nama Ibu</th>
                <th scope="col">Jumlah Hafalan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0; // Inisialisasi variabel untuk penomoran
            @endphp
            @foreach ($rows as $item)
                <tr>
                    <th scope="row">{{ $i + 1 }}</th>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['alamat'] }}</td>
                    <td>
                        @if ($item['jenis_kelamin'] == 'Laki-Laki')
                            <span class="badge bg-primary">Laki-Laki</span>
                        @else
                            <span class="badge bg-danger">Perempuan</span>
                        @endif
                    </td>
                    <td>
                        @if ($item['kategori'] == 'ANAK_PONDOK')
                            <span class="badge bg-warning">Anak Pondok</span>
                        @else
                            <span class="badge bg-success">TPQ</span>
                        @endif
                    </td>
                    <td>
                        @if ($item['status'] == 'Aktif')
                            <span class="badge bg-primary">Aktif</span>
                        @else
                            <span class="badge bg-success">Lulus</span>
                        @endif
                    </td>
                    <th>{{ $item['tgl_lahir'] }}</th>
                    <td>{{ $item['nama_ayah'] }}</td>
                    <td>{{ $item['nama_ibu'] }}</td>
                    <td>{{ $item['total_juz'] }}</td>
                </tr>
                @php
                    $i++; // Increment variabel untuk penomoran baris berikutnya
                @endphp
            @endforeach
        </tbody>
    </table>
    <div class="">
        {{-- Dicetak Dicetak pada: {{ $date }} --}}
    </div>
</body>

</html>
