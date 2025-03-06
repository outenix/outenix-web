<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->unsignedbigInteger('auth_id'); // auth_id yang merujuk ke auths
            $table->string('wallet_id')->unique(); // wallet_id unik
            $table->decimal('balance', 15, 2)->default(0); // Saldo dompet (default 0)
            $table->timestamps(); // Kolom created_at dan updated_at

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
        Schema::dropIfExists('wallets');
    }
}