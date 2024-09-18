<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TampilGudangKeluarController extends Controller
{
    // Fungsi untuk menampilkan stok keluar tanpa filter (default)
    public function index()
    {
        return $this->tampil(new Request());
    }

    // Fungsi untuk menampilkan stok keluar berdasarkan filter gudang dan produk
    public function tampil(Request $request)
    {
        // Ambil gudang dari request
        $gudang = $request->query('gudang');
        $tipeProduk = $request->query('tipe_produk');  // Optional filtering by product type

        // Jika gudang tidak dipilih, kembalikan view dengan stokKeluar kosong dan pesan
        if (is_null($gudang)) {
            return view('superadmin.stok.tampil-data-keluar', [
                'stokKeluar' => collect([]),  // Kosongkan stokKeluar
                'gudang' => null,
                'tipe_produk' => null,
            ]);
        }

        // Tentukan tabel stok keluar sesuai gudang yang dipilih
        $table = 'stok_keluar_' . strtolower($gudang);

        // Cek apakah tabel untuk gudang yang dipilih ada
        if (!Schema::hasTable($table)) {
            return redirect()->back()->with('error', 'Gudang yang dipilih tidak valid.');
        }

        // Query data stok keluar
        $query = DB::table($table);
        
        // Jika ada filter tipe produk, tambahkan ke query
        if ($tipeProduk) {
            $query->where('tipe_produk', $tipeProduk);
        }

        // Ambil data stok keluar dengan pagination
        $stokKeluar = $query->paginate(10);

        // Tampilkan view dengan data stok keluar dan gudang yang dipilih
        return view('superadmin.stok.tampil-data-keluar', [
            'stokKeluar' => $stokKeluar,
            'gudang' => $gudang,
            'tipe_produk' => $tipeProduk,
        ]);
    }
}
