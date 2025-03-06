<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_auths', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->unsignedBigInteger('auth_id'); // auth_id yang merujuk ke auths
            $table->string('device_name'); // Nama perangkat
            $table->string('browser'); // Nama browser
            $table->string('device'); // Jenis perangkat (misal: mobile, desktop)
            $table->string('platform');
            $table->string('ip_address'); // Alamat IP perangkat
            $table->string('auth_at'); // Metode autentikasi (misal: email, google, youtube, dll)
            $table->string('location');
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('auth_id')
                ->references('auth_id')
                ->on('auths')
                ->onDelete('cascade'); // Menghapus log_auths ketika auth dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_auths');
    }
}
