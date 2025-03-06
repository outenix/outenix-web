<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramGroupLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_group_languages', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('group_id'); // ID dari grup
            $table->string('group_language_code', 10); // Kode bahasa grup (misalnya, 'en', 'id')
            $table->timestamps(); // created_at dan updated_at

            $table->foreign('group_id')
                  ->references('group_id') 
                  ->on('telegram_groups') 
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_group_languages');
    }
}
