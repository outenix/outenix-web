<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel accounts.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->unsignedBigInteger('auth_id'); // Kolom auth_id
            $table->string('username'); // Kolom username
            $table->string('name'); // Kolom name
            $table->string('phone')->nullable(); // Kolom phone
            $table->date('birthday'); // Kolom birthday
            $table->enum('gender', ['male', 'female', 'other']); // Kolom gender (menambahkan 'other')
            $table->enum('status', ['member', 'premium']); // Kolom status (menambahkan 'member' dan 'premium')
            $table->string('profile_picture')->nullable(); // Kolom profile_picture
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('auth_id')
                ->references('auth_id')
                ->on('auths')
                ->onDelete('cascade'); // Menghapus data accounts ketika auth dihapus
        });
    }

    /**
     * Balikkan perubahan yang dilakukan oleh migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
