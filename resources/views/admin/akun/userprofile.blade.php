<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - QMAS</title>
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
        input{
            padding-right: 25%;
            
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>QMAS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin.profile.edit') ? 'active' : '' }} active" href="{{ route('admin.profile.edit') }}"><i class="fas fa-user"></i><span>Akun</span></a>
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
                                    <img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg">
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}" :active="request()->routeIs('admin.profile.edit')">
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Akun
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;{{ __('Logout') }}
                                    </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Profile Update Form -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.profile.update') }}">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-3">
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                            <div>
                                                <p class="text-sm mt-2 text-gray-800">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                                </p>
                                                    @if (session('status') === 'verification-link-sent')
                                                         <p class="mt-2 font-medium text-sm text-green-600">
                                                         {{ __('A new verification link has been sent to your email address.') }}
                                                         </p>
                                                     @endif
                                             </div>
                                        @endif
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Password Update Form -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Update Password</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.profile.password.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                                            <div class="col-sm-2">
                                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                                @error('current_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-2">
                                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                                @error('new_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="new_password_confirmation" class="col-sm-2 col-form-label">Confirm New Password</label>
                                            <div class="col-sm-2">
                                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                                @error('new_password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Update Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Account Form -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Delete Account</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.profile.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-2">
                                                <input type="password" class="form-control" id="password" name="password" required>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-danger">Delete Account</button>
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
                            <span>QMAS &copy; Your Website 2024</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
</body>

</html>
