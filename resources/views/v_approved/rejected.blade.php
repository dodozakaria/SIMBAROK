@extends('layouts.auth')
@section('title', 'menunggu persetujuan admin')
@section('content')
    <main>
        <div class="container">
            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>500</h1>
                <h2>Uppss... Kamu ditolak untuk bergabung.</h2>
                <div class="d-flex">
                  <a class="btn bg-danger me-2" href="/">Refresh</a>
                  <form action="/rejected" method="post">
                      @csrf
                      <input type="hidden" name="user" value="{{ auth()->user()->id }}">
                      <button class="btn" type="submit">Minta Persetujuan Lagi</button>
                  </form>
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
