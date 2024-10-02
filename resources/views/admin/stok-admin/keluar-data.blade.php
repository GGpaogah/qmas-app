<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Input Data Stok Keluar - QMAS</title>
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
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
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
                        <a class="nav-link active" href="{{ route('admin.stok.out') }}">
                            <i class="fa-solid fa-inbox-out"></i><span>Tambah Data Stok Keluar</span>
                        </a>
                    </li>
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
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="border rounded-circle img-profile" src="../assets/img/avatars/avatar1.jpeg">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Akun</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;{{ __('Logout') }}</a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Tambah Data Stok Keluar</h3>
                    </div>
                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Validation Errors Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    @if ($error != 'Stok tidak mencukupi untuk transaksi ini.') <!-- Opsi untuk menghindari duplikasi -->
                                        <li>{{ $error }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Input Stok Keluar Gudang {{ ucfirst($gudang) ?? 'Tidak Ditemukan' }}</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.stok.keluar.store') }}">
                                    @csrf
                                    <!-- Tipe Produk -->
                                    <div class="form-group row mt-3">
                                        <label for="tipe_produk" class="col-sm-2 col-form-label">Tipe Produk</label>
                                        <div class="col-sm-3">
                                            <select class="form-select" name="tipe_produk" required>
                                                <option disabled selected value="">Pilih Tipe Produk</option>
                                                <option value="120 ml">120 ml</option>
                                                <option value="240 ml">240 ml</option>
                                                <option value="330 ml">330 ml</option>
                                                <option value="600 ml">600 ml</option>
                                                <option value="1500 ml">1500 ml</option>
                                                <option value="Galon Refill">Galon Refill</option>
                                                <option value="Galon Perdana">Galon Perdana</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Jumlah Penjualan -->
                                    <div class="form-group row mt-3">
                                        <label for="jumlah_penjualan" class="col-sm-2 col-form-label">Jumlah Penjualan</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" placeholder="Jumlah Penjualan" required>
                                        </div>
                                    </div>

                                    <!-- Jumlah dari Mutasi -->
                                    <div class="form-group row mt-3">
                                        <label for="jumlah_di_mutasi" class="col-sm-2 col-form-label">Jumlah Dimutasi</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="jumlah_di_mutasi" name="jumlah_di_mutasi" placeholder="Jumlah Di Mutasi" required>
                                        </div>
                                    </div>

                                    <!-- Asal Gudang Mutasi -->
                                    <div class="form-group row mt-3">
                                        <label for="tujuan_gudang_mutasi" class="col-sm-2 col-form-label">Tujuan Gudang Mutasi</label>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="tujuan_gudang_mutasi" name="tujuan_gudang_mutasi" required>
                                                <option disabled selected value="">Pilih Gudang Tujuan</option>
                                                <option value="babat">Gudang Babat</option>
                                                <option value="turen">Gudang Turen</option>
                                                <option value="kalimetro">Gudang Kalimetro</option>
                                                <option value="cengger">Gudang Cengger</option>
                                                <option value="nganjuk">Gudang Nganjuk</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- CSR -->
                                    <div class="form-group row mt-3">
                                        <label for="csr" class="col-sm-2 col-form-label">CSR</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="csr" name="CSR" placeholder="CSR" required>
                                        </div>
                                    </div>

                                    <!-- Promo -->
                                    <div class="form-group row mt-3">
                                        <label for="promo" class="col-sm-2 col-form-label">Promo</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="promo" name="promo" placeholder="Promo" required>
                                        </div>
                                    </div>

                                    <!-- Rusak -->
                                    <div class="form-group row mt-3">
                                        <label for="rusak" class="col-sm-2 col-form-label">Rusak</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="rusak" name="rusak" placeholder="Rusak" required>
                                        </div>
                                    </div>

                                    <!-- Rusak Retur Ke Pabrik -->
                                    <div class="form-group row mt-3">
                                        <label for="rusak_retur_ke_pabrik" class="col-sm-2 col-form-label">Rusak Retur Ke Pabrik</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="rusak_retur_ke_pabrik" name="rusak_retur_ke_pabrik" placeholder="Rusak Retur Ke Pabrik" required>
                                        </div>
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="form-group row mt-3">
                                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group row mt-3">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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

    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script>
        // JavaScript to hide alert after 3 seconds
        setTimeout(function () {
            var alertElement = document.querySelector('.alert');
            if (alertElement) {
                var alert = new bootstrap.Alert(alertElement);
                alert.close();
            }
        }, 10000); // 10000 milliseconds = 10 seconds
    </script>
</body>

</html>
