<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // database/migrations/xxxx_xx_xx_xxxxxx_create_obat_table.php
 public function up()
 {
     Schema::create('obat', function (Blueprint $table) {
         $table->id('id_obat');
         $table->string('NamaObat');
         $table->integer('stok');
         $table->string('deskripsi');
         $table->integer('harga');
         $table->integer('bobot_isi');
         $table->string('gambar');
         $table->unsignedBigInteger('golongan_id'); // Ensure unsignedBigInteger for foreign key
         $table->unsignedBigInteger('penanda_id');
         $table->unsignedBigInteger('lokasi_id');
         $table->unsignedBigInteger('satuan_id');

         // Add foreign key constraints
         $table->foreign('golongan_id')->references('id_golongan')->on('golongan')->onDelete('cascade');
         $table->foreign('penanda_id')->references('id_penanda')->on('penanda')->onDelete('cascade');
         $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi')->onDelete('cascade');
         $table->foreign('satuan_id')->references('id_satuan')->on('satuan')->onDelete('cascade');

         $table->timestamps();
     });
 }


};
