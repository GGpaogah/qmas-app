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
    // Validasi input
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
    $stokMasukTable = 'stok_masuk_' . $gudang;

    // Periksa apakah tabel stok keluar dan stok masuk ada
    if (!DB::getSchemaBuilder()->hasTable($tableName) || !DB::getSchemaBuilder()->hasTable($stokMasukTable)) {
        return redirect()->back()->with(['error' => "Tabel stok untuk gudang '$gudang' tidak ditemukan."]);
    }

    // Hitung total stok keluar
    $totalKeluar = $request->input('jumlah_penjualan')
                    + $request->input('jumlah_di_mutasi')
                    + $request->input('CSR')
                    + $request->input('promo')
                    + $request->input('rusak')
                    + $request->input('rusak_retur_ke_pabrik');

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
            'tipe_produk' => $request->input('tipe_produk'),
            'jumlah_penjualan' => $request->input('jumlah_penjualan'),
            'jumlah_di_mutasi' => $request->input('jumlah_di_mutasi'),
            'tujuan_gudang_mutasi' => $request->input('tujuan_gudang_mutasi'),
            'CSR' => $request->input('CSR'),
            'promo' => $request->input('promo'),
            'rusak' => $request->input('rusak'),
            'rusak_retur_ke_pabrik' => $request->input('rusak_retur_ke_pabrik'),
            'keterangan' => $request->input('keterangan'),
            'jumlah' => $totalKeluar, // Jumlah total keluar
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

        return redirect()->back()->with(['error' => 'Gagal menyimpan stok keluar: ' . $e->getMessage()]);
        }
    }
}
