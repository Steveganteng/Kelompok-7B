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
        Schema::create('resep', function (Blueprint $table) {
            $table->id('id_resep');
            $table->date('tanggal');
            $table->string('deskripsi')->nullable();
            $table->string('jenis_rawat');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pasien_id');

            // Kolom untuk detail obat per resep (1 baris = 1 obat dalam resep)
            $table->unsignedBigInteger('obat_id');
            $table->integer('jumlah');
            $table->string('aturan_pakai');
            $table->string('dosis')->nullable();

            // Foreign key constraints
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('pasien_id')->references('id_pasien')->on('pasien')->onDelete('cascade');
            $table->foreign('obat_id')->references('id_obat')->on('obat')->onDelete('cascade');

            $table->timestamps();

            // Index untuk mempercepat query berdasarkan resep dan obat
            $table->index(['id_resep', 'obat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('resep');
    }
};
