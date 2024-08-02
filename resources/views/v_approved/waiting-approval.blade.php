@extends('layouts.auth')
@section('title', 'menunggu persetujuan admin')
@section('content')
<main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>300</h1>
        <h2>Menunggu persetujuan oleh admin</h2>
        <div class="">
            <a class="btn bg-danger me-2" href="/">Refresh</a>
            <a class="btn" href="/logout">Login Akun Lain</a>
        </div>
      </section>
    </div>
  </main>
  @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('success') }}",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection