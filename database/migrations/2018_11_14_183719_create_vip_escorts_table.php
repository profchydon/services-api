<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_escorts', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('escort_id')->unique()->unsigned();
          $table->uuid('escort_vip_id')->unique();
          $table->foreign('escort_id')->references('id')->on('escorts')->onDelete('cascade');
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
        Schema::dropIfExists('vip_escorts');
    }
}
