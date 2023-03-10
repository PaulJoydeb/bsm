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
        Schema::create('user_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('country')->nullable();
            $table->string('primary_address')->nullable();
            $table->string('secondary_address')->nullable();
            $table->string('town_or_city')->nullable();
            $table->string('country_or_state')->nullable();
            $table->integer('postcode_or_zip')->nullable();
            $table->integer('phone')->nullable();
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
        Schema::dropIfExists('user_records');
    }
};
