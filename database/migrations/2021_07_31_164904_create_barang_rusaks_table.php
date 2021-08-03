<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangRusaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_rusak', function (Blueprint $table) {
            $table->bigIncrements('id_brg_rsk');
            $table->bigInteger('brg_id')->unsigned();
            $table->foreign('brg_id')->references('brg_id')->on('barang');
            $table->string('nama_brg_rsk');
            $table->integer('jml_brg_rsk');
            $table->time('tgl_rsk');
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
        Schema::dropIfExists('barang_rusak');
    }
}
