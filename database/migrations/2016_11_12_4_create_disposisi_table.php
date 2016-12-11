<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('alket_id')->unsigned();
            $table->integer('seksi_id')->unsigned();

            $table->timestamps();

            $table->foreign('alket_id')->references('id')->on('alket')->onDelete('cascade');
            $table->foreign('seksi_id')->references('id')->on('tabel_seksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi');
    }
}
