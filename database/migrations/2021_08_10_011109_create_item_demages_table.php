<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDemagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_demages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->onDelete('cascade');
            $table->integer('amount')->default(0);
            $table->date('damage_date');
            $table->foreignId('place_id')->onDelete('cascade');
            $table->mediumText('notes');
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
        Schema::dropIfExists('item_demages');
    }
}
