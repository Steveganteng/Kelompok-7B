<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_peminjaman_table.php
public function up()
{
    Schema::create('peminjaman', function (Blueprint $table) {
        $table->id('id_peminjaman');
        $table->date('tanggal_peminjaman');
        $table->date('tanggal_pengembalian')->nullable();
        $table->string('status');
        $table->string('form_peminjaman');
        $table->timestamps();
    });
}

};
