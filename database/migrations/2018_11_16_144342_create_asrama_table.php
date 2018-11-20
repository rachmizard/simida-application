<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asrama', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('kategori_asrama', ['putra', 'putri', 'mutawasilin']);
            $table->string('nama_asrama');
            $table->string('roisam_asrama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asrama');
    }
}
