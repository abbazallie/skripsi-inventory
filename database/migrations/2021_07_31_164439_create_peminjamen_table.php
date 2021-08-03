<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('pmj_id');
            $table->bigInteger('brg_id')->unsigned();
            $table->foreign('brg_id')->references('brg_id')->on('barang');
            $table->string('nama_pmj');
            $table->string('nama_brg_pjm');
            $table->integer('jml_brg_pmj');
            $table->time('tgl_pjm');
            $table->text('tempat_brg_pjm');
            $table->text('keterangan');
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
        Schema::dropIfExists('peminjaman');
    }
}
