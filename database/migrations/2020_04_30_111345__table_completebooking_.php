<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableCompletebooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("prevId");
            $table->string("userId");
            $table->string("namaTeam");
            $table->string("date")->nullable();
            $table->string("jam")->nullable();
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
        Schema::dropIfExists('complete_booking');
    }
}
