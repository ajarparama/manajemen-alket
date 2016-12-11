<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLapPPATsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_lapppat', function (Blueprint $table) {
            $table->increments('id');

            $table->string('no_surat');
            $table->string('no_agenda');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('ppat_npwp');
            $table->date('tgl_surat');
            $table->date('tgl_terima');
            $table->integer('jml_data');
            $table->integer('nilai_data');
            $table->integer('jml_alket');
            

            $table->timestamps();
            $table->foreign('ppat_npwp')->references('npwp')->on('tabel_ppat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_lapppat');
    }
}
