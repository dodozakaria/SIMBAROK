@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="{{ asset('template/assets/img/logo_3.png') }}" alt="">
                            <span class="d-none d-lg-block">Tahfidz Qur'an</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pb-2 pt-4">
                                <h5 class="card-title fs-5 pb-0 text-center">Selamat Datang di Management Tahfidz Qur'an
                                </h5>
                            </div>
                            @if (Session::has('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('status') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger bg-danger text-light alert-dismissible fade show border-0"
                                    role="alert">
                                    {{ $errors->first() }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form class="row g-3 needs-validation" novalidate action="/reset-password" method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ request()->token }}">
                                <input type="hidden" name="email" value="{{ request()->email }}">
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password Baru</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                        required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="yourPasswordConf" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="yourPasswordConf" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
