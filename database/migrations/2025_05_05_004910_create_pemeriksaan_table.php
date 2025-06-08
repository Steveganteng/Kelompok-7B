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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id('id_pemeriksaan');
            $table->unsignedBigInteger('pasien_id');  // Ensure matching data type with 'id_pasien' in 'pasien'
            $table->date('mulai_diwawati');
            $table->text('anamnesis');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->float('suhu_tubuh');
            $table->float('saturasi_oksigen');
            $table->integer('tekanan_darah_sistolik');
            $table->integer('tekanan_darah_diastolik');
            $table->text('diagnosa');
            $table->text('pemeriksaan_penunjang')->nullable();
            $table->text('obat_dikonsumsi_sebelumnya')->nullable();
            $table->float('nadi');
            $table->float('laju_pernapasan');

            // Define foreign key constraint explicitly
            $table->foreign('pasien_id')->references('id_pasien')->on('pasien')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
