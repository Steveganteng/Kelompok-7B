<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_satuan_table.php
public function up()
{
    Schema::create('satuan', function (Blueprint $table) {
        $table->id('id_satuan');
        $table->string('nama_satuan');
        $table->timestamps();
    });
}

};
