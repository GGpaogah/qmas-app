<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Stok Keluar - QMAS</title>
    <meta name="description" content="Produk Air Siap Minum QMAS">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i&display=swap">
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

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .nav-link i {
            color: #ffffff;
            transition: color 0.3s;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
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
                        <a class="nav-link" href="{{ route('profile.userprofile') }}" :active="request()->routeIs('profile.userprofile')">
                        <i class="fas fa-user"></i><span>Akun</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.manage-users.index') }}" :active="request()->routeIs('superadmin.manage-users.index')">
                        <i class="fas fa-users"></i><span>Manajemen Akun</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/stok/index') ? 'active' : '' }}" href="{{ route('superadmin.stok.index') }}">
                            <i class="fa-sharp fa-solid fa-warehouse"></i><span>Stok Masuk Gudang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('superadmin/stok/index') ? 'active' : 'active' }}" href="{{ route('superadmin.stok.index') }}">
                            <i class="fa-sharp fa-regular fa-warehouse-full"></i><span>Stok Keluar Gudang</span>
                        </a>
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
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>

        <!-- Content Wrapper -->
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
                                    <img class="border rounded-circle img-profile" src="../assets/img/avatars/avatar1.jpeg">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="{{ route('profile.userprofile') }}">
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Akun
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid">
                    <!-- Success & Error Alerts -->
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">
                                @if (request('gudang')) Stok Keluar Gudang {{ ucfirst(request('gudang')) }}
                                @else
                                Stok Keluar
                                @endif
                            </h6>
                            <form method="GET" action="{{ route('superadmin.stok.keluar.tampil') }}">
                                <div class="d-flex">
                                    <!-- Pilih Gudang -->
                                    <select class="form-select me-2" name="gudang" id="gudang" onchange="this.form.submit()" required>
                                        <option disabled selected value="">Pilih Gudang</option>
                                        <option value="babat" {{ request('gudang') == 'babat' ? 'selected' : '' }}>Gudang Babat</option>
                                        <option value="turen" {{ request('gudang') == 'turen' ? 'selected' : '' }}>Gudang Turen</option>
                                        <option value="kalimetro" {{ request('gudang') == 'kalimetro' ? 'selected' : '' }}>Gudang Kalimetro</option>
                                        <option value="cengger" {{ request('gudang') == 'cengger' ? 'selected' : '' }}>Gudang Cengger</option>
                                        <option value="nganjuk" {{ request('gudang') == 'nganjuk' ? 'selected' : '' }}>Gudang Nganjuk</option>
                                    </select>

                                    <!-- Tipe Produk Filter -->
                                    <select class="form-select me-2" name="tipe_produk" id="tipe_produk" onchange="this.form.submit()">
                                        <option value="">Semua Produk</option>
                                        <option value="120 ml" {{ request('tipe_produk') == '120 ml' ? 'selected' : '' }}>120 ml</option>
                                        <option value="240 ml" {{ request('tipe_produk') == '240 ml' ? 'selected' : '' }}>240 ml</option>
                                        <option value="330 ml" {{ request('tipe_produk') == '330 ml' ? 'selected' : '' }}>330 ml</option>
                                        <option value="600 ml" {{ request('tipe_produk') == '600 ml' ? 'selected' : '' }}>600 ml</option>
                                        <option value="1500 ml" {{ request('tipe_produk') == '1500 ml' ? 'selected' : '' }}>1500 ml</option>
                                        <option value="Galon Refill" {{ request('tipe_produk') == 'Galon Refill' ? 'selected' : '' }}>Galon Refill</option>
                                        <option value="Galon Perdana" {{ request('tipe_produk') == 'Galon Perdana' ? 'selected' : '' }}>Galon Perdana</option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            @if($stokKeluar->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Tipe Produk</th>
                                            <th>Jumlah Penjualan</th>
                                            <th>Jumlah Mutasi</th>
                                            <th>Tujuan Mutasi</th>
                                            <th>CSR</th>
                                            <th>Promo</th>
                                            <th>Rusak</th>
                                            <th>Rusak Retur</th>
                                            <th>Jumlah Total Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stokKeluar as $stok)
                                        <tr>
                                            <td>{{ $stok->tanggal }}</td>
                                            <td>{{ $stok->tipe_produk }}</td>
                                            <td>{{ $stok->jumlah_penjualan }}</td>
                                            <td>{{ $stok->jumlah_di_mutasi }}</td>
                                            <td>{{ $stok->tujuan_gudang_mutasi }}</td>
                                            <td>{{ $stok->CSR }}</td>
                                            <td>{{ $stok->promo }}</td>
                                            <td>{{ $stok->rusak }}</td>
                                            <td>{{ $stok->rusak_retur_ke_pabrik }}</td>
                                            <td>{{ $stok->jumlah }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $stokKeluar->links() }}
                            </div>
                            @else
                            <p class="text-center">Tidak ada data yang tersedia, silakan pilih gudang terlebih dahulu.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © QMAS 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

</body>

</html>
