<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        // Validate input data
        $validatedData = $request->validate([
            'gudang' => 'required|string|in:babat,turen,kalimetro,cengger,nganjuk',
            'tipe_produk' => 'required|string|max:255',
            'jumlah_penjualan' => 'required|integer',
            'jumlah_di_mutasi' => 'required|integer',
            'tujuan_gudang_mutasi' => 'required|string|max:255',
            'CSR' => 'required|integer',
            'promo' => 'required|integer',
            'rusak' => 'required|integer',
            'rusak_retur_ke_pabrik' => 'required|integer',
        ], [
            'jumlah_di_mutasi.required' => 'Jumlah di mutasi wajib diisi.',
            'tipe_produk.required' => 'Tipe produk harus dipilih.',
        ]);

        
        $gudang = strtolower($request->input('gudang'));
        $tipeProduk = $request->input('tipe_produk');
        $tableName = 'stok_keluar_' . $gudang;

        // Check if the stok_keluar table exists
        if (!DB::getSchemaBuilder()->hasTable($tableName)) {
            return redirect()->back()->withErrors(['error' => "Tabel stok keluar untuk gudang '$gudang' tidak ditemukan."]);
        }

        // Calculate total outbound stock (Jumlah total keluar)
        $totalKeluar = $request->input('jumlah_penjualan')
                     + $request->input('jumlah_di_mutasi')
                     + $request->input('CSR')
                     + $request->input('promo')
                     + $request->input('rusak')
                     + $request->input('rusak_retur_ke_pabrik');

        $stokMasukTable = 'stok_masuk_' . $gudang;

        // Check if the stok_masuk table exists
        if (!DB::getSchemaBuilder()->hasTable($stokMasukTable)) {
            return redirect()->back()->withErrors(['error' => "Tabel stok masuk untuk gudang '$gudang' tidak ditemukan."]);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Check if there is enough stock
            $stokAkhirSebelumnya = DB::table($stokMasukTable)->orderBy('id', 'desc')->value('stok_akhir');
            if ($stokAkhirSebelumnya < $totalKeluar) {
                return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi untuk transaksi ini.']);
            }

            // Insert outbound stock including totalKeluar
            DB::table($tableName)->insert([
                'tanggal' => now(),
                'tipe_produk' => $request->input('tipe_produk'),
                'jumlah_penjualan' => $request->input('jumlah_penjualan'),
                'jumlah_di_mutasi' => $request->input('jumlah_di_mutasi'),
                'tujuan_gudang_mutasi' => $request->input('tujuan_gudang_mutasi'),
                'CSR' => $request->input('CSR'),
                'promo' => $request->input('promo'),
                'rusak' => $request->input('rusak'),
                'rusak_retur_ke_pabrik' => $request->input('rusak_retur_ke_pabrik'),
                'jumlah' => $totalKeluar, // Jumlah total keluar
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Reduce stok_akhir in the stok_masuk table
            DB::table($stokMasukTable)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->decrement('stok_akhir', $totalKeluar);

            // Update stok keseluruhan jika diperlukan
            $totalKeseluruhanSebelumnya = DB::table($stokMasukTable)->sum('stok_akhir');
            DB::table($stokMasukTable)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->update(['total_keseluruhan' => $totalKeseluruhanSebelumnya - $totalKeluar]);

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Stok Keluar berhasil disimpan dan stok akhir diperbarui.');

        } catch (\Exception $e) {
            // Rollback transaction if an error occurs
            DB::rollback();

            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan stok keluar: ' . $e->getMessage()]);
        }
    }
}
