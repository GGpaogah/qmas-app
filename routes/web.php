<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\GudangMasukController;
use App\Http\Controllers\SuperAdmin\GudangKeluarController;
use App\Http\Controllers\SuperAdmin\ManageUserController;
use App\Http\Controllers\SuperAdmin\TampilGudangMasukController;
use App\Http\Controllers\SuperAdmin\TampilGudangKeluarController;

// Halaman login default
Route::get('/', function () {
    return view('auth.login');
});

// Middleware untuk memastikan user terautentikasi dan terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Route untuk dashboard superadmin
    Route::get('superadmin/dashboard', [HomeController::class, 'superadminhome'])->name('superadmin.dashboard');
    
    // Group route dengan prefix "superadmin" dan namespace "superadmin."
    Route::prefix('superadmin')->name('superadmin.')->group(function () {

        // Route untuk menampilkan halaman stok masuk tanpa filter
        Route::get('tampil-data-masuk', [TampilGudangMasukController::class, 'index'])->name('stok.index');

        // Route untuk menampilkan stok masuk berdasarkan gudang
        Route::get('tampil-data-masuk/gudang', [TampilGudangMasukController::class, 'tampil'])->name('stok.tampil');
        
        // Route untuk mengedit dan mengupdate stok gudang masuk
        Route::get('stok/edit/{gudang}/{id}', [TampilGudangMasukController::class, 'edit'])->name('stok.edit');
        Route::put('superadmin/stok/update/{gudang}/{id}', [TampilGudangMasukController::class, 'update'])->name('stok.update');

        // Route untuk menampilkan halaman stok keluar tanpa filter
        Route::get('superadmin/tampil-data-keluar', [TampilGudangKeluarController::class, 'index'])->name('stok.keluar.index');

        // Route untuk menampilkan stok keluar berdasarkan gudang
        Route::get('superadmin/tampil-data-keluar/gudang', [TampilGudangKeluarController::class, 'tampil'])->name('stok.keluar.tampil');

        // Route untuk menambahkan data pada Stok Gudang Masuk
        Route::get('tambah-data', [GudangMasukController::class, 'create'])->name('stok.create');
        Route::post('tambah-data-masuk', [GudangMasukController::class, 'storeStokMasuk'])->name('stok.masuk');
        
        // Route untuk menambahkan data pada Stok Gudang Keluar
        Route::get('keluar-data', [GudangKeluarController::class, 'out'])->name('stok.out');
        Route::post('keluar-data-keluar', [GudangKeluarController::class, 'storeStokKeluar'])->name('stok.keluar');

        // Route untuk manajemen user
        Route::resource('manage-users', ManageUserController::class)->parameters([
            'manage-users' => 'user',
        ]);
    });

    // Route untuk dashboard admin dan user
    Route::get('admin/dashboard', [HomeController::class, 'adminhome'])->name('admin.dashboard');
    Route::get('user/dashboard', [HomeController::class, 'userhome'])->name('user.dashboard');

    // Route untuk profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.userprofile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan auth routes dari Laravel Breeze atau Fortify
require __DIR__ . '/auth.php';
