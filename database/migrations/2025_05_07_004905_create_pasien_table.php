<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_pasien_table.php
public function up()
{
    Schema::create('pasien', function (Blueprint $table) {
        $table->id('id_pasien');
        $table->string('nama_pasien');
        $table->date('tanggal_lahir');
        $table->string('jenis_kelamin');
        $table->string('alamat');
        $table->string('telepon');
        $table->timestamps();
    });
}

};
