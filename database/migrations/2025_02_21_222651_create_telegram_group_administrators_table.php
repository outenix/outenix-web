<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('telegram_group_administrators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->string('administrator_first_name')->nullable();
            $table->string('administrator_last_name')->nullable();
            $table->string('administrator_username')->nullable();
            $table->enum('administrator_type', ['user', 'bot']);
            $table->enum('administrator_status', ['owner', 'administrator']);
            $table->timestamps();

            $table->foreign('group_id')
                  ->references('group_id') 
                  ->on('telegram_groups') 
                  ->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telegram_group_administrators');
    }
};
