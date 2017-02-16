<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSIUPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_siup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_izin');
            $table->string('jns_izin');
            $table->string('nama_perusahaan');
            $table->string('npwp_perusahaan');
            $table->string('nama_pemilik');
            $table->string('npwp_pemilik');
            $table->string('alamat');
            $table->integer('tahun');
            $table->string('nip');
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_siup');
    }
}
