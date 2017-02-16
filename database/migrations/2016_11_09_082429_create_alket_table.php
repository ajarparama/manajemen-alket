<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_penjual');
            $table->string('npwp_penjual');
            $table->string('nama_pembeli')->nullable();
            $table->string('npwp_pembeli')->nullable();
            $table->integer('nilai_data');
            $table->string('nop')->nullable();
            $table->string('jns_transaksi');
            $table->date('tanggal')->nullable();
            $table->string('sumber');
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
        Schema::dropIfExists('alket');
    }
}
