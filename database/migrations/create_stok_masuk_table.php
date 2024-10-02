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
        Schema::create('stok_masuk_babat', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('jumlah_dari_pabrik')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah_dari_mutasi')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->string('tipe_produk', 255);
            $table->string('nama_gudang_mutasi', 255)->nullable()->default('Tidak ada mutasi');
            $table->integer('retur_konsumen')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('barang_repack')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah');
            $table->integer('stok_akhir');
            $table->integer('total_keseluruhan')->default(0);
            $table->timestamps();
        });

        Schema::create('stok_masuk_cengger', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('jumlah_dari_pabrik')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah_dari_mutasi')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->string('tipe_produk', 255);
            $table->string('nama_gudang_mutasi', 255)->nullable()->default('Tidak ada mutasi');
            $table->integer('retur_konsumen')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('barang_repack')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah');
            $table->integer('stok_akhir');
            $table->integer('total_keseluruhan')->default(0);
            $table->timestamps();
        });

        Schema::create('stok_masuk_kalimetro', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('jumlah_dari_pabrik')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah_dari_mutasi')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->string('tipe_produk', 255);
            $table->string('nama_gudang_mutasi', 255)->nullable()->default('Tidak ada mutasi');
            $table->integer('retur_konsumen')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('barang_repack')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah');
            $table->integer('stok_akhir');
            $table->integer('total_keseluruhan')->default(0);
            $table->timestamps();
        });

        Schema::create('stok_masuk_nganjuk', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('jumlah_dari_pabrik')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah_dari_mutasi')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->string('tipe_produk', 255);
            $table->string('nama_gudang_mutasi', 255)->nullable()->default('Tidak ada mutasi');
            $table->integer('retur_konsumen')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('barang_repack')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah');
            $table->integer('stok_akhir');
            $table->integer('total_keseluruhan')->default(0);
            $table->timestamps();
        });

        Schema::create('stok_masuk_turen', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('jumlah_dari_pabrik')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah_dari_mutasi')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->string('tipe_produk', 255);
            $table->string('nama_gudang_mutasi', 255)->nullable()->default('Tidak ada mutasi');
            $table->integer('retur_konsumen')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('barang_repack')->nullable()->default(0);  // Nullable jika tidak diisi
            $table->integer('jumlah');
            $table->integer('stok_akhir');
            $table->integer('total_keseluruhan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuk_babat');
        Schema::dropIfExists('stok_masuk_cengger');  // Sesuaikan dengan nama tabel
        Schema::dropIfExists('stok_masuk_kalimetro');
        Schema::dropIfExists('stok_masuk_nganjuk');
        Schema::dropIfExists('stok_masuk_turen');
    }
};
