<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminGudangController extends Controller
{
    // Menampilkan Stok Masuk
    public function stokMasuk(Request $request)
    {
        $gudang = Auth::user()->gudang;

        // Cek apakah nama gudang valid
        if (!$gudang) {
            return redirect()->back()->with('error', 'Gudang tidak ditemukan');
        }

        // Instantiate the model
        $stokMasukModel = new StokMasuk();

        // Set the table name dynamically
        $stokMasukModel->setTable('stok_masuk_' . strtolower($gudang));

        // Cek apakah tabel stok masuk untuk gudang tersebut ada
        if (!DB::getSchemaBuilder()->hasTable($stokMasukModel->getTable())) {
            return redirect()->back()->with('error', 'Tabel stok masuk untuk gudang ini tidak ditemukan.');
        }

        // Build the query using the model instance
        $query = $stokMasukModel->newQuery();

        // Apply filters if any
        if ($request->has('tipe_produk') && $request->tipe_produk != '') {
            $query->where('tipe_produk', $request->tipe_produk);
        }

        // Get the results with pagination
        $stokMasuk = $query->paginate(10);

        return view('admin.stok-admin.index', compact('stokMasuk', 'gudang'));
    }

    // Menampilkan Stok Keluar
    public function stokKeluar(Request $request)
    {
        $gudang = Auth::user()->gudang;

        // Cek apakah nama gudang valid
        if (!$gudang) {
            return redirect()->back()->with('error', 'Gudang tidak ditemukan');
        }

        // Instantiate the model
        $stokKeluarModel = new StokKeluar();

        // Set the table name dynamically
        $stokKeluarModel->setTable('stok_keluar_' . strtolower($gudang));

        // Cek apakah tabel stok keluar untuk gudang tersebut ada
        if (!DB::getSchemaBuilder()->hasTable($stokKeluarModel->getTable())) {
            return redirect()->back()->with('error', 'Tabel stok keluar untuk gudang ini tidak ditemukan.');
        }

        // Build the query using the model instance
        $query = $stokKeluarModel->newQuery();

        // Apply filters if any
        if ($request->has('tipe_produk') && $request->tipe_produk != '') {
            $query->where('tipe_produk', $request->tipe_produk);
        }

        // Get the results with pagination
        $stokKeluar = $query->paginate(10);

        return view('admin.stok-admin.keluar', compact('stokKeluar', 'gudang'));
    }

    // Menampilkan Form Tambah Stok Masuk
    public function create()
    {
        $gudang = Auth::user()->gudang;

        // Cek apakah nama gudang valid
        if (!$gudang) {
            return redirect()->back()->with('error', 'Gudang tidak ditemukan');
        }

        return view('admin.stok-admin.tambah-data', compact('gudang'));
    }

    // Menyimpan data stok masuk ke dalam database
    public function storeStokMasuk(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'jumlah_dari_pabrik' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'jumlah_dari_mutasi' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'tipe_produk' => 'required|string|max:255',
            'retur_konsumen' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            'barang_repack' => 'nullable|integer|min:0', // Nullable, default 0 jika tidak diisi
            
        ], [
            'gudang.required' => 'Gudang harus dipilih.',
            'tipe_produk.required' => 'Tipe produk harus dipilih.',
        ]);

        $gudang = strtolower(Auth::user()->gudang);
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
                'jumlah_dari_pabrik' => $request->input('jumlah_dari_pabrik', 0),
                'jumlah_dari_mutasi' => $request->input('jumlah_dari_mutasi', 0),
                'tipe_produk' => $tipeProduk,
                'nama_gudang_mutasi' => $request->input('nama_gudang_mutasi', 'Tidak ada mutasi'), // Pastikan field ini ada di form
                'retur_konsumen' => $request->input('retur_konsumen', 0),
                'barang_repack' => $request->input('barang_repack', 0),
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
    public function out()
    {
        // Mengambil gudang admin yang login
        $gudang = Auth::user()->gudang;
    
        // Cek apakah nama gudang valid
        if (!$gudang) {
            return redirect()->back()->with('error', 'Gudang tidak ditemukan');
        }
    
        return view('admin.stok-admin.keluar-data', compact('gudang'));
    }

    // Store outbound stock and update inbound stock
    public function storeStokKeluar(Request $request)
    {
    // Validasi input
    $validatedData = $request->validate([
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

    $gudang = strtolower(Auth::user()->gudang);
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
            'jumlah_penjualan' => $request->input('jumlah_penjualan',0),
            'jumlah_di_mutasi' => $request->input('jumlah_di_mutasi',0),
            'tujuan_gudang_mutasi' => $request->input('tujuan_gudang_mutasi', 'Tidak ada tujuan mutasi'), // Default jika tidak ada mutasi
            'CSR' => $request->input('CSR',0),
            'promo' => $request->input('promo',0),
            'rusak' => $request->input('rusak',0),
            'rusak_retur_ke_pabrik' => $request->input('rusak_retur_ke_pabrik',0),
            'keterangan' => $request->filled('keterangan') ? $request->input('keterangan') : 'Tidak ada Keterangan CSR',
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

        return redirect()->back()->with(['error' => 'Gagal menyimpan stok keluar: ' . $e->getMessage()]);
        }
    }
}
