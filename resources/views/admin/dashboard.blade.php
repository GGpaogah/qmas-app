<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard Admin Gudang - QMAS</title>
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
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('admin.dashboard') }}">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>QMAS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link active {{ Request::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profile.edit') }}">
                            <i class="fas fa-user"></i><span>Akun</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.stok.index') }}">
                            <i class="fa-sharp fa-solid fa-warehouse"></i><span>Stok Masuk Gudang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.stok.keluar.index') }}">
                            <i class="fa-sharp fa-regular fa-warehouse-full"></i><span>Stok Keluar Gudang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.stok.create') }}">
                            <i class="fa-solid fa-inbox-in"></i><span>Tambah Data Stok Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.stok.out') }}" class="nav-link">
                        <i class="fa-solid fa-inbox-out"></i><span>Tambah Data Stok Keluar</span>
                        </a>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider" name="header"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="border rounded-circle img-profile" src="{{ asset('assets/img/avatars/avatar1.jpeg') }}">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
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
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard Admin Gudang {{ ucfirst($gudangName) ?? 'Tidak Ditemukan' }}</h3>
                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Cetak Laporan</a>
                    </div>

                    <!-- Dynamic Progress Bars for Stok Per Produk -->
                    <div class="row">
                        <!-- <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Pemasukan hari ini</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>Rp 500.000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Pemasukan minggu ini</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>Rp 5.000.000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Pemasukan Bulan ini</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>Rp 20.000.000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Pemasukan tahun ini</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>Rp 240.000.000</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-12 flex-grow-1 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Stok Produk di Gudang</h6>
                                </div>
                                <div class="card-body">
                                    @foreach($stokPerProduk as $produk => $jumlahStok)
                                        <h4 class="small fw-bold">{{ ucfirst($produk) }} <span class="float-end">{{ $jumlahStok }} unit</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar {{ $jumlahStok >= 800 ? 'bg-success' : ($jumlahStok >= 500 ? 'bg-warning' : 'bg-danger') }}" 
                                                 aria-valuenow="{{ $jumlahStok }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="1000" 
                                                 style="width: {{ ($jumlahStok / 1000) * 100 }}%;">
                                                <span class="visually-hidden">{{ $jumlahStok }}%</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

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
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
</body>
</html>
