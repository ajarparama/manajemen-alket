<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePPATsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_ppat', function (Blueprint $table) {

            $table->string('nama');
            $table->string('npwp');
            $table->string('alamat');
            $table->string('kabupaten');
            $table->string('no_telp')->nullable();
            $table->string('ar_nip')->nullable();

            $table->timestamps();
            $table->primary('npwp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_ppat');
    }
}
