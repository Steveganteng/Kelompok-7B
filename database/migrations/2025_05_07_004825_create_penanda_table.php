<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_penanda_table.php
public function up()
{
    Schema::create('penanda', function (Blueprint $table) {
        $table->id('id_penanda');
        $table->string('nama_penanda');
        $table->timestamps();
    });
}

};
