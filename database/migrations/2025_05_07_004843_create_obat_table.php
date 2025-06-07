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
        Schema::create('obat', function (Blueprint $table) {
            $table->id('id_obat');

            // 🔑 Tambahkan kode obat unik
            $table->string('kode_obat')->unique();

            // Pisah nama: dagang & generik
            $table->string('nama_dagang_obat');
            $table->string('nama_obat');

            $table->integer('stok');
            $table->string('deskripsi');
            $table->integer('harga');
            $table->integer('bobot_isi');
            $table->string('gambar');

            // Tambah distributor
            $table->string('distributor_obat');

            // Foreign keys
            $table->unsignedBigInteger('golongan_id');
            $table->unsignedBigInteger('penanda_id');
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('satuan_id');

            $table->date('tgl_kadaluarsa');

            // Constraints
            $table->foreign('golongan_id')
                  ->references('id_golongan')->on('golongan')
                  ->onDelete('cascade');
            $table->foreign('penanda_id')
                  ->references('id_penanda')->on('penanda')
                  ->onDelete('cascade');
            $table->foreign('lokasi_id')
                  ->references('id_lokasi')->on('lokasi')
                  ->onDelete('cascade');
            $table->foreign('satuan_id')
                  ->references('id_satuan')->on('satuan')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('obat');
    }
};

