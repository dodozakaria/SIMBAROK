@extends('layouts.app')
@section('title', 'Operator')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit {{ $edit->nama }}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3 needs-validation" novalidate method="post" action="/{{ request()->segment(1) }}/operator/update/{{ $edit->id }}">
                @csrf
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="floatingName" placeholder="Nama Lengkap" value="{{ $edit->nama }}">
                        <label for="floatingName">Nama Lengkap</label>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="floatingEmail" placeholder="Email" value="{{ $edit->email }}">
                        <label for="floatingEmail">Email</label>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="floatingPassword">
                        <label for="floatingPassword">Password</label>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-floating has-validation mb-3">
                        <select name="status" class="form-select @error('status') is-invalid @enderror" id="floatingSelect"
                            aria-label="State">
                            <option selected> --- pilih status --- </option>
                            <option value="0" {{ $edit->status == '0' ? 'selected' : '' }}>
                                Panding</option>
                            <option value="1" {{ $edit->status == '1' ? 'selected' : '' }}>
                                Approved</option>
                            <option value="2" {{ $edit->status == '2' ? 'selected' : '' }}>
                                Ditolak</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="floatingSelect">Status</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating has-validation mb-3">
                        <select name="roles" class="form-select @error('roles') is-invalid @enderror"
                            aria-label="Default select example">
                            <option selected> --- pilih peran --- </option>
                            <option value="OPERATOR" {{ $edit->roles == 'OPERATOR' ? 'selected' : '' }}>
                                OPERATOR</option>
                            <option value="GURU" {{ $edit->roles == 'GURU' ? 'selected' : '' }}>GURU
                            </option>
                            <option value="ADMIN" {{ $edit->roles == 'ADMIN' ? 'selected' : '' }}>
                                ADMIN
                            </option>
                        </select>
                        <label for="floatingSelect">Peran</label>
                    </div>
                    @error('roles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="/{{request()->segment(1)}}/{{request()->segment(2)}}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
