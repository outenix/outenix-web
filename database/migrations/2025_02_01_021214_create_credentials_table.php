<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->unsignedBigInteger('auth_id'); // auth_id yang merujuk ke auths
            $table->string('aplication_name'); // aplication_name 
            $table->bigInteger('secret_id'); // secret_id
            $table->string('secret_key'); // secret_key dengan panjang maksimal 255 karakter
            $table->enum('status', ['active', 'suspend', 'banned'])->default('active'); // Status dengan nilai default 'active'
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
        Schema::dropIfExists('credentials');
    }
}
