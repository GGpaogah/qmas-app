<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class StokKeluar extends Model
    {
        use HasFactory;

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
        ];

        public function __construct(array $attributes = [], $gudang = null)
        {
            parent::__construct($attributes);

            // Tentukan tabel secara dinamis berdasarkan gudang
            if ($gudang) {
                $this->setTable("stok_keluar_" . strtolower($gudang)); // Gunakan nama tabel berdasarkan gudang
            }
        }
    }