<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_lokasi_table.php
    public function up()
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id('id_lokasi');          
            $table->string('area');
            $table->string('rak');
            $table->integer('baris');
            $table->integer('kolom');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lokasi');
    }

};
