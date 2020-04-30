<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId("userId");
            $table->string("namaTeam");
            $table->string("date")->nullable();
            $table->string("jam")->nullable();
            $table->string("image")->nullable();
            $table->string("endDate")->nullable();
            $table->string("tanggal")->nullable();
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
        Schema::dropIfExists('booking');
    }
}
