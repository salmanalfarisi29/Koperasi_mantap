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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id_transaksi');
            $table->string('email_pembeli');
            $table->integer('jumlah_beli');
            $table->bigInteger('harga');
            $table->bigInteger('total_harga');
            $table->bigInteger('uang_pembayaran')->default(0);
            $table->bigInteger('kembalian');
            $table->integer('id_user');
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
        Schema::dropIfExists('transactions');
    }
};
