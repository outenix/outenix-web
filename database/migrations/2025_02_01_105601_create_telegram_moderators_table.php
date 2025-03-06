<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramModeratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_moderators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID user dari telegram_users
            $table->string('name');
            $table->enum('type', ['active', 'suspend', 'banned'])->default('active');
            $table->enum('status', ['developer', 'support'])->default('support');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id') 
                  ->on('telegram_users')
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
        Schema::dropIfExists('telegram_moderators');
    }
}
