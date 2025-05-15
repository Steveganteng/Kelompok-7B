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
        Schema::create('produkkesehatan', function (Blueprint $table) {
            $table->id('id_ProdukKesehatan');
            $table->string('nama');
            $table->integer('stok')->default(0);
            $table->string('gambar')->nullable();
            $table->foreignId('lokasi_id')->nullable()->constrained('lokasi', 'id_lokasi')->nullOnDelete();
            $table->foreignId('satuan_id')->constrained('satuan', 'id_satuan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('produkkesehatan');
    }
};
