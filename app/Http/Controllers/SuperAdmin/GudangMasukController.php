<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class GudangMasukController extends Controller
{
    // Menampilkan form untuk menambahkan data stok baru
    public function create()
    {
        return view('superadmin.stok.tambah-data');
    }

    // Menyimpan data stok masuk ke dalam database
    public function storeStokMasuk(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'gudang' => 'required|string|max:255',
            'jumlah_dari_pabrik' => 'required|integer',
            'jumlah_dari_mutasi' => 'required|integer',
            'tipe_produk' => 'required|string|max:255',
            'retur_konsumen' => 'required|integer',
            'barang_repack' => 'required|integer',
            
        ], [
            'gudang.required' => 'Gudang harus dipilih.',
            'jumlah_dari_pabrik.required' => 'Jumlah dari pabrik harus diisi.',
            'jumlah_dari_mutasi.required' => 'Jumlah dari mutasi harus diisi.',
            'tipe_produk.required' => 'Tipe produk harus dipilih.',
            'retur_konsumen.required' => 'Retur konsumen harus diisi.',
            'barang_repack.required' => 'Barang repack harus diisi.',
        ]);

        $gudang = strtolower($request->input('gudang'));
        $tipeProduk = $request->input('tipe_produk');
        $stokMasuk = new StokMasuk([], $gudang);

        // Hitung total quantity
        $jumlah = $request->input('jumlah_dari_pabrik')
                + $request->input('jumlah_dari_mutasi')
                + $request->input('retur_konsumen')
                + $request->input('barang_repack');

        // Ambil stok akhir sebelumnya untuk tipe produk yang sama
        $stokSebelumnya = $stokMasuk->where('tipe_produk', $tipeProduk)->orderBy('tanggal', 'desc')->value('stok_akhir') ?? 0;

        // Hitung stok akhir baru
        $stokAkhir = $stokSebelumnya + $jumlah;

        // Hitung total keseluruhan stok
        $totalKeseluruhan = DB::table('stok_masuk_' . $gudang)->sum('stok_akhir') + $stokAkhir;

        DB::beginTransaction();

        try {
            // Insert record stok masuk baru
            $stokMasuk->create([
                'tanggal' => now(),
                'jumlah_dari_pabrik' => $request->input('jumlah_dari_pabrik'),
                'jumlah_dari_mutasi' => $request->input('jumlah_dari_mutasi'),
                'tipe_produk' => $tipeProduk,
                'nama_gudang_mutasi' => $request->input('nama_gudang_mutasi'), // Pastikan field ini ada di form
                'retur_konsumen' => $request->input('retur_konsumen'),
                'barang_repack' => $request->input('barang_repack'),
                'jumlah' => $jumlah,
                'stok_akhir' => $stokAkhir, // Stok akhir untuk produk yang sama
                'total_keseluruhan' => $totalKeseluruhan, // Total keseluruhan stok untuk semua produk
            ]);

            // Update semua entri dengan tipe_produk yang sama untuk stok_akhir
            DB::table('stok_masuk_' . $gudang)
                ->where('tipe_produk', $tipeProduk)
                ->update(['stok_akhir' => $stokAkhir]);

            DB::commit();

            return redirect()->back()->with('success', 'Stok Masuk berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with(['error' => 'Gagal menyimpan stok masuk: ' . $e->getMessage()]);
        }
    }
}
