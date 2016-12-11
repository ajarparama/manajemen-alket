<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWajibPajaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wajib_pajak', function (Blueprint $table) {

            $table->string('npwp');
            $table->string('nama');
            $table->string('alamat');
            $table->string('ar_nip');

            $table->timestamps();
            $table->primary('npwp');
            $table->foreign('ar_nip')->references('nip')->on('tabel_ar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wajib_pajak');
    }
}
