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
        Schema::create('transaksi_babat', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
            $table->string('nama', 255);
            $table->string('status', 255);
            $table->string('pembelian', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('terkirim', false, true);
            $table->decimal('pembayaran', 12, 2);
            $table->decimal('kekurangan', 12, 2)->storedAs('harga - pembayaran');
            $table->string('ket', 255)->storedAs('IF(harga - pembayaran > 0, "Belum Lunas", "Lunas")');
        });

        Schema::create('transaksi_cengger_ayam', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
            $table->string('nama', 255);
            $table->string('status', 255);
            $table->string('pembelian', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('terkirim', false, true);
            $table->decimal('pembayaran', 12, 2);
            $table->decimal('kekurangan', 12, 2)->storedAs('harga - pembayaran');
            $table->string('ket', 255)->storedAs('IF(harga - pembayaran > 0, "Belum Lunas", "Lunas")');
        });

        Schema::create('transaksi_kalimetro', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
            $table->string('nama', 255);
            $table->string('status', 255);
            $table->string('pembelian', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('terkirim', false, true);
            $table->decimal('pembayaran', 12, 2);
            $table->decimal('kekurangan', 12, 2)->storedAs('harga - pembayaran');
            $table->string('ket', 255)->storedAs('IF(harga - pembayaran > 0, "Belum Lunas", "Lunas")');
        });

        Schema::create('transaksi_nganjuk', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
            $table->string('nama', 255);
            $table->string('status', 255);
            $table->string('pembelian', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('terkirim', false, true);
            $table->decimal('pembayaran', 12, 2);
            $table->decimal('kekurangan', 12, 2)->storedAs('harga - pembayaran');
            $table->string('ket', 255)->storedAs('IF(harga - pembayaran > 0, "Belum Lunas", "Lunas")');
        });

        Schema::create('transaksi_turen', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent()->useCurrentOnUpdate();
            $table->string('nama', 255);
            $table->string('status', 255);
            $table->string('pembelian', 255);
            $table->decimal('harga', 12, 2);
            $table->integer('terkirim', false, true);
            $table->decimal('pembayaran', 12, 2);
            $table->decimal('kekurangan', 12, 2)->storedAs('harga - pembayaran');
            $table->string('ket', 255)->storedAs('IF(harga - pembayaran > 0, "Belum Lunas", "Lunas")');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_babat');
        Schema::dropIfExists('transaksi_cengger_ayam');
        Schema::dropIfExists('transaksi_kalimetro');
        Schema::dropIfExists('transaksi_nganjuk');
        Schema::dropIfExists('transaksi_turen');
    }
};
