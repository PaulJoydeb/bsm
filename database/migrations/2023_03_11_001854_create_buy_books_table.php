<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_books', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->json('checkout_ids')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('total')->nullable();
            $table->integer('process')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->json('json_book_ids')->nullable();
            $table->json('json_book_names')->nullable();
            $table->json('billing_details')->nullable();
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
        Schema::dropIfExists('buy_books');
    }
};
