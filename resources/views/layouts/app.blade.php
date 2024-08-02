<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('template/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Management Tahfidz</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                {{-- @if (auth()->user()->roles === 'ADMIN') --}}
                <li class="nav-item dropdown">
                    @php
                        $forgot = \App\Models\ForgotPassword::password_reset();
                    @endphp
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span
                            class="badge bg-primary badge-number">{{ (session('showPasswordResetNotification') ? 1 : 0) + (auth()->user()->roles === 'ADMIN' ? $status_user->count() + $forgot->count() : 0) }}</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            @if ((session('showPasswordResetNotification') ? 1 : 0) + $status_user->count() + $forgot->count() == 0)
                                Tidak ada notifikasi
                            @else
                                {{ (session('showPasswordResetNotification') ? 1 : 0) + (auth()->user()->roles === 'ADMIN' ? $status_user->count() + $forgot->count() : 0) }}
                                Notifikasi baru
                            @endif
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if (auth()->user()->roles === 'ADMIN')
                            @foreach ($status_user as $st)
                                <li class="notification-item">
                                    <i class="bi bi-exclamation-circle text-warning"></i>
                                    <div>
                                        <h4>{{ $st->nama }}</h4>
                                        <p>Mengajukan sebagai {{ $st->roles }}</p>
                                        <div class="d-flex">
                                            <form action="/admin/approved" method="post">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $st->id }}">
                                                <button type="submit" class="border-0 bg-white">
                                                    <span class="badge rounded-pill bg-success ms-2 p-2"> Setuju
                                                        Bergabung
                                                    </span>
                                                </button>
                                            </form>
                                            <form action="/admin/unapproved" method="post">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $st->id }}">
                                                <button type="submit" class="border-0 bg-white">
                                                    <span class="badge rounded-pill bg-danger ms-2 p-2"> Tolak </span>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endforeach
                            @foreach ($forgot as $ft)
                                @php $users = \App\Models\User::get($ft->email); @endphp
                                <li class="notification-item">
                                    <i class="bi bi-exclamation-circle text-warning"></i>
                                    <div>
                                        <h4>{{ $users->nama }}</h4>
                                        <p>Mengajukan reset password</p>
                                        <div class="d-flex">
                                            <form action="/admin/reset/approved" method="post">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $users->id }}">
                                                <button type="submit" class="border-0 bg-white">
                                                    <span class="badge rounded-pill bg-success ms-2 p-2"> Reset Password
                                                    </span>
                                                </button>
                                            </form>
                                            <form action="/admin/reset/unapproved" method="post">
                                                @csrf
                                                <input type="hidden" name="user" value="{{ $users->id }}">
                                                <button type="submit" class="border-0 bg-white">
                                                    <span class="badge rounded-pill bg-danger ms-2 p-2"> Tolak </span>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endforeach
                        @endif
                        @if (session('showPasswordResetNotification'))
                            @php
                                $userData = session('userData');
                            @endphp
                            {{-- <div class="alert alert-warning">
                                Password Anda masih menggunakan password default.
                                <a href="{{ route('password.reset.form') }}" class="btn btn-primary">Ganti Password</a>
                            </div> --}}
                            <li class="notification-item" style="width: 300px;">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div style="flex-basis: 100%;">
                                    <h4>{{ $userData['nama'] }}</h4>
                                    <p>Ganti password default</p>
                                    <div class="d-flex mt-3 text-end">
                                        <a href="/{{ request()->segment(1) }}/profile" class="border-0 bg-white">
                                            <span class="badge rounded-pill bg-warning ms-2 p-2"> Ganti Password
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->
                {{-- @endif --}}

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">

                        {{-- profil diatas kanan pojok --}}
                        <img src="{{ asset('template/assets/img/favicon.png') }}" alt="Profile"
                            class="rounded-circle">

                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->nama }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->nama }}</h6>
                            <span>{{ auth()->user()->roles }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="/{{ request()->segment(1) }}/profile">
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="/logout" class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) ? 'collapsed' : '' }}"
                    href="/{{ request()->segment(1) }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if (auth()->user()->roles === 'ADMIN')
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="fa-solid fa-user-shield"></i><span>Akun</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>

                    <ul id="tables-nav"
                        class="nav-content {{ request()->segment(2) === 'operator' || request()->segment(2) === 'guru' ? 'collapsed' : 'collapse' }}"
                        data-bs-parent="#sidebar-nav">
                        <li class="nav-item">
                            <a class="nav-link collapsed" data-bs-toggle="modal" data-bs-target="#disablebackdrop"
                                href="#">
                                <i class="bi bi-circle"></i> Tambah data
                            </a>
                        </li>
                        <li class="{{ request()->segment(2) == 'guru' ? 'nav-link' : '' }}">
                            <a href="/{{ request()->segment(1) }}/guru">
                                <i class="bi bi-circle"></i><span>Guru</span>
                            </a>
                        </li>
                        <li class="{{ request()->segment(2) == 'operator' ? 'nav-link' : '' }}">
                            <a href="/{{ request()->segment(1) }}/operator">
                                <i class="bi bi-circle"></i><span>Operator</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Tables Nav -->
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav-2" data-bs-toggle="collapse"
                    href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Data Siswa</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>

                <ul id="tables-nav-2"
                    class="nav-content {{ request()->segment(2) === 'tahfidz' || request()->segment(2) === 'nilai' ? 'collapsed' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    <li class="{{ request()->segment(3) == '' ? 'nav-link' : '' }}">
                        <a href="/{{ request()->segment(1) }}/tahfidz">
                            <i class="bi bi-circle"></i><span>Data Tahfidz</span>
                        </a>
                    </li>
                    <li class="{{ request()->segment(3) == 'aktif' ? 'nav-link' : '' }}">
                        <a href="/{{ request()->segment(1) }}/tahfidz/aktif">
                            <i class="bi bi-circle"></i><span>Data Tahfidz Aktif</span>
                        </a>
                    </li>
                    <li class="{{ request()->segment(3) == 'lulus' ? 'nav-link' : '' }}">
                        <a href="/{{ request()->segment(1) }}/tahfidz/lulus">
                            <i class="bi bi-circle"></i><span>Data Tahfidz Lulus</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

            {{-- <li class="nav-heading">Halaman Lain</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/{{ request()->segment(1) }}/profile">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav --> --}}

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Management Tahfidz</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">{{ request()->segment(1) }}</li>
                    <li class="breadcrumb-item active">{{ request()->segment(2) }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Menampilkan pesan error -->
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')

            </div>
            <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3 needs-validation" novalidate
                                action="/{{ request()->segment(1) }}/account/add" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="yourName" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="yourName"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="yourName" class="form-label">Gelar</label>
                                    <input type="text" name="gelar"
                                        class="form-control @error('gelar') is-invalid @enderror" id="yourgelar"
                                        value="{{ old('gelar') }}">
                                    @error('gelar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" value="Mubarok2024"
                                        class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                        disabled>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Peran Akun</label>
                                    <div class="input-group has-validation">
                                        <select name="roles"
                                            class="form-select @error('roles') is-invalid @enderror"
                                            aria-label="Default select example">
                                            <option selected> --- pilih peran --- </option>
                                            <option value="OPERATOR"
                                                {{ old('roles') == 'OPERATOR' ? 'selected' : '' }}>
                                                OPERATOR</option>
                                            <option value="GURU" {{ old('roles') == 'GURU' ? 'selected' : '' }}>GURU
                                            </option>
                                            <option value="ADMIN" {{ old('roles') == 'ADMIN' ? 'selected' : '' }}>
                                                ADMIN
                                            </option>
                                        </select>
                                        @error('roles')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="yourEmail" class="form-label">Status</label>
                                    <div class="input-group has-validation">
                                        <select name="status"
                                            class="form-select @error('status') is-invalid @enderror"
                                            aria-label="Default select example">
                                            <option selected> --- pilih status --- </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                Panding</option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                Approved</option>
                                            <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>
                                                Ditolak</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/chart.js') }}/chart.umd.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

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
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var konfdelete = $(this).data("konf-delete");
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus Data?',
                html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dihapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-download-pdf').forEach(button => {
                button.addEventListener('click', function() {
                    let timerInterval;
                    Swal.fire({
                        title: "Proses download PDF",
                        html: "Tunggu beberapa detik sampai file terdownload.",
                        timer: 3800,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    })
                });
            })
        });
    </script>
</body>

</html>
