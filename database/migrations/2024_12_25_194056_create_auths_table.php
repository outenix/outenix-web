<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auths', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->unsignedBigInteger('auth_id')->unique(); // ID autentikasi unik
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email pengguna
            $table->string('password'); // Password terenkripsi
            $table->json('provider_id')->nullable(); // ID dari berbagai penyedia (Google dll.)
            $table->string('provider_name')->nullable(); // Nama penyedia autentikasi
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email
            $table->rememberToken(); // Remember token untuk autentikasi
            $table->string('email_verification_token')->nullable(); // Token verifikasi email
            $table->string('temporary_auth_token')->nullable(); // Token otentikasi sementara
            $table->string('ip_address', 45)->nullable(); // IP Address pengguna
            $table->string('status'); // Status pengguna
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auths');
    }
}
