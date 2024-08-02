@extends('layouts.app')
@section('title', 'Guru')
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Guru</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $rows->count() }}</h6>
                                <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan </span> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Approve</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $countApp }}</h6>
                                <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan </span> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Menunggu Persetujuan</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $countPan }}</h6>
                                <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan </span> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Ditolak</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $countUn }}</h6>
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
                    <a class="btn btn-sm btn-danger btn-download-pdf" href="/pdf/guru/">
                        <i class="fa-solid fa-file-pdf"></i> Download PDF
                    </a>
                </div>

                <!-- Table with stripped rows -->
                <table class="datatable table-striped table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gelar</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Peran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $i => $row)
                            <tr>
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>{{ $row->nip }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->gelar ?? '-' }}</td>
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
                                <td>
                                    <div class="d-flex gap-3">
                                        {{-- <a href="/{{ request()->segment(1) }}/guru/edit/{{ $row->id }}"
                                            class="btn btn-outline-info btn-sm me-2"><i
                                                class="fa-solid fa-pen-to-square"></i> Ubah Status</a> --}}

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-pen-to-square"></i> Ubah Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach (['approvel' => 1, 'menunggu' => 0, 'ditolak' => 2] as $status => $value)
                                                    <li class="px-2">
                                                        <form action="{{ route('updateStatus', ['id' => $row->id]) }}"
                                                            method="POST" class="dropdown-item p-0">
                                                            @csrf
                                                            <button type="submit" name="status"
                                                                value="{{ $value }}"
                                                                class="btn btn-light text-start w-100">
                                                                {{ ucfirst($status) }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <form action="/{{ request()->segment(1) }}/account/delete/{{ $row->id }}"
                                            method="post" style="display: inline-block;">
                                            @csrf
                                            <button type="button" class="btn btn-outline-danger btn-sm show_confirm"
                                                data-toggle="tooltip" title='Delete'
                                                data-konf-delete="{{ $row->nama }}"><i class="fa-solid fa-trash"></i>
                                                Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
