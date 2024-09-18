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
        // Schema::create('data_superadmin', function (Blueprint $table){
        //     $table->id();
        //     $table->string('username')->unique();
        //     $table->string('password');
        //     $table->string('name');
        //     $table->string('jabatan');
        //     $table->string('telepon');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->rememberToken();
        //     $table->timestamps();
        // });

        // Schema::create('data_admin', function( Blueprint $table) {
        //     $table->id();
        //     $table->string('username')->unique();
        //     $table->string('password');
        //     $table->string('name');
        //     $table->string('gudang');
        //     $table->string('telepon');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('status')->comment('0=pending, 1=active, 2=suspended');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });

        // Schema::create('data_user', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('username')->unique();
        //     $table->string('password');
        //     $table->string('name');
        //     $table->string('telepon');
        //     $table->string('alamat');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('status')->comment('0=pending, 1=active, 2=suspended');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('usertype')->default('user');
            // $table->tinyInteger('type')->default(0);
            /* Users: 0=>User, 1=>Admin, 2=>Superadmin */
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('data_superadmin');
        // Schema::dropIfExists('data_admin');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
