<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('resep_obat', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('resep_id');
        $table->unsignedBigInteger('obat_id');
        $table->integer('jumlah');
        $table->string('aturan_pakai');
        $table->string('dosis');
        $table->timestamps();

        $table->foreign('resep_id')->references('id_resep')->on('resep')->onDelete('cascade');
        $table->foreign('obat_id')->references('id_obat')->on('obat')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_obat');
    }
}
