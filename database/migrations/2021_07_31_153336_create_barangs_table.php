<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('brg_id');
            $table->bigInteger('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')
            ->onDelete('cascade');
            $table->string('kode_brg',20);
            $table->string('nama_brg');
            $table->integer('jml_brg');
            $table->string('tempat_brg');
            $table->time('tgl_masuk');
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
        Schema::dropIfExists('barang');
    }
}
