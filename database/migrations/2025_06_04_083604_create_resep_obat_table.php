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
            $table->id();  // Auto-incrementing ID for the pivot table
            $table->unsignedBigInteger('resep_id');  // Foreign key to the resep table
            $table->unsignedBigInteger('obat_id');  // Foreign key to the obat table
            $table->integer('jumlah');
            $table->string('aturan_pakai');
            $table->string('dosis');
            $table->string('status')->default('belum diberikan'); // Add status column with default value
            $table->timestamps();

            // Foreign keys
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
