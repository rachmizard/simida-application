<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->increments('nis');
            $table->bigInteger('nik');
            $table->string('nama_santri');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('provinsi');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('nama_ortu');
            $table->string('nama_wali');
            $table->string('no_telp');
            $table->string('pendidikan_terakhir');
            $table->string('asrama_id');
            $table->string('kobong_id');
            $table->integer('tingkat_id');
            $table->string('kelas_id');
            $table->date('tgl_masuk');
            $table->string('himpunan');
            $table->string('dewan_id');
            $table->string('pensantren_sebelumnya');
            $table->string('foto');
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
        Schema::dropIfExists('santri');
    }
}
