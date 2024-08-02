@extends('layouts.app')
@section('title', 'Tahfidz')
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="card-body">
                        <h5 class="card-title">Data Tahfidz</span> </h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $rows->count() }}</h6>
                                <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan </span> <br>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card" style="margin-top: -25px;">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    @if (auth()->user()->roles == 'ADMIN' || auth()->user()->roles == 'OPERATOR')
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdropTahfidz">
                            <i class="bi bi-person-x"></i> Tambah data
                        </button>
                    @endif
                    <div>
                        {{-- <a class="btn btn-sm btn-danger btn-download-pdf" href="/pdf/tahfidz/" id="exportPdf"> --}}
                        {{-- <a class="btn btn-sm btn-danger btn-download-pdf" href="/pdf/tahfidz/" id="exportPdf"> --}}
                        <a class="btn btn-sm btn-danger btn-download-pdf" id="exportTahfizhPdf"
                            data-route="{{ route('tahfizhByNilai') }}" data-file-name="laporan_nilai">
                            <i class="fa-solid fa-file-pdf"></i> Download Nilai PDF
                        </a>
                        <a class="btn btn-sm btn-danger btn-download-pdf" id="exportTahfizhPdf"
                            data-route="{{ route('tahfizhBySearch') }}" data-file-name="laporan_tahfidz">
                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                        </a>
                    </div>
                </div>

                <!-- Table with stripped rows -->
                <table class="datatable table-striped table" id="example">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Nama Ayah</th>
                            <th scope="col">Nama Ibu</th>
                            <th scope="col">Jumlah Hafalan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $i => $row)
                            <tr>
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>{{ $row->nis }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    @if ($row->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">Laki-Laki</span>
                                    @else
                                        <span class="badge bg-danger">Perempuan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($row->kategori == 'ANAK_PONDOK')
                                        <span class="badge bg-warning">Anak Pondok</span>
                                    @else
                                        <span class="badge bg-success">TPQ</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($row->status == 'Aktif')
                                        <span class="badge bg-primary">Aktif</span>
                                    @else
                                        <span class="badge bg-success">Lulus</span>
                                    @endif
                                </td>
                                <th>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->tgl_lahir)->format('d M Y') }}</th>
                                <td>{{ $row->nama_ayah }}</td>
                                <td>{{ $row->nama_ibu }}</td>
                                <td>{{ $row->total_juz ? $row->total_juz . 'Juz' : '-' }}</td>
                                <td>
                                    <a class="btn btn-outline-info btn-sm dropdown" data-bs-toggle="dropdown"
                                        href="#"> Opsi <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                                    <div>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                                            @if (auth()->user()->roles == 'ADMIN' || auth()->user()->roles == 'OPERATOR')
                                                <li class="dropdown-header d-flex text-start">
                                                    <a href="/{{ request()->segment(1) }}/tahfidz/edit/{{ $row->id }}"
                                                        class="btn btn-outline-info btn-sm me-2"><i
                                                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                    <a href="#" onclick="deleteForm({{ $row->id }})"
                                                        class="btn btn-outline-danger btn-sm me-2"><i
                                                            class="fa-solid fa-trash"></i> Hapus</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                            @endif
                                            <li class="dropdown-header d-flex text-start">
                                                <a href="/{{ request()->segment(1) }}/tahfidz/nilai/{{ $row->id }}"
                                                    class="btn btn-outline-success btn-sm me-2"><i
                                                        class="fa-solid fa-book-bookmark"></i> Nilai</a>

                                                <a href="/{{ request()->segment(1) }}/tahfidz/show/{{ $row->id }}"
                                                    class="btn btn-outline-secondary btn-sm me-2"><i
                                                        class="fa-solid fa-eye"></i> Lihat Detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <form id="deleteForm" class="d-none"
                                        action="/{{ request()->segment(1) }}/tahfidz/delete" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="deleteId">
                                        <button type="submit" class="d-none"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="disablebackdropTahfidz" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Tahfidz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" novalidate action="/{{ request()->segment(1) }}/tahfidz/add"
                        method="post">
                        @csrf
                        <div class="col-md-12">
                            <label for="yourName" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="yourName" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <div class="input-group has-validation">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" required
                                    name="alamat" cols="5" rows="0"></textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <div class="input-group has-validation">
                                <select name="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    aria-label="Default select example">
                                    <option selected> --- pilih jenis kelamin --- </option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="" class="form-label">Kategori</label>
                            <div class="input-group has-validation">
                                <select name="kategori" class="form-select @error('kategori') is-invalid @enderror"
                                    aria-label="Default select example">
                                    <option selected> --- pilih kategori --- </option>
                                    <option value="ANAK_PONDOK" {{ old('kategori') == 'ANAK_PONDOK' ? 'selected' : '' }}>
                                        Anak Pondok</option>
                                    <option value="TPQ" {{ old('kategori') == 'TPQ' ? 'selected' : '' }}>
                                        TPQ</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Status</label>
                            <div class="input-group has-validation">
                                <select name="status" class="form-select @error('status') is-invalid @enderror"
                                    aria-label="Default select example">
                                    <option selected> --- pilih status --- </option>
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Lulus" {{ old('status') == 'Lulus' ? 'selected' : '' }}>
                                        Lulus</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah"
                                class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah"
                                value="{{ old('nama_ayah') }}" required>
                            @error('nama_ayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu"
                                class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu"
                                value="{{ old('nama_ibu') }}" required>
                            @error('nama_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="no_telp" class="form-label">No Telp</label>
                            <input type="number" name="no_telp"
                                class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                value="{{ old('no_telp') }}" required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script>
        function deleteForm(id) {
            document.getElementById('deleteId').value = id;
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                        .then(() => {
                            document.getElementById('deleteForm').submit();
                        });
                }
            });
        }

        document.querySelectorAll('#exportTahfizhPdf').forEach(button => {
            button.addEventListener('click', function() {
                var table = document.querySelector('#example'); // Ganti dengan ID tabel kamu

                // Mapping header ke properti yang diinginkan
                var headerMapping = {
                    'Nama': 'nama',
                    'Alamat': 'alamat',
                    'Jenis Kelamin': 'jenis_kelamin',
                    'Kategori': 'kategori',
                    'Nama Ayah': 'nama_ayah',
                    'Nama Ibu': 'nama_ibu',
                    'Status': 'status',
                    'Tanggal Lahir': 'tgl_lahir',
                    'Jumlah Hafalan': 'total_juz'
                };

                var headers = [];
                var data = [];

                // Ambil header tabel dan sesuaikan dengan mapping
                table.querySelectorAll('thead th').forEach(function(header) {
                    var headerText = header.textContent.trim();
                    if (headerMapping[headerText]) {
                        headers.push(headerMapping[headerText]);
                    } else {
                        headers.push(
                            headerText); // Jika tidak ada mapping, gunakan nama header aslinya
                    }
                });

                // Ambil data dari baris tabel
                table.querySelectorAll('tbody tr').forEach(function(row) {
                    var rowData = {};
                    row.querySelectorAll('td').forEach(function(cell, index) {
                        var property = headers[index];
                        if (property) {
                            rowData[property] = cell.textContent.trim();
                        }
                    });
                    data.push(rowData);
                });

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                var route = this.getAttribute('data-route');
                var fileNamePrefix = this.getAttribute('data-file-name');


                fetch(route, { // Pastikan URL ini sesuai dengan route Anda
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            data: data
                        })
                    })
                    .then(response => {
                        console.log('Response status:', response.status); // Log status respons
                        if (response.ok) {
                            return response.blob(); // Mendapatkan file blob
                        }
                        return response.text(); // Mengambil teks jika terjadi kesalahan
                    })
                    .then(blob => {
                        var now = new Date();
                        var formattedDate = now.toISOString().replace(/[-:]/g, '_').replace('T', '_')
                            .replace(
                                /\..+/, '');
                        var fileName = `${fileNamePrefix}_${formattedDate}.pdf`;

                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = fileName; // Atur nama file
                        link.click();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            })
        });
    </script>


@endsection
