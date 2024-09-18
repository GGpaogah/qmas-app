<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        // Validate incoming request
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

        $gudang = $request->input('gudang');
        $tipeProduk = $request->input('tipe_produk');
        $stokMasuk = new StokMasuk([], $gudang);

        // Calculate total quantity = sum of inputs
        $jumlah = $request->input('jumlah_dari_pabrik')
                + $request->input('jumlah_dari_mutasi')
                + $request->input('retur_konsumen')
                + $request->input('barang_repack');

        // Retrieve previous stock for the same product type from the most recent entry
        $stokSebelumnya = $stokMasuk->where('tipe_produk', $tipeProduk)->orderBy('tanggal', 'desc')->value('stok_akhir') ?? 0;

        // Calculate new stock for the same product type
        $stokAkhir = $stokSebelumnya + $jumlah;

        // Calculate total keseluruhan (sum of stok_akhir for all product types)
        $totalKeseluruhan = DB::table('stok_masuk_' . $gudang)->sum('stok_akhir') + $stokAkhir;

        DB::beginTransaction();

        try {
            // Insert new stok masuk record
            $stokMasuk->create([
                'tanggal' => now(),
                'jumlah_dari_pabrik' => $request->input('jumlah_dari_pabrik'),
                'jumlah_dari_mutasi' => $request->input('jumlah_dari_mutasi'),
                'tipe_produk' => $request->input('tipe_produk'),
                'nama_gudang_mutasi' => $request->input('nama_gudang_mutasi'),
                'retur_konsumen' => $request->input('retur_konsumen'),
                'barang_repack' => $request->input('barang_repack'),
                'jumlah' => $jumlah,
                'stok_akhir' => $stokAkhir, // Stok akhir untuk produk yang sama
                'total_keseluruhan' => $totalKeseluruhan, // Total keseluruhan stok untuk semua produk
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Stok Masuk berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan stok masuk: ' . $e->getMessage()]);
        }
    }
}
