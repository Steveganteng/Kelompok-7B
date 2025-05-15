<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('alatkesehatan', function (Blueprint $table) {
            $table->id('id_AlatKesehatan');
            $table->string('nama');
            $table->string('jenis');
            $table->integer('stok');
            $table->string('deskripsi');
            $table->string('gambar');
            $table->unsignedBigInteger('golongan_id');
            $table->unsignedBigInteger('penanda_id');
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('satuan_id');
            $table->string('status');

            // Define foreign key constraints explicitly
            $table->foreign('golongan_id')->references('id_golongan')->on('golongan')->onDelete('cascade');
            $table->foreign('penanda_id')->references('id_penanda')->on('penanda')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi')->onDelete('cascade');
            $table->foreign('satuan_id')->references('id_satuan')->on('satuan')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('alatkesehatan');
    }
};
