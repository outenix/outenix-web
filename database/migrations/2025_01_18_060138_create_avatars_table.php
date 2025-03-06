<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->id(); // id
            $table->string('avatar_code')->unique(); // avatar_code
            $table->string('avatar_pack'); // avatar_pack
            $table->enum('avatar_type', ['member', 'premium']); // avatar_type
            $table->string('avatar_file'); // avatar_file
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatars');
    }
};
