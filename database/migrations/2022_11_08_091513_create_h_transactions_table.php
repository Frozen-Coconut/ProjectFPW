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
        Schema::create('h_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->bigInteger('amount');
            $table->string('transaction_method');
            $table->integer('status')->default(0)->comment('0 = pembayaran sedang dalam proses, 1 = pembayaran berhasil, 2 = pembayaran gagal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_transactions');
    }
};
