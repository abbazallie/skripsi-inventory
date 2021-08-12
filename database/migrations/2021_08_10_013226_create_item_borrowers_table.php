<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_borrowers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('contact_id');
            $table->integer('amount')->default(1);
            $table->unsignedBigInteger('place_id')->nullable();
            $table->enum('status',['dipinjam','selesai']);
            $table->date('borrow_date')->nullable();
            $table->date('return_date')->nullable();
            $table->text('borrow_notes')->nullable();
            $table->text('return_notes')->nullable();
            $table->json('item_details')->nullable();
            $table->json('place_detail')->nullable();
            $table->json('contact_detail')->nullable();
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
        Schema::dropIfExists('item_borrowers');
    }
}
