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
            $table->string('tipe_produk', 255);
            $table->integer('jumlah_penjualan')->nullable()->default(0); // Default to 0
            $table->integer('jumlah_di_mutasi')->nullable()->default(0); // Default to 0
            $table->string('tujuan_gudang_mutasi', 255)->nullable()->default('Tidak ada tujuan mutasi');
            $table->integer('CSR')->nullable()->default(0);
            $table->integer('promo')->nullable()->default(0);
            $table->integer('rusak')->nullable()->default(0);
            $table->integer('rusak_retur_ke_pabrik')->nullable()->default(0);
            $table->integer('jumlah')->default(0); // Default to 0
            $table->string('keterangan', 255)->nullable()->default('Tidak ada Keterangan CSR');
            $table->timestamps();
        });

        Schema::create('stok_keluar_cengger', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);
            $table->integer('jumlah_penjualan')->nullable()->default(0); // Default to 0
            $table->integer('jumlah_di_mutasi')->nullable()->default(0); // Default to 0
            $table->string('tujuan_gudang_mutasi', 255)->nullable()->default('Tidak ada tujuan mutasi');
            $table->integer('CSR')->nullable()->default(0);
            $table->integer('promo')->nullable()->default(0);
            $table->integer('rusak')->nullable()->default(0);
            $table->integer('rusak_retur_ke_pabrik')->nullable()->default(0);
            $table->integer('jumlah')->default(0); // Default to 0
            $table->string('keterangan', 255)->nullable()->default('Tidak ada Keterangan CSR');
            $table->timestamps();
        });

        Schema::create('stok_keluar_kalimetro', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);
            $table->integer('jumlah_penjualan')->nullable()->default(0); // Default to 0
            $table->integer('jumlah_di_mutasi')->nullable()->default(0); // Default to 0
            $table->string('tujuan_gudang_mutasi', 255)->nullable()->default('Tidak ada tujuan mutasi');
            $table->integer('CSR')->nullable()->default(0);
            $table->integer('promo')->nullable()->default(0);
            $table->integer('rusak')->nullable()->default(0);
            $table->integer('rusak_retur_ke_pabrik')->nullable()->default(0);
            $table->integer('jumlah')->default(0); // Default to 0
            $table->string('keterangan', 255)->nullable()->default('Tidak ada Keterangan CSR');
            $table->timestamps();
        });

        Schema::create('stok_keluar_nganjuk', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);
            $table->integer('jumlah_penjualan')->nullable()->default(0); // Default to 0
            $table->integer('jumlah_di_mutasi')->nullable()->default(0); // Default to 0
            $table->string('tujuan_gudang_mutasi', 255)->nullable()->default('Tidak ada tujuan mutasi');
            $table->integer('CSR')->nullable()->default(0);
            $table->integer('promo')->nullable()->default(0);
            $table->integer('rusak')->nullable()->default(0);
            $table->integer('rusak_retur_ke_pabrik')->nullable()->default(0);
            $table->integer('jumlah')->default(0); // Default to 0
            $table->string('keterangan', 255)->nullable()->default('Tidak ada Keterangan CSR');
            $table->timestamps();
        });

        Schema::create('stok_keluar_turen', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('tipe_produk', 255);
            $table->integer('jumlah_penjualan')->nullable()->default(0); // Default to 0
            $table->integer('jumlah_di_mutasi')->nullable()->default(0); // Default to 0
            $table->string('tujuan_gudang_mutasi', 255)->nullable()->default('Tidak ada tujuan mutasi');
            $table->integer('CSR')->nullable()->default(0);
            $table->integer('promo')->nullable()->default(0);
            $table->integer('rusak')->nullable()->default(0);
            $table->integer('rusak_retur_ke_pabrik')->nullable()->default(0);
            $table->integer('jumlah')->default(0); // Default to 0
            $table->string('keterangan', 255)->nullable()->default('Tidak ada Keterangan CSR');
            $table->timestamps();
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
