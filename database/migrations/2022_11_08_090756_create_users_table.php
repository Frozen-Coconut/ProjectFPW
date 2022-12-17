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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 40)->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password', 256);
            $table->integer('occupational_status')->default(0)->comment('0 = pelajar, 1 = mahasiswa, 2 = pekerja, 3 = yang lainnya');
            $table->integer('role')->default(0)->comment('0 = user, 1 = admin');
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
};
