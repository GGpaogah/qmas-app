<!-- resources/views/superadmin/stok/edit.blade.php -->

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Stok Masuk - QMAS</title>
    <meta name="description" content="Produk Air Siap Minum QMAS">
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
                        <a class="nav-link {{ Request::is('profile/userprofile') ? 'active' : '' }}" href="{{ route('profile.userprofile') }}">
                            <i class="fas fa-user"></i><span>Akun</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/manage-users*') ? 'active' : '' }}" href="{{ route('superadmin.manage-users.index') }}">
                            <i class="fas fa-users"></i><span>Manajemen Akun</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/stok/index') ? 'active' : 'active' }}" href="{{ route('superadmin.stok.index') }}">
                            <i class="fa-sharp fa-solid fa-warehouse"></i><span>Stok Masuk Gudang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.stok.keluar.index') }}">
                        <i class="fa-sharp fa-regular fa-warehouse-full"></i><span>Stok Keluar Gudang</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/stok/create') ? 'active' : '' }}" href="{{ route('superadmin.stok.create') }}">
                            <i class="fa-solid fa-inbox-in"></i><span>Tambah Data Stok Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/stok/out') ? 'active' : '' }}" href="{{ route('superadmin.stok.out') }}">
                            <i class="fa-solid fa-inbox-out"></i><span>Tambah Data Stok Keluar</span>
                        </a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <ul class="navbar-nav flex-nowrap ms-auto">
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
                            <h2 class="d-lg-flex" style="padding: 10px;width: 300px;">Edit Stok Masuk</h2>
                        </div>
                    </div>

                    <!-- Edit Stok Form -->
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Form Edit Stok Masuk</h6>
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

                            <form method="POST" action="{{ route('superadmin.stok.update', ['gudang' => $gudang, 'id' => $stok->id]) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="_method" value="PUT">

                                <!-- Tipe Produk -->
                                <div class="mb-3">
                                    <label for="tipe_produk" class="form-label">Tipe Produk</label>
                                    <select class="form-select" id="tipe_produk" name="tipe_produk" required>
                                        <option value="" disabled selected>Pilih Tipe Produk</option>
                                        <option value="120 ml" {{ $stok->tipe_produk == '120 ml' ? 'selected' : '' }}>120 ml</option>
                                        <option value="240 ml" {{ $stok->tipe_produk == '240 ml' ? 'selected' : '' }}>240 ml</option>
                                        <option value="330 ml" {{ $stok->tipe_produk == '330 ml' ? 'selected' : '' }}>330 ml</option>
                                        <option value="600 ml" {{ $stok->tipe_produk == '600 ml' ? 'selected' : '' }}>600 ml</option>
                                        <option value="1500 ml" {{ $stok->tipe_produk == '1500 ml' ? 'selected' : '' }}>1500 ml</option>
                                        <option value="Galon Refill" {{ $stok->tipe_produk == 'Galon Refill' ? 'selected' : '' }}>Galon Refill</option>
                                        <option value="Galon Perdana" {{ $stok->tipe_produk == 'Galon Perdana' ? 'selected' : '' }}>Galon Perdana</option>
                                    </select>
                                </div>

                                <!-- Jumlah dari Pabrik -->
                                <div class="mb-3">
                                    <label for="jumlah_dari_pabrik" class="form-label">Jumlah dari Pabrik</label>
                                    <input type="number" class="form-control" id="jumlah_dari_pabrik" name="jumlah_dari_pabrik" value="{{ $stok->jumlah_dari_pabrik }}" required>
                                </div>

                                <!-- Jumlah dari Mutasi -->
                                <div class="mb-3">
                                    <label for="jumlah_dari_mutasi" class="form-label">Jumlah dari Mutasi</label>
                                    <input type="number" class="form-control" id="jumlah_dari_mutasi" name="jumlah_dari_mutasi" value="{{ $stok->jumlah_dari_mutasi }}" required>
                                </div>

                                <!-- Asal Gudang Mutasi -->
                                <div class="mb-3">
                                    <label for="nama_gudang_mutasi" class="form-label">Asal Gudang Mutasi</label>
                                    <select class="form-select" id="nama_gudang_mutasi" name="nama_gudang_mutasi" required>
                                        <option value="Gudang Babat" {{ $stok->nama_gudang_mutasi == 'Gudang Babat' ? 'selected' : '' }}>Gudang Babat</option>
                                        <option value="Gudang Turen" {{ $stok->nama_gudang_mutasi == 'Gudang Turen' ? 'selected' : '' }}>Gudang Turen</option>
                                        <option value="Gudang Kalimetro" {{ $stok->nama_gudang_mutasi == 'Gudang Kalimetro' ? 'selected' : '' }}>Gudang Kalimetro</option>
                                        <option value="Gudang Cengger" {{ $stok->nama_gudang_mutasi == 'Gudang Cengger' ? 'selected' : '' }}>Gudang Cengger</option>
                                        <option value="Gudang Nganjuk" {{ $stok->nama_gudang_mutasi == 'Gudang Nganjuk' ? 'selected' : '' }}>Gudang Nganjuk</option>
                                    </select>
                                </div>

                                <!-- Retur Konsumen -->
                                <div class="mb-3">
                                    <label for="retur_konsumen" class="form-label">Retur Konsumen</label>
                                    <input type="number" class="form-control" id="retur_konsumen" name="retur_konsumen" value="{{ $stok->retur_konsumen }}" required>
                                </div>

                                <!-- Barang Repack -->
                                <div class="mb-3">
                                    <label for="barang_repack" class="form-label">Barang Repack</label>
                                    <input type="number" class="form-control" id="barang_repack" name="barang_repack" value="{{ $stok->barang_repack }}" required>
                                </div>

                               <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                                <a href="{{ route('superadmin.stok.tampil', ['gudang' => $gudang]) }}" class="btn btn-secondary mt-3">Kembali</a>
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
</body>

</html>
