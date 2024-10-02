<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tambah Akun - QMAS</title>
    <meta name="description" content="Pruduk Air Siap Minum QMAS">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.6.0/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">

    <style>
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #4e73df;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0.375rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link.active i {
            color: #4e73df;
        }

        .nav-link {
            color: #ffffff;
            transition: color 0.3s;
        }

        .nav-link i {
            color: #ffffff;
            transition: color 0.3s;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .nav-link:hover i {
            color: #ffffff;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('superadmin.dashboard') }}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3"><span>QMAS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/dashboard') ? 'active' : '' }}" href="{{ route('superadmin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile.userprofile') }}">
                            <i class="fas fa-user"></i><span>Akun</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/manage-users*') ? 'active' : '' }}" href="{{ route('superadmin.manage-users.index') }}">
                            <i class="fas fa-users"></i><span>Manajemen Akun</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.stok.index') }}">
                        <i class="fa-sharp fa-solid fa-warehouse"></i><span>Stok Masuk Gudang</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.stok.keluar.index') }}">
                        <i class="fa-sharp fa-regular fa-warehouse-full"></i><span>Stok Keluar Gudang</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.stok.create') }}" :active="request()->routeIs('superadmin.stok.create')">
                        <i class="fa-solid fa-inbox-in"></i><span>Tambah Data Stok Masuk</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.stok.create') }}" :active="request()->routeIs('superadmin.stok.create')">
                        <i class="fa-solid fa-inbox-out"></i><span>Tambah Data Stok Keluar</span></a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                        <div class="d-none d-sm-block topbar-divider" name="header"></div>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->name }}</span>
                                        <img class="border rounded-circle img-profile" src="{{ asset('assets/img/avatars/avatar1.jpeg') }}">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="{{ route('profile.userprofile') }}">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Akun
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row d-xl-flex justify-content-xl-start">
                        <div class="col-lg-4 d-lg-flex flex-fill justify-content-xl-start align-items-xl-center">
                            <h2 class="d-lg-flex" style="padding: 10px;width: 300px;">Tambah Akun Baru</h2>
                        </div>
                    </div>

                    <!-- Add User Form -->
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Form Menambahkan Akun</h6>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('superadmin.manage-users.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="usertype" class="form-label">Role</label>
                                    <select class="form-control" id="usertype" name="usertype" required>
                                        <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ old('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="superadmin" {{ old('usertype') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="gudang-group">
                                    <label for="gudang" class="form-label">Gudang</label>
                                    <select class="form-control" id="gudang" name="gudang">
                                        <option value="babat" {{ old('gudang') == 'babat' ? 'selected' : '' }}>Babat</option>
                                        <option value="cengger" {{ old('gudang') == 'cengger' ? 'selected' : '' }}>Cengger Ayam</option>
                                        <option value="kalimetro" {{ old('gudang') == 'kalimetro' ? 'selected' : '' }}>Kalimetro</option>
                                        <option value="nganjuk" {{ old('gudang') == 'nganjuk' ? 'selected' : '' }}>Nganjuk</option>
                                        <option value="turen" {{ old('gudang') == 'turen' ? 'selected' : '' }}>Turen</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah Akun</button>
                                <a href="{{ route('superadmin.manage-users.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © QMAS 2024</span></div>
                </div>
            </footer>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    <script>
    // Fungsi untuk mengatur tampilan gudang berdasarkan role
    function toggleGudangField() {
        var usertype = document.getElementById('usertype').value;
        var gudangGroup = document.getElementById('gudang-group');
        
        // Jika usertype adalah 'admin', tampilkan field gudang, jika tidak, sembunyikan
        if (usertype === 'admin') {
            gudangGroup.style.display = 'block';
        } else {
            gudangGroup.style.display = 'none';
        }
    }

    // Jalankan saat halaman dimuat, dan setiap kali usertype diubah
    document.getElementById('usertype').addEventListener('change', toggleGudangField);

    // Inisialisasi saat halaman pertama kali dibuka
    window.onload = function() {
        toggleGudangField(); // Untuk menampilkan/menyembunyikan gudang saat halaman dimuat
    };
</script>
</body>

</html>
