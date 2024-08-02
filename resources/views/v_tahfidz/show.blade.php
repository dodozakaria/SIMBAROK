@extends('layouts.app')
@section('title', 'Tahfidz')
@section('content')
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body profile-card d-flex flex-column align-items-center pt-4">

                {{-- foto profile pada saat detail tahfidz --}}
                <img src="{{ $tahfidz->jenis_kelamin == 'L' ? asset('template/assets/img/avatar_male.webp') : asset('template/assets/img/avatar_female.png') }}"
                    alt="Profile" class="rounded-circle" style="width: 100px;">

                <h6 class="fw-bold mt-3">{{ $tahfidz->nama }}</h6>
                @if ($tahfidz->kategori == 'ANAK_PONDOK')
                    <h6>Anak Pondok</h6>
                @else
                    <h5>TPQ</h5>
                @endif
            </div>
        </div>
    </div>

    <div class="col-xl-8">

        <div class="card">
            <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Profile</button>
                    </li>
                </ul>

                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Detail Profile</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">NIS</div>
                            <div class="col-lg-9 col-md-8">: {{ $tahfidz->nis }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Nama Lengkap</div>
                            <div class="col-lg-9 col-md-8">: {{ $tahfidz->nama }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Alamat</div>
                            <div class="col-lg-9 col-md-8">: {{ $tahfidz->alamat }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Jenis Kelamin</div>
                            <div class="col-lg-9 col-md-8">:
                                {{ $tahfidz->jenis_kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Kategori</div>
                            <div class="col-lg-9 col-md-8">:
                                {{ $tahfidz->kategori == 'ANAK_PONDOK' ? 'ANAK PONDOK' : 'TPQ' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Tanggal Lahir</div>
                            <div class="col-lg-9 col-md-8">:
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $tahfidz->tgl_lahir)->format('d M Y') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Nama Ayah</div>
                            <div class="col-lg-9 col-md-8">: {{ $tahfidz->nama_ayah }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">Nama Ibu</div>
                            <div class="col-lg-9 col-md-8">: {{ $tahfidz->nama_ibu }}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label fw-semibold">No Telp</div>
                            <div class="col-lg-9 col-md-8">: {{ $tahfidz->no_telp }}</div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-danger btn-download-pdf mt-2" href="/pdf/tahfidz/{{ $tahfidz->id }}"><i
                            class="fa-solid fa-file-pdf"></i> Download PDF</a>
                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Nilai {{ $tahfidz->nama }}</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $nilai->count() }}</h6>
                                <span class="text-success small fw-bold pt-1">Kali Setor Hafalan </span> <br>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @php
                $customDays = request()->query('days', 30);
            @endphp
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Trafik Peningkatan Hafalan</h5>
                        <div class="col-md-2">
                            <div class="form-floating has-validation">
                                <input type="number" name="juz" class="form-control fw-bold" id="customDays"
                                    value="{{ $customDays }}" />
                                <label for="floatingTextarea">Selama {{ $customDays }} Hari </label>
                            </div>
                        </div>

                        <div id="lineChart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top: -25px;">
            <div class="card-body">

                <!-- Table with stripped rows -->
                <table class="datatable table-striped table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Surat</th>
                            <th scope="col">Total Ayat</th>
                            <th scope="col">Juz</th>
                            <th scope="col">Penilai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
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
                                <td>
                                    <div class="d-flex">
                                        <a href="/{{ request()->segment(1) }}/tahfidz/nilai/edit/{{ request()->segment(4) }}/{{ $row->id }}"
                                            class="btn btn-outline-info btn-sm me-2"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        @if (auth()->user()->roles == 'OPERATOR')
                                            <form
                                                action="/{{ request()->segment(1) }}/tahfidz/nilai/delete/{{ $row->id }}"
                                                method="post" style="display: inline-block;">
                                                @csrf
                                                <button type="button" class="btn btn-outline-danger btn-sm show_confirm"
                                                    data-toggle="tooltip" title='Delete'
                                                    data-konf-delete="{{ $row->nama }}"><i
                                                        class="fa-solid fa-trash"></i>
                                                    Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tanggalData = [];
            const dataTrafik = [];

            const customDays = "{{ $customDays }}";

            @foreach ($nilai as $nilai)
                @if ($nilai->updated_at >= now()->subDays($customDays))
                    tanggalData.push('{{ $nilai->updated_at->format('d M Y') }}');
                    dataTrafik.push('{{ $nilai->total_ayat }} Ayat');
                @endif
            @endforeach

            tanggalData.reverse();
            dataTrafik.reverse();

            new ApexCharts(document.querySelector("#lineChart"), {
                series: [{
                    name: "Total Ayat yang dihafalkan",
                    data: dataTrafik
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    curve: 'straight'
                },
                grid: {
                    row: {
                        colors: ['#cfe2ff', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: tanggalData
                }
            }).render();

            document.getElementById('customDays').addEventListener('change', (event) => {
                const newCustomDays = event.target.value;
                window.location.href = `?days=${newCustomDays}`;
            });
        });
    </script>
@endsection
