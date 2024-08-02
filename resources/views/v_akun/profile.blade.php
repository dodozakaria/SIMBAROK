@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Profil {{ $edit->nama }}</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3 needs-validation" novalidate method="post"
                action="/{{ request()->segment(1) }}/profile/update/{{ $edit->id }}">
                @csrf
                @if (auth()->user()->roles === 'GURU')
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                id="floatinggelar" placeholder="nip" value="{{ $edit->nip ?? '-' }}" disabled>
                            <label for="floatinggelar">NIP</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                    @else
                        <div class="col-md-12">
                @endif

                <div class="form-floating">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="floatingName" placeholder="Nama Lengkap" value="{{ $edit->nama }}">
                    <label for="floatingName">Nama Lengkap</label>
                </div>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
        @if (auth()->user()->roles === 'GURU')
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" name="gelar" class="form-control @error('gelar') is-invalid @enderror"
                        id="floatinggelar" placeholder="Gelar" value="{{ $edit->gelar }}">
                    <label for="floatinggelar">Gelar</label>
                </div>
            </div>
        @endif
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
                {{-- <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="floatingPassword">
                        <label for="floatingPassword">Password</label> --}}
                <input type="text" name="roles" class="form-control @error('password') is-invalid @enderror"
                    value="{{ $edit->roles == 'OPERATOR' ? 'OPERATOR' : ($edit->roles == 'GURU' ? 'GURU' : 'ADMIN') }}"
                    id="floatingPassword" disabled>
                <label for="floatingPassword">Role</label>
            </div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6" hidden>
            <div class="form-floating">
                <input type="text" name="status"
                    value="{{ $edit->status == '0' ? 'Panding' : ($edit->status == '1' ? 'Approved' : 'Ditolak') }}"
                    class="form-control @error('status') is-invalid @enderror" id="floatingstatus" readonly>
                <label for="floatingstatus">Status</label>
            </div>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="col-md-6" hidden>
                    <div class="form-floating">
                        <input type="text" name="roles"
                            value="{{ $edit->roles == 'OPERATOR' ? 'OPERATOR' : ($edit->roles == 'GURU' ? 'GURU' : 'ADMIN') }}"
                            class="form-control @error('roles') is-invalid @enderror" id="floatingroles" readonly>
                        <label for="floatingroles">roles</label>
                    </div>
                    @error('roles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
    </div>
    </div>
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Ubah Sandi</h5>
            <form action="{{ route('ubahSandi', $edit->id) }}" method="POST" id="ubahPassword" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="password" name="current_password" class="form-control" id="floatinCurrentgPassword"
                            required>
                        <label for="floatingCurrentPassword">Password Lama</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" name="new_password" class="form-control" id="floatingNewPassword" required>
                        <label for="floatingNewPassword">Password Baru</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" name="new_password_confirmation" class="form-control"
                            id="floatingConfirmPassword" required>
                        <label for="floatingConfirmPassword">Konfirmasi Password Baru</label>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>

@endsection
