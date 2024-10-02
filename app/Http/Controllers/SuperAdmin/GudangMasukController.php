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
            'jumlah_dari_pabrik' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'jumlah_dari_mutasi' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'tipe_produk' => 'required|string|max:255',
            'retur_konsumen' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'barang_repack' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'nama_gudang_mutasi' => 'nullable|string|max:255', // Nama gudang mutasi tidak wajib
        ], [
            'gudang.required' => 'Gudang harus dipilih.',
            'tipe_produk.required' => 'Tipe produk harus dipilih.',
        ]);

        // Ambil nilai dari form atau gunakan default 0 jika kosong
        $jumlahDariPabrik = $request->input('jumlah_dari_pabrik', 0);
        $jumlahDariMutasi = $request->input('jumlah_dari_mutasi', 0);
        $returKonsumen = $request->input('retur_konsumen', 0);
        $barangRepack = $request->input('barang_repack', 0);

        // Ambil nilai 'nama_gudang_mutasi' langsung dari input form atau gunakan 'Tidak ada mutasi'
        $namaGudangMutasi = $request->input('nama_gudang_mutasi', 'Tidak ada mutasi');
        $gudang = strtolower($request->input('gudang'));
        $tipeProduk = $request->input('tipe_produk');
        $stokMasuk = new StokMasuk([], $gudang);

        // Hitung total quantity
        $jumlah = $jumlahDariPabrik + $jumlahDariMutasi + $returKonsumen + $barangRepack;

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
                'jumlah_dari_pabrik' => $jumlahDariPabrik,
                'jumlah_dari_mutasi' => $jumlahDariMutasi,
                'tipe_produk' => $tipeProduk,
                'nama_gudang_mutasi' => $namaGudangMutasi,
                'retur_konsumen' => $returKonsumen,
                'barang_repack' => $barangRepack,
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
            Log::error('Gagal menyimpan stok masuk: ' . $e->getMessage());
            return redirect()->back()->with(['error' => 'Gagal menyimpan stok masuk: ' . $e->getMessage()]);
        }
    }
}
