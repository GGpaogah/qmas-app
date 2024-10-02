<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok_keluar_babat', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);  // String with length
            $table->integer('jumlah_penjualan');
            $table->integer('jumlah_di_mutasi');
            $table->string('tujuan_gudang_mutasi', 255);  // String with length
            $table->integer('CSR')->default(0);
            $table->integer('promo')->default(0);
            $table->integer('rusak')->default(0);
            $table->integer('rusak_retur_ke_pabrik')->default(0);
            $table->integer('jumlah');
            $table->string('keterangan', length:255);
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_keluar_cengger_ayam', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);  // String with length
            $table->integer('jumlah_penjualan');
            $table->integer('jumlah_di_mutasi');
            $table->string('tujuan_gudang_mutasi', 255);  // String with length
            $table->integer('CSR')->default(0);
            $table->integer('promo')->default(0);
            $table->integer('rusak')->default(0);
            $table->integer('rusak_retur_ke_pabrik')->default(0);
            $table->integer('jumlah');
            $table->string('keterangan', length:255);
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_keluar_kalimetro', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);  // String with length
            $table->integer('jumlah_penjualan');
            $table->integer('jumlah_di_mutasi');
            $table->string('tujuan_gudang_mutasi', 255);  // String with length
            $table->integer('CSR')->default(0);
            $table->integer('promo')->default(0);
            $table->integer('rusak')->default(0);
            $table->integer('rusak_retur_ke_pabrik')->default(0);
            $table->integer('jumlah');
            $table->string('keterangan', length:255);
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_keluar_nganjuk', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);  // String with length
            $table->integer('jumlah_penjualan');
            $table->integer('jumlah_di_mutasi');
            $table->string('tujuan_gudang_mutasi', 255);  // String with length
            $table->integer('CSR')->default(0);
            $table->integer('promo')->default(0);
            $table->integer('rusak')->default(0);
            $table->integer('rusak_retur_ke_pabrik')->default(0);
            $table->integer('jumlah');
            $table->string('keterangan', length:255);
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_keluar_turen', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);  // String with length
            $table->integer('jumlah_penjualan');
            $table->integer('jumlah_di_mutasi');
            $table->string('tujuan_gudang_mutasi', 255);  // String with length
            $table->integer('CSR');
            $table->integer('promo');
            $table->integer('rusak');
            $table->integer('rusak_retur_ke_pabrik');
            $table->integer('jumlah');
            $table->string('keterangan', length:255);
            $table->timestamps(); // Add created_at and updated_at columns
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_keluar_babat');
        Schema::dropIfExists('stok_keluar_cengger_ayam');
        Schema::dropIfExists('stok_keluar_kalimetro');
        Schema::dropIfExists('stok_keluar_nganjuk');
        Schema::dropIfExists('stok_keluar_turen');
    }
};
