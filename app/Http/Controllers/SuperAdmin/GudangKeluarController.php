<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class GudangKeluarController extends Controller
{
    // Display form to add outbound stock
    public function out()
    {
        return view('superadmin.stok.keluar-data');
    }

    // Store outbound stock and update inbound stock
    public function storeStokKeluar(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'gudang' => 'required|string|in:babat,turen,kalimetro,cengger,nganjuk',
            'tipe_produk' => 'required|string|max:255',
            'jumlah_penjualan' => 'nullable|integer|min:0', // Dapat null dan default 0
            'jumlah_di_mutasi' => 'nullable|integer|min:0', // Mutasi bisa null dan default 0
            'tujuan_gudang_mutasi' => 'nullable|string|max:255', // Tujuan mutasi opsional
            'CSR' => 'nullable|integer|min:0', // Opsional dengan default 0
            'promo' => 'nullable|integer|min:0', // Opsional dengan default 0
            'rusak' => 'nullable|integer|min:0', // Opsional dengan default 0
            'rusak_retur_ke_pabrik' => 'nullable|integer|min:0', // Opsional dengan default 0
            'keterangan' => 'nullable|string|max:255', // Tujuan mutasi opsional
        ], [
            'gudang.required' => 'Gudang harus dipilih.',
            'tipe_produk.required' => 'Tipe produk harus dipilih.',
        ]);

        $gudang = strtolower($request->input('gudang'));
        $tipeProduk = $request->input('tipe_produk');
        $tableName = 'stok_keluar_' . $gudang;
        $stokMasukTable = 'stok_masuk_' . $gudang;

        // Periksa apakah tabel stok keluar dan stok masuk ada
        if (!DB::getSchemaBuilder()->hasTable($tableName) || !DB::getSchemaBuilder()->hasTable($stokMasukTable)) {
            return redirect()->back()->with(['error' => "Tabel stok untuk gudang '$gudang' tidak ditemukan."]);
        }

        // Hitung total stok keluar
        $totalKeluar = $request->input('jumlah_penjualan')
                        + $request->input('jumlah_di_mutasi', 0) // Default 0 jika tidak ada mutasi
                        + $request->input('CSR', 0)
                        + $request->input('promo', 0)
                        + $request->input('rusak', 0)
                        + $request->input('rusak_retur_ke_pabrik', 0);

        DB::beginTransaction();

        try {
            // Periksa apakah stok cukup
            $stokAkhirSebelumnya = DB::table($stokMasukTable)
                ->where('tipe_produk', $tipeProduk)
                ->value('stok_akhir');

            if ($stokAkhirSebelumnya < $totalKeluar) {
                return redirect()->back()->with(['error' => 'Stok tidak mencukupi untuk transaksi ini.']);
            }

            // Masukkan data stok keluar ke dalam tabel stok_keluar
            DB::table($tableName)->insert([
                'tanggal' => now(),
                'tipe_produk' => $tipeProduk,
                'jumlah_penjualan' => $request->input('jumlah_penjualan', 0), // Default 0
                'jumlah_di_mutasi' => $request->input('jumlah_di_mutasi', 0), // Default 0 jika tidak ada mutasi
                'tujuan_gudang_mutasi' => $request->input('tujuan_gudang_mutasi', 'Tidak ada tujuan mutasi'), // Default jika tidak ada mutasi
                'CSR' => $request->input('CSR', 0),
                'promo' => $request->input('promo', 0),
                'rusak' => $request->input('rusak', 0),
                'rusak_retur_ke_pabrik' => $request->input('rusak_retur_ke_pabrik', 0),
                'keterangan' => $request->input('keterangan', 'Tidak ada Keterangan CSR'),
                'jumlah' => $totalKeluar, // Jumlah total keluar
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);

            // Kurangi stok_akhir pada tabel stok_masuk untuk tipe_produk yang dipilih
            DB::table($stokMasukTable)
                ->where('tipe_produk', $tipeProduk)
                ->update(['stok_akhir' => $stokAkhirSebelumnya - $totalKeluar]);

            // Hitung ulang total keseluruhan untuk semua stok akhir
            $totalKeseluruhan = DB::table($stokMasukTable)
                ->sum('stok_akhir');

            // Update total keseluruhan hanya pada entri terbaru
            DB::table($stokMasukTable)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->update(['total_keseluruhan' => $totalKeseluruhan]);

            DB::commit();

            return redirect()->back()->with('success', 'Stok Keluar berhasil disimpan dan stok akhir diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi kesalahan
            DB::rollback();
            Log::error('Gagal menyimpan stok masuk: ' . $e->getMessage());
            return redirect()->back()->with(['error' => 'Gagal menyimpan stok keluar: ' . $e->getMessage()]);
        }
    }
}
