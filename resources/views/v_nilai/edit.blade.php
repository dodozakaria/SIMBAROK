@extends('layouts.app')
@section('title', 'Nilai')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit nilai {{ $tahfidz->nama }}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3 needs-validation" novalidate method="post"
                action="/{{ request()->segment(1) }}/tahfidz/nilai/update/{{ $nilai->id }}">
                @csrf
                <input type="hidden" name="nama_tahfidz" value="{{ $tahfidz->id }}">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="floatingName" placeholder="Nama Lengkap" value="{{ $tahfidz->nama }}" disabled>
                        <label for="floatingName">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation">
                        <input type="text" required name="nama_surat"
                            class="form-control @error('nama_surat') is-invalid @enderror" value="{{ $nilai->nama_surat }}"
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
                            class="form-control @error('total_ayat') is-invalid @enderror" value="{{ $nilai->total_ayat }}"
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
                            class="form-control @error('juz') is-invalid @enderror" value="{{ $nilai->juz }}"
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
                            <option value="0" {{ $nilai->status == '0' ? 'selected' : '' }}>
                                Lulus</option>
                            <option value="1" {{ $nilai->status == '1' ? 'selected' : '' }}>
                                Tidak Lulus</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="floatingSelect">Status Hafalan</label>
                    </div>
                </div>

                <div class="text-end">
                    <a href="/{{ request()->segment(1) }}/{{ request()->segment(2) }}/"
                        class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
