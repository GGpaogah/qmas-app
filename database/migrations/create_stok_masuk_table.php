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
            $table->id();  // Auto-increment primary key
            $table->timestamp('tanggal')->useCurrent();  // Default timestamp
            $table->integer('jumlah_dari_pabrik');  // Integer without length parameter
            $table->integer('jumlah_dari_mutasi');  // Integer without length parameter
            $table->string('tipe_produk', 255);  // String with length
            $table->string('nama_gudang_mutasi', 255);  // String with length
            $table->integer('retur_konsumen');  // Integer without length parameter
            $table->integer('barang_repack');  // Integer without length parameter
            $table->integer('jumlah');  // Integer without length parameter
            $table->integer('stok_akhir');  // Integer without length parameter
            $table->integer('total_keseluruhan')->default(0); // Integer with default value 0
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_masuk_cengger_ayam', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->timestamp('tanggal')->useCurrent();  // Default timestamp
            $table->integer('jumlah_dari_pabrik');  // Integer without length parameter
            $table->integer('jumlah_dari_mutasi');  // Integer without length parameter
            $table->string('tipe_produk', 255);  // String with length
            $table->string('nama_gudang_mutasi', 255);  // String with length
            $table->integer('retur_konsumen');  // Integer without length parameter
            $table->integer('barang_repack');  // Integer without length parameter
            $table->integer('jumlah');  // Integer without length parameter
            $table->integer('stok_akhir');  // Integer without length parameter
            $table->integer('total_keseluruhan')->default(0); // Integer with default value 0
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_masuk_kalimetro', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->timestamp('tanggal')->useCurrent();  // Default timestamp
            $table->integer('jumlah_dari_pabrik');  // Integer without length parameter
            $table->integer('jumlah_dari_mutasi');  // Integer without length parameter
            $table->string('tipe_produk', 255);  // String with length
            $table->string('nama_gudang_mutasi', 255);  // String with length
            $table->integer('retur_konsumen');  // Integer without length parameter
            $table->integer('barang_repack');  // Integer without length parameter
            $table->integer('jumlah');  // Integer without length parameter
            $table->integer('stok_akhir');  // Integer without length parameter
            $table->integer('total_keseluruhan')->default(0); // Integer with default value 0
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_masuk_nganjuk', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->timestamp('tanggal')->useCurrent();  // Default timestamp
            $table->integer('jumlah_dari_pabrik');  // Integer without length parameter
            $table->integer('jumlah_dari_mutasi');  // Integer without length parameter
            $table->string('tipe_produk', 255);  // String with length
            $table->string('nama_gudang_mutasi', 255)->default('Tidak ada mutasi');  // String with length
            $table->integer('retur_konsumen');  // Integer without length parameter
            $table->integer('barang_repack');  // Integer without length parameter
            $table->integer('jumlah');  // Integer without length parameter
            $table->integer('stok_akhir');  // Integer without length parameter
            $table->integer('total_keseluruhan')->default(0); // Integer with default value 0
            $table->timestamps(); // Add created_at and updated_at columns
        });

        Schema::create('stok_masuk_turen', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->timestamp('tanggal')->useCurrent();  // Default timestamp
            $table->integer('jumlah_dari_pabrik');  // Integer without length parameter
            $table->integer('jumlah_dari_mutasi');  // Integer without length parameter
            $table->string('tipe_produk', 255);  // String with length
            $table->string('nama_gudang_mutasi', 255);  // String with length
            $table->integer('retur_konsumen');  // Integer without length parameter
            $table->integer('barang_repack');  // Integer without length parameter
            $table->integer('jumlah');  // Integer without length parameter
            $table->integer('stok_akhir');  // Integer without length parameter
            $table->integer('total_keseluruhan')->default(0); // Integer with default value 0
            $table->timestamps(); // Add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuk_babat');
        Schema::dropIfExists('stok_masuk_cengger_ayam');
        Schema::dropIfExists('stok_masuk_kalimetro');
        Schema::dropIfExists('stok_masuk_nganjuk');
        Schema::dropIfExists('stok_masuk_turen');
    }
};
