<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('user_id')->unique(); // Unique Telegram user ID
            $table->string('user_firstname')->nullable(); // User's first name
            $table->string('user_lastname')->nullable(); // User's last name
            $table->string('user_username')->nullable(); // User's username
            $table->string('user_language_code', 10)->nullable(); // Language code (e.g., en, id)
            $table->boolean('user_is_premium')->default(false); // Whether the user is a premium user
            $table->enum('user_status', ['active', 'suspend', 'banned'])->default('active'); // User status
            $table->string('user_profile_picture')->nullable(); // Profile picture URL
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
        Schema::dropIfExists('telegram_users');
    }
}
