<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manajemen Akun - QMAS</title>
    <meta name="description" content="Pruduk Air Siap Minum QMAS">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.6.0/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">

    <style>
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2); /* Warna putih dengan transparansi */
            color: #4e73df; /* Warna teks biru */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
            border-radius: 0.375rem; /* Membuat sudut elemen lebih halus */
            transition: background-color 0.3s, color 0.3s; /* Animasi halus saat status berubah */
        }

        .nav-link.active i {
            color: #4e73df; /* Warna icon biru */
        }

        .nav-link {
            color: #ffffff; /* Warna teks default (tidak aktif) */
            transition: color 0.3s; /* Transisi warna teks */
        }

        .nav-link i {
            color: #ffffff; /* Warna icon default (tidak aktif) */
            transition: color 0.3s; /* Transisi warna icon */
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Warna putih semi-transparan saat hover */
            color: #ffffff; /* Pastikan warna teks tetap putih saat hover */
        }

        .nav-link:hover i {
            color: #ffffff; /* Warna icon tetap putih saat hover */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('superadmin.dashboard') }}">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
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
                            <h2 class="d-lg-flex" style="padding: 10px;width: 300px;">Manajemen Akun</h2>
                        </div>
                    </div>

                    <!-- User Management Table -->
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Akun Terdaftar</h6>
                            <a href="{{ route('superadmin.manage-users.create') }}" class="btn btn-primary">Tambah Akun</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2">
                                <table class="table my-0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Register</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>UserType</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->telepon }}</td>
                                                <td>{{ $user->alamat }}</td>
                                                <td>{{ $user->usertype }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('superadmin.manage-users.edit', $user->id) }}" class="btn btn-success">Edit</a>
                                                        <form action="{{ route('superadmin.manage-users.destroy', $user->name) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</button>
                                                        </form>                                                     
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Menampilkan {{ $users->count() }} dari {{ $users->total() }} user</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end">
                                        {{ $users->links() }} <!-- Pagination -->
                                    </nav>
                                </div>
                            </div>
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
</body>

</html>
