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
            $table->string('kode_alat')->unique();
            $table->string('distributor_alat');
            $table->string('jenis');
            $table->integer('stok');
            $table->string('gambar');
            $table->unsignedBigInteger('lokasi_id');
            $table->string('status');

            // Define foreign key constraints explicitly
            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi')->onDelete('cascade');

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
