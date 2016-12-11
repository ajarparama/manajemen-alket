<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryLapPPATsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_lapppat', function (Blueprint $table) {
            $table->increments('id');

            $table->string('no_surat');
            $table->integer('no_urut');
            $table->string('no_akta');
            $table->date('tgl_akta');
            $table->string('btk_perbuatan');
            $table->string('penjual_nama');
            $table->text('penjual_alamat');
            $table->string('penjual_npwp');
            $table->string('penjual_ar');
            $table->string('penerima_nama');
            $table->text('penerima_alamat');
            $table->string('penerima_npwp');
            $table->string('penerima_ar');
            $table->string('jenis_nomor');
            $table->string('letak_tanah');
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
            $table->integer('hrg_transaksi');
            $table->string('nop');
            $table->integer('njop');
            $table->date('tgl_ssp');
            $table->integer('nilai_ssp');
            $table->date('tgl_ssb');
            $table->integer('nilai_ssb');
            $table->string('keterangan');
            $table->text('uraian');
            $table->string('no_alket');

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
        Schema::dropIfExists('entry_lapppat');
    }
}
