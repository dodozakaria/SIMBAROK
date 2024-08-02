@extends('layouts.app')
@section('title', 'Tahfidz')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit {{ $edit->nama }}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3 needs-validation" novalidate method="post"
                action="/{{ request()->segment(1) }}/tahfidz/update/{{ $edit->id }}">
                @csrf
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                            id="floatingnis" placeholder="Nomor Induk Sekolah" value="{{ $edit->nis ?? '-' }}" disabled>
                        <label for="floatingnis">NIS</label>
                    </div>
                    @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="floatingName" placeholder="Nama Lengkap" value="{{ $edit->nama }}">
                        <label for="floatingName">Nama Lengkap</label>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="form-floating has-validation">
                        <textarea required name="alamat" class="form-control  @error('alamat') is-invalid @enderror" placeholder="Alamat"
                            id="floatingTextarea" style="height: 100px;">{{ $edit->alamat }}</textarea>
                        <label for="floatingTextarea">Alamat</label>
                    </div>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation mb-3">
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror"
                            id="floatingSelect" aria-label="State">
                            <option selected> --- pilih jenis kelamin --- </option>
                            <option value="L" {{ $edit->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                Laki-Laki</option>
                            <option value="P" {{ $edit->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="floatingSelect">Jenis Kelamin</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation mb-3">
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror"
                            aria-label="Default select example">
                            <option selected> --- pilih kategori --- </option>
                            <option value="ANAK_PONDOK" {{ $edit->kategori == 'ANAK_PONDOK' ? 'selected' : '' }}>
                                Anak Pondok</option>
                            <option value="TPQ" {{ $edit->kategori == 'TPQ' ? 'selected' : '' }}>TPQ
                            </option>
                        </select>
                        <label for="floatingSelect">Kategori</label>
                    </div>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation mb-3">
                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                            aria-label="Default select example">
                            <option selected> --- pilih status --- </option>
                            <option value="Aktif" {{ $edit->status == 'Aktif' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="Lulus" {{ $edit->status == 'Lulus' ? 'selected' : '' }}>Lulus
                            </option>
                        </select>
                        <label for="floatingSelect">status</label>
                    </div>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" name="tanggal_lahir"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror" id="floatingName"
                            placeholder="Tanggal Lahir" value="{{ $edit->tgl_lahir }}">
                        <label for="floatingName">Tanggal Lahir</label>
                    </div>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror"
                            id="floatingnama_ayah" placeholder="Nama Ayah" value="{{ $edit->nama_ayah }}">
                        <label for="floatingnama_ayah">Nama Ayah</label>
                    </div>
                    @error('nama_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror"
                            id="floatingnama_ibu" placeholder="Nama Ibu" value="{{ $edit->nama_ibu }}">
                        <label for="floatingnama_ibu">Nama Ibu</label>
                    </div>
                    @error('nama_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-end">
                    <a href="/{{ request()->segment(1) }}/{{ request()->segment(2) }}"
                        class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
