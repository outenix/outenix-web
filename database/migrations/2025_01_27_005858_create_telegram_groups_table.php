<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_groups', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('group_id')->unique(); // Unique group ID
            $table->unsignedBigInteger('group_owner')->nullable(); // ID of the group owner
            $table->string('group_name'); // Name of the group
            $table->text('group_description')->nullable(); // Optional description
            $table->string('group_link')->nullable(); // Optional link to the group
            $table->string('group_profile_picture')->nullable(); // Profile picture of the group
            $table->integer('group_admin_count')->default(0); // Number of admins
            $table->integer('group_member_count')->default(0); // Number of members
            $table->integer('group_member_block_count')->default(0); // Number of blocked members
            $table->integer('group_chat_count')->default(0); // Number of chats
            $table->enum('group_status', ['active', 'suspend', 'banned', 'scam'])->default('active'); // Group status enum
            $table->enum('group_type', ['private', 'public'])->default('private'); // Group type enum
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
        Schema::dropIfExists('telegram_groups');
    }
}
