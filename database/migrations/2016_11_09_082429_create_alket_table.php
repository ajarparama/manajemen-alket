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
            $table->string('nama');
            $table->string('npwp');
            $table->integer('nilai_data');
            $table->string('jns_transaksi');
            $table->date('tanggal');
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
