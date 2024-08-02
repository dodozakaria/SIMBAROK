@extends('layouts.app')
@section('title', 'Nilai')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Berikan penilaian ke{{ $tahfidz->nama }}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3 needs-validation" novalidate method="post"
                action="/{{ request()->segment(1) }}/tahfidz/nilai/add">
                @csrf
                <input type="hidden" name="nama_tahfidz" value="{{ $tahfidz->id }}">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName"
                            placeholder="Nama Lengkap" value="{{ $tahfidz->nama }}" disabled>
                        <label for="floatingName">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation">
                        <input type="text" required name="nama_surat"
                            class="form-control @error('nama_surat') is-invalid @enderror" value="{{ old('nama_surat') }}"
                            placeholder="nama_surat" id="floatingTextarea" />
                        <label for="floatingTextarea">Nama Surat</label>
                    </div>
                    @error('nama_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation">
                        <input type="number" required name="total_ayat"
                            class="form-control @error('total_ayat') is-invalid @enderror" value="{{ old('total_ayat') }}"
                            placeholder="total_ayat" id="floatingTextarea" />
                        <label for="floatingTextarea">Total Ayat</label>
                    </div>
                    @error('total_ayat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-floating has-validation">
                        <input type="number" required name="juz"
                            class="form-control @error('juz') is-invalid @enderror" value="{{ old('juz') }}"
                            placeholder="juz" id="floatingTextarea" />
                        <label for="floatingTextarea">Juz</label>
                    </div>
                    @error('juz')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-floating has-validation mb-3">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" id="floatingSelect"
                            aria-label="State">
                            <option selected> --- pilih status --- </option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                Lulus</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                Tidak Lulus</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="floatingSelect">Status Hafalan</label>
                    </div>
                </div>

                <div class="text-end">
                    <a href="/{{ request()->segment(1) }}/{{ request()->segment(2) }}"
                        class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
                            <th scope="col">Tanggal</th>
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
                                <td>{{ $row->created_at->format('d M Y') }}</td>

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
            let totalAyat = 0;

            @foreach ($nilai as $nilai)
                @if ($nilai->updated_at >= now()->subDays($customDays))
                    tanggalData.push('{{ $nilai->updated_at->format('d M Y') }}');
                    totalAyat += {{ $nilai->total_ayat }};
                    dataTrafik.push(totalAyat);
                @endif
            @endforeach

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
