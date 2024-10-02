<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\GudangMasukController;
use App\Http\Controllers\SuperAdmin\GudangKeluarController;
use App\Http\Controllers\SuperAdmin\ManageUserController;
use App\Http\Controllers\SuperAdmin\TampilGudangMasukController;
use App\Http\Controllers\SuperAdmin\TampilGudangKeluarController;
use App\Http\Controllers\Admin\AdminGudangController;
use App\Http\Controllers\Admin\ProfileAdminController;
use Illuminate\Support\Facades\Auth;

// Halaman login default
Route::get('/', function () {
    // Periksa apakah pengguna sudah login
    if (Auth::check()) {
        // Jika user sudah login, arahkan ke dashboard berdasarkan tipe user
        $user = Auth::user();
        if ($user->usertype === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->usertype === 'user') {
            return redirect()->route('user.dashboard');
        }
    }

    // Jika belum login, arahkan ke halaman login
    return view('auth.login');
});

// Middleware untuk memastikan user terautentikasi dan terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Route untuk dashboard superadmin
    Route::get('superadmin/dashboard', [HomeController::class, 'superadminhome'])->name('superadmin.dashboard');
    
    // Group route dengan prefix "superadmin" dan namespace "superadmin."
   Route::middleware(['auth', 'verified'])->prefix('superadmin')->name('superadmin.')->group(function () {

        // Route untuk menampilkan halaman stok masuk tanpa filter
        Route::get('tampil-data-masuk', [TampilGudangMasukController::class, 'index'])->name('stok.index');

        // Route untuk menampilkan stok masuk berdasarkan gudang
        Route::get('tampil-data-masuk/gudang', [TampilGudangMasukController::class, 'tampil'])->name('stok.tampil');
        
        // Route untuk mengedit dan mengupdate stok gudang masuk
        Route::get('stok/edit/{gudang}/{id}', [TampilGudangMasukController::class, 'edit'])->name('stok.edit');
        Route::put('stok/update/{gudang}/{id}', [TampilGudangMasukController::class, 'update'])->name('stok.update');

        // Route untuk menampilkan halaman stok keluar tanpa filter
        Route::get('tampil-data-keluar', [TampilGudangKeluarController::class, 'index'])->name('stok.keluar.index');

        // Route untuk menampilkan stok keluar berdasarkan gudang
        Route::get('tampil-data-keluar/gudang', [TampilGudangKeluarController::class, 'tampil'])->name('stok.keluar.tampil');

        // Route untuk menambahkan data pada Stok Gudang Masuk
        Route::get('tambah-data', [GudangMasukController::class, 'create'])->name('stok.create');
        Route::post('tambah-data-masuk', [GudangMasukController::class, 'storeStokMasuk'])->name('stok.masuk');
        
        // Route untuk menambahkan data pada Stok Gudang Keluar
        Route::get('keluar-data', [GudangKeluarController::class, 'out'])->name('stok.out');
        Route::post('keluar-data-keluar', [GudangKeluarController::class, 'storeStokKeluar'])->name('stok.keluar');

        // Route untuk manajemen user hanya diakses oleh superadmin
        Route::resource('manage-users', ManageUserController::class)->parameters([
            'manage-users' => 'user',
        ]);
    });

    Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [HomeController::class, 'adminhome'])->name('dashboard');
    
        // Route untuk stok masuk
        Route::get('stok-masuk', [AdminGudangController::class, 'stokMasuk'])->name('stok.index');
    
        // Route untuk stok keluar
        Route::get('stok-keluar', [AdminGudangController::class, 'stokKeluar'])->name('stok.keluar.index');
    
        // Form tambah stok masuk
        Route::get('tambah-stok-masuk', [AdminGudangController::class, 'create'])->name('stok.create');
    
        // Simpan stok masuk
        Route::post('tambah-stok-masuk', [AdminGudangController::class, 'storeStokMasuk'])->name('stok.masuk.store');
    
        // Form tambah stok keluar
        Route::get('tambah-stok-keluar', [AdminGudangController::class, 'out'])->name('stok.out');
    
        // Simpan stok keluar
        Route::post('tambah-stok-keluar', [AdminGudangController::class, 'storeStokKeluar'])->name('stok.keluar.store');

        // Definisi route profil admin tanpa 'admin.' tambahan
        Route::get('profile', [ProfileAdminController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileAdminController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileAdminController::class, 'updatePassword'])->name('profile.password.update');
        Route::delete('profile', [ProfileAdminController::class, 'destroy'])->name('profile.destroy');
    });
    
    // Route untuk dashboard user
    Route::get('user/dashboard', [HomeController::class, 'userhome'])->name('user.dashboard');

    // Route untuk profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.userprofile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan auth routes dari Laravel Breeze atau Fortify
require __DIR__ . '/auth.php';

