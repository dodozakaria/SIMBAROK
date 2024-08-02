@extends('layouts.auth')
@section('title', 'Register')
@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('template/assets/img/logo_3.png') }}" alt="">
                            <span class="d-none d-lg-block">Simbarok</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pb-2 pt-4">
                                <h5 class="card-title fs-5 pb-0 text-center">Selamat Datang di Management Tahfidz Qur'an Al Mubarok
                                </h5>
                            </div>

                            <form class="row g-3 needs-validation" novalidate action="/register" method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="yourName" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="yourName"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="yourEmail"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Peran Akun</label>
                                    <div class="input-group has-validation">
                                        <select name="roles" class="form-select @error('roles') is-invalid @enderror"
                                            aria-label="Default select example">
                                            <option selected> --- pilih peran --- </option>
                                            <option value="OPERATOR" {{ old('roles') == 'OPERATOR' ? 'selected' : '' }}>
                                                OPERATOR</option>
                                            <option value="GURU" {{ old('roles') == 'GURU' ? 'selected' : '' }}>GURU
                                            </option>
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                        required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="yourPasswordConf" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password"
                                        class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                        id="yourPasswordConf" required>
                                    @error('konfirmasi_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Sudah Punya Akun ? <a href="/">Log in</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
