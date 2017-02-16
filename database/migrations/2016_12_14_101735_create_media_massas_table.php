<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaMassasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_massa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('nota_dinas');
            $table->string('sumber');
            $table->date('tgl_berita');
            $table->string('file');
            $table->text('deskripsi');
            $table->string('pengirim')->unsigned();
            $table->timestamps();

            $table->foreign('pengirim')->references('nip')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_massa');
    }
}
