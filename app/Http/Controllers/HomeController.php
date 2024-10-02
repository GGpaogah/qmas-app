<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StokMasuk;
use App\Models\StokKeluar;

class HomeController extends Controller
{
    public function superadminhome()
    {
        if (Auth::user()->usertype !== 'superadmin') {
            return redirect('/unauthorized'); // Redirect jika bukan superadmin
        }

        $superadmin = Auth::user(); // Dapatkan admin yang sedang login
        
        // Pastikan user memiliki properti 'name'
        $name = $superadmin ? strtolower($superadmin->name) : null;  // Nama gudang sebagai string dalam huruf kecil
        
        if (!$name) {
            return redirect()->back()->withErrors('Nama tidak ditemukan untuk superadmin ini.');
        }

        // Kirimkan nama ke view
        return view('superadmin.dashboard', compact('name'));
    }


public function adminhome()
    {
    if (Auth::user()->usertype !== 'admin') {
        return redirect('/unauthorized'); // Redirect jika bukan admin
    }

    $admin = Auth::user();  // Dapatkan admin yang sedang login
    $gudangName = strtolower($admin->gudang);  // Nama gudang sebagai string dalam huruf kecil

    // Pastikan ada nama gudang yang valid
    if (!$gudangName) {
        return redirect()->back()->withErrors('Gudang tidak ditemukan untuk admin ini.');
    }

    // Ambil stok masuk berdasarkan gudang yang sedang dikelola admin
    $stokMasukList = (new StokMasuk([], $gudangName))->get();

    // Kelompokkan stok per tipe produk dan hitung jumlah stok untuk setiap produk
    $stokPerProduk = $stokMasukList->groupBy('tipe_produk')->map(function ($item) {
        return $item->sum('stok_akhir');  // Jumlah stok akhir per produk
    });

    return view('admin.dashboard', compact('gudangName', 'stokPerProduk'));
    }

public function userhome()
    {
    if (Auth::user()->usertype !== 'user') {
        return redirect('/unauthorized'); // Redirect jika bukan user
    }

    return view('user.dashboard');
    }

}