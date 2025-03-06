<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_accounts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('auth_id'); // Foreign key ke tabel auths
            $table->string('column_changed'); // Kolom yang diubah
            $table->text('old_value')->nullable(); // Nilai lama
            $table->text('new_value')->nullable(); // Nilai baru
            $table->timestamps();  // Waktu perubahan

            // Foreign key
            $table->foreign('auth_id')
                ->references('auth_id')
                ->on('auths')
                ->onDelete('cascade'); // Hapus log jika user dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_accounts');
    }
}
