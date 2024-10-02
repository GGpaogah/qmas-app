<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Input Data Stok Masuk - QMAS</title>
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
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('admin.dashboard') }}">
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
                        <a class="nav-link active" href="{{ route('admin.stok.create') }}">
                            <i class="fa-solid fa-inbox-in"></i><span>Tambah Data Stok Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.stok.out') }}">
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
                        <h3 class="text-dark mb-0">Tambah Data Stok Masuk</h3>
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
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="col-lg-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Input Stok Masuk Gudang {{ ucfirst($gudang) ?? 'Tidak Ditemukan' }}</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.stok.masuk.store') }}">
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

                                    <!-- Jumlah dari Pabrik -->
                                    <div class="form-group row mt-3">
                                        <label for="jumlah_dari_pabrik" class="col-sm-2 col-form-label">Jumlah dari Pabrik</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="jumlah_dari_pabrik" name="jumlah_dari_pabrik" placeholder="Jumlah dari Pabrik" required>
                                        </div>
                                    </div>

                                    <!-- Jumlah dari Mutasi -->
                                    <div class="form-group row mt-3">
                                        <label for="jumlah_dari_mutasi" class="col-sm-2 col-form-label">Jumlah dari Mutasi</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="jumlah_dari_mutasi" name="jumlah_dari_mutasi" placeholder="Jumlah dari Mutasi" required>
                                        </div>
                                    </div>

                                    <!-- Asal Gudang Mutasi -->
                                    <div class="form-group row mt-3">
                                        <label for="nama_gudang_mutasi" class="col-sm-2 col-form-label">Gudang Mutasi</label>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="nama_gudang_mutasi" name="nama_gudang_mutasi" required>
                                                <option disabled selected value=" ">Pilih Asal Gudang</option>
                                                <option value="Gudang Babat">Gudang Babat</option>
                                                <option value="Gudang Turen">Gudang Turen</option>
                                                <option value="Gudang Kalimetro">Gudang Kalimetro</option>
                                                <option value="Gudang Cengger">Gudang Cengger</option>
                                                <option value="Gudang Nganjuk">Gudang Nganjuk</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Retur Konsumen -->
                                    <div class="form-group row mt-3">
                                        <label for="retur_konsumen" class="col-sm-2 col-form-label">Retur Konsumen</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="retur_konsumen" name="retur_konsumen" placeholder="Retur Konsumen">
                                        </div>
                                    </div>

                                    <!-- Repack -->
                                    <div class="form-group row mt-3">
                                        <label for="barang_repack" class="col-sm-2 col-form-label">Repack</label>
                                        <div class="col-sm-3">
                                            <input type="text" inputmode="numeric" class="form-control" id="barang_repack" name="barang_repack" placeholder="Barang Repack">
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
    }, 3000); // 3000 milliseconds = 3 seconds

    // Update Asal Gudang Mutasi dropdown based on the currently logged-in Gudang
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil nilai gudang yang sedang login dari server-side (PHP Laravel)
        const gudangSelect = "{{ str(Auth::user()->gudang) }}";
        const asalGudangSelect = document.getElementById('nama_gudang_mutasi');

        function updateAsalGudangOptions() {
            // Reset options in asal_gudang
            asalGudangSelect.innerHTML = `
                <option disabled selected value=" ">Pilih Asal Gudang</option>
                <option value="babat">Gudang Babat</option>
                <option value="turen">Gudang Turen</option>
                <option value="kalimetro">Gudang Kalimetro</option>
                <option value="cengger">Gudang Cengger</option>
                <option value="nganjuk">Gudang Nganjuk</option>
            `;

            // Hapus opsi gudang yang sesuai dengan gudang yang login
            Array.from(asalGudangSelect.options).forEach(option => {
                if (option.value.toLowerCase() === gudangSelect) {
                    option.remove();
                }
            });
        }

        // Jalankan fungsi saat halaman dimuat
        updateAsalGudangOptions();
    });
    </script>
    </div>
</body>

</html>
