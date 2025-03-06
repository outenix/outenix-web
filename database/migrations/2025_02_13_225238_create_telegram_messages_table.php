<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('telegram_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->integer('message_text')->default(0);
            $table->integer('message_photo')->default(0);
            $table->integer('message_video')->default(0);
            $table->integer('message_sticker')->default(0);
            $table->integer('message_gif')->default(0);
            $table->integer('message_other')->default(0);
            $table->timestamp('last_message')->nullable();
            $table->timestamps();

            $table->index(['group_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('telegram_messages');
    }
};
