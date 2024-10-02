<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table;

    protected $fillable = [
        'tanggal',
        'jumlah_penjualan',
        'jumlah_di_mutasi',
        'tujuan_gudang_mutasi',
        'CSR',
        'promo',
        'rusak',
        'rusak_retur_ke_pabrik',
        'keterangan',
        'jumlah',
    ];

    public function __construct(array $attributes = [], $gudang = null)
    {
        parent::__construct($attributes);

        // Tetapkan tabel dinamis berdasarkan gudang yang dipilih
        if ($gudang) {
            $this->setTable('stok_keluar_' . strtolower($gudang));
        }
    }
}
