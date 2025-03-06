<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auth_id'); // Menyimpan ID autentikasi
            $table->string('device_name');
            $table->string('browser'); // Menyimpan informasi browser
            $table->string('device'); // Menyimpan tipe perangkat
            $table->string('platform');
            $table->string('ip_address'); // Menyimpan alamat IP
            $table->string('cookie_token')->unique();
            $table->string('location');
            $table->timestamps(); // Menyimpan tanggal pembuatan
            $table->timestamp('expired_at'); // Menyimpan tanggal kadaluarsa

            // Menambahkan foreign key constraint
            $table->foreign('auth_id')
                ->references('auth_id')
                ->on('auths')
                ->onDelete('cascade'); // Menghapus data wallet ketika auth dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
