<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TampilGudangMasukController extends Controller
{
    // Fungsi untuk menampilkan stok masuk tanpa filter (default)
    public function index()
    {
        return $this->tampil(new Request()); // Mengarahkan ke fungsi tampil dengan request kosong
    }

    // Fungsi untuk menampilkan stok masuk berdasarkan filter gudang dan produk
    public function tampil(Request $request)
    {
        // Ambil gudang dari request
        $gudang = $request->query('gudang');
        $tipeProduk = $request->query('tipe_produk');  // Optional filtering by product type

        // Jika gudang tidak dipilih, kembalikan view dengan stokMasuk kosong dan pesan
        if (is_null($gudang)) {
            return view('superadmin.stok.tampil-data-masuk', [
                'stokMasuk' => collect([]),  // Kosongkan stokMasuk
                'gudang' => null,
                'tipe_produk' => null,
            ]);
        }

        // Tentukan tabel stok masuk sesuai gudang yang dipilih
        $table = 'stok_masuk_' . strtolower($gudang);

        // Cek apakah tabel untuk gudang yang dipilih ada
        if (!Schema::hasTable($table)) {
            return redirect()->back()->with('error', 'Gudang yang dipilih tidak valid.');
        }

        // Query data stok masuk
        $query = DB::table($table);
        
        // Jika ada filter tipe produk, tambahkan ke query
        if ($tipeProduk) {
            $query->where('tipe_produk', $tipeProduk);
        }

        // Ambil data stok masuk dengan pagination
        $stokMasuk = $query->paginate(10);

        // Tampilkan view dengan data stok masuk dan gudang yang dipilih
        return view('superadmin.stok.tampil-data-masuk', [
            'stokMasuk' => $stokMasuk,
            'gudang' => $gudang,
            'tipe_produk' => $tipeProduk,
        ]);
    }

    // Fungsi untuk mengedit stok masuk
    public function edit($gudang, $id)
    {
        // Ambil stok berdasarkan id dan gudang
        $stok = DB::table('stok_masuk_' . $gudang)->find($id);

        // Kirim data stok ke tampilan untuk diedit
        return view('superadmin.stok.edit', [
            'stok' => $stok,
            'gudang' => $gudang,
        ]);
    }

// Fungsi untuk memperbarui stok masuk
public function update(Request $request, $gudang, $id)
{
    $request->validate([
        'tipe_produk' => 'required|string',
        'jumlah_dari_pabrik' => 'required|numeric',
        'jumlah_dari_mutasi' => 'required|numeric',
        'nama_gudang_mutasi' => 'required|string',
        'retur_konsumen' => 'required|numeric',
        'barang_repack' => 'required|numeric',
    ]);

    // Hitung jumlah baru dari input yang diterima
    $jumlahBaru = $request->jumlah_dari_pabrik + $request->jumlah_dari_mutasi + $request->retur_konsumen + $request->barang_repack;

    // Ambil data stok lama dari database berdasarkan ID
    $stokLama = DB::table('stok_masuk_' . $gudang)->where('id', $id)->first();

    if (!$stokLama) {
        return redirect()->back()->with('error', 'Data stok tidak ditemukan.');
    }

    // Hitung selisih antara jumlah lama dan jumlah baru
    $selisihJumlah = $jumlahBaru - $stokLama->jumlah;

    // Hitung stok akhir baru dengan menambahkan selisih ke stok akhir yang ada
    $stokAkhirBaru = $stokLama->stok_akhir + $selisihJumlah;

    DB::beginTransaction();

    try {
        // Update record yang sedang diedit
        DB::table('stok_masuk_' . $gudang)
            ->where('id', $id)
            ->update([
                'tipe_produk' => $request->tipe_produk,
                'jumlah_dari_pabrik' => $request->jumlah_dari_pabrik,
                'jumlah_dari_mutasi' => $request->jumlah_dari_mutasi,
                'nama_gudang_mutasi' => $request->nama_gudang_mutasi,
                'retur_konsumen' => $request->retur_konsumen,
                'barang_repack' => $request->barang_repack,
                'jumlah' => $jumlahBaru,
                'stok_akhir' => $stokAkhirBaru,
                'updated_at' => now(),
            ]);

        // Update stok_akhir untuk semua entri dengan tipe_produk yang sama menjadi stok akhir yang baru dihitung sekali saja
        DB::table('stok_masuk_' . $gudang)
            ->where('tipe_produk', $request->tipe_produk)
            ->update(['stok_akhir' => $stokAkhirBaru]);

        // Hitung ulang total keseluruhan untuk semua produk (hanya sekali untuk semua stok_akhir tipe produk yang dipilih)
        $totalKeseluruhanProduk = DB::table('stok_masuk_' . $gudang)
            ->distinct()
            ->sum('stok_akhir');

        // Ambil ID terakhir atau terbaru
        $idTerbaru = DB::table('stok_masuk_' . $gudang)->max('id');

        // Update total keseluruhan pada entri terbaru saja
        DB::table('stok_masuk_' . $gudang)
            ->where('id', $idTerbaru)
            ->update(['total_keseluruhan' => $totalKeseluruhanProduk]);

        DB::commit();

        return redirect()->route('superadmin.stok.tampil', ['gudang' => $gudang])->with('success', 'Data stok berhasil diperbarui.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui stok: ' . $e->getMessage());
        }
    }

}