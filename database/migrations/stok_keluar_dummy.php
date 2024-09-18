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
        Schema::create('stok_keluar', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
            $table->integer('jumlah_penjualan');
            $table->integer('jumlah_dari_mutasi');
            $table->integer('jumlah_ke_gudang');
            $table->integer('CSR');
            $table->integer('promo');
            $table->integer('rusak');
            $table->integer('rusak_retur_ke_pabrik');
            $table->timestamps(); // Add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_keluar');
    }
};
