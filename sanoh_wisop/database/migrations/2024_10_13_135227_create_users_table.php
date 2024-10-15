<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Kolom primary key
            $table->string('email', 100)->unique(); // Email pengguna, harus unik
            $table->string('name', 100); // Nama pengguna
            $table->string('password'); // Password pengguna (disarankan untuk dienkripsi)
            $table->enum('role', ['admin', 'warehouse'])->default('warehouse'); // Peran pengguna, defaultnya 'warehouse'
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
