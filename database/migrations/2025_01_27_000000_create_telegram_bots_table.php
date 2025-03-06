<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_bots', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('bot_id')->unique(); // Unique bot ID
            $table->unsignedBigInteger('owner_id'); // ID of the bot owner
            $table->string('bot_token')->unique(); // Unique bot token
            $table->string('bot_username'); // Bot username
            $table->string('bot_name'); // Bot name
            $table->enum('type', ['private', 'group', 'channel'])->default('private'); // Bot type
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active'); // Bot status
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_bots');
    }
}
