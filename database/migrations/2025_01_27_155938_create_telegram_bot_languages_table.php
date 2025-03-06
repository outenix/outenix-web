<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramBotLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_bot_languages', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('user_id'); // ID dari pengguna
            $table->string('bot_language_code', 10); // Kode bahasa pengguna (misalnya, 'en', 'id')
            $table->timestamps(); // created_at dan updated_at

            // Menambahkan foreign key constraint untuk menghubungkan dengan telegram_bots
            $table->foreign('user_id')
                  ->references('user_id') // Merujuk ke kolom bot_id di tabel telegram_bots
                  ->on('telegram_users') // Nama tabel telegram_bots
                  ->onDelete('cascade'); // Menghapus data di telegram_bot_languages jika bot_id di telegram_bots dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_bot_languages');
    }
}
