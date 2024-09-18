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
        // Validasi input
        $request->validate([
            'tipe_produk' => 'required|string',
            'jumlah_dari_pabrik' => 'required|numeric',
            'jumlah_dari_mutasi' => 'required|numeric',
            'nama_gudang_mutasi' => 'required|string',
            'retur_konsumen' => 'required|numeric',
            'barang_repack' => 'required|numeric',
        ]);

        // Hitung nilai jumlah
        $jumlah = $request->jumlah_dari_pabrik + $request->jumlah_dari_mutasi + $request->retur_konsumen + $request->barang_repack;

        // Ambil stok sebelumnya dari entri stok terakhir (urutkan berdasarkan tanggal)
        $stokSebelumnya = DB::table('stok_masuk_' . $gudang)
            ->where('id', '<>', $id) // Tidak termasuk stok yang sedang diedit
            ->orderBy('tanggal', 'desc')
            ->value('stok_akhir') ?? 0;

        // Hitung stok akhir
        $stokAkhir = $stokSebelumnya + $jumlah;

        // Update data stok di database
        DB::table('stok_masuk_' . $gudang)
            ->where('id', $id)
            ->update([
                'tipe_produk' => $request->tipe_produk,
                'jumlah_dari_pabrik' => $request->jumlah_dari_pabrik,
                'jumlah_dari_mutasi' => $request->jumlah_dari_mutasi,
                'nama_gudang_mutasi' => $request->nama_gudang_mutasi,
                'retur_konsumen' => $request->retur_konsumen,
                'barang_repack' => $request->barang_repack,
                'jumlah' => $jumlah,
                'stok_akhir' => $stokAkhir,
            ]);

        // Redirect kembali ke halaman stok dengan pesan sukses
        return redirect()->route('superadmin.stok.tampil', ['gudang' => $gudang])->with('success', 'Data stok berhasil diperbarui.');
    }
}
