<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produkkesehatan', function (Blueprint $table) {
            $table->id('id_ProdukKesehatan');

            $table->string('kode_produkkesehatan')->unique();
            $table->string('nama_produkkesehatan');
            $table->integer('stok')->default(0);
            $table->integer('harga')->default(0);
            $table->integer('bobot_isi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('distributor_produkkesehatan')->nullable();

            // Kolom foreign key nullable
            $table->unsignedBigInteger('golongan_id')->nullable();
            $table->unsignedBigInteger('penanda_id')->nullable();
            $table->unsignedBigInteger('lokasi_id')->nullable();
            $table->unsignedBigInteger('satuan_id');

            $table->date('tgl_kadaluarsa')->nullable();

            // Foreign key constraints
            $table->foreign('golongan_id')->references('id_golongan')->on('golongan')->nullOnDelete();
            $table->foreign('penanda_id')->references('id_penanda')->on('penanda')->nullOnDelete();
            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi')->nullOnDelete();
            $table->foreign('satuan_id')->references('id_satuan')->on('satuan')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produkkesehatan');
    }
};
