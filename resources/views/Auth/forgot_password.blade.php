@extends('layouts.auth')
@section('title', 'Lupa Password')
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
                                <h5 class="card-title fs-6 pb-0 text-center">Pastikan email anda aktif dan cek email secara
                                    berkala.
                                </h5>
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('error') }}
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

                            <form class="row g-3 needs-validation" novalidate action="/forgot_password" method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email') }}" id="yourEmail" required>
                                        <div class="invalid-feedback">Masukan email lebih dahulu !</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Kirim Link Reset Password</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Belum Punya Akun ? <a href="/register">Daftar Akun</a>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
