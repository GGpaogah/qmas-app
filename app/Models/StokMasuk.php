<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    use HasFactory;

    // Remove the constructor and set the default table name to null
    protected $table;

    protected $fillable = [
        'tanggal',
        'jumlah_dari_pabrik',
        'jumlah_dari_mutasi',
        'tipe_produk',
        'nama_gudang_mutasi',
        'retur_konsumen',
        'barang_repack',
        'jumlah',
        'stok_akhir',
        'total_keseluruhan',

        
    ];

    public function __construct(array $attributes = [], $gudang = null)
    {
        parent::__construct($attributes);

        // Tentukan tabel secara dinamis berdasarkan gudang
        if ($gudang) {
            $this->setTable('stok_masuk_' . strtolower($gudang));
        }
    }
}