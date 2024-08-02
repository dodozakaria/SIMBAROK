@extends('layouts.auth')
@section('title', 'Login')
@section('content')

{{-- sesuaikan besarnya disini --}}
<style>
    .sizeLogo {
        width: 50px;
        margin-right: 6px;
    }
</style>
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a  class="logo d-flex align-items-center w-auto">


                            {{-- logo anda --}}
                            <img src="{{ asset('template/assets/img/logo_3.png') }}" class="sizeLogo" alt="">


                            <span class="d-none d-lg-block">Simbarok</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pb-2 pt-4">
                                <h5 class="card-title fs-5 pb-0 text-center">Selamat Datang di Management Tahfidz Qur'an Al Mubarok
                                </h5>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger bg-danger text-light alert-dismissible fade show border-0"
                                    role="alert">
                                    {{ $errors->first() }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (Session::has('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('status') }}
                                </div>
                            @endif
                            

                            <form class="row g-3 needs-validation" novalidate action="/login" method="post">
                                @csrf
                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Masukan email lebih dahulu !</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">Masukan Password lebih dahulu!</div>
                                </div>

                                <div class="col-12">
                                    <p class="small mb-0">Lupa Password ? <a href="/forgot_password">Pulihkan akun</a></p>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
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
