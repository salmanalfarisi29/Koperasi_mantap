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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_nama');
            $table->string('pegawai_jabatan');
            $table->integer('pegawai_umur');
            $table->string('pegawai_alamat');
        });
    }


    // 'pegawai_nama' => 'Joni',
    //     	'pegawai_jabatan' => 'Web Designer',
    //     	'pegawai_umur' => 25,
    //     	'pegawai_alamat' => 'Jl. Panglateh'
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
