<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('escort_id')->unsigned();
          $table->string('image_1')->nullable();
          $table->string('image_2')->nullable();
          $table->string('image_3')->nullable();
          $table->string('image_4')->nullable();
          $table->string('image_5')->nullable();
          $table->string('image_6')->nullable();
          $table->string('image_7')->nullable();
          $table->string('image_8')->nullable();
          $table->string('image_9')->nullable();
          $table->string('image_10')->nullable();
          $table->string('image_11')->nullable();
          $table->string('image_12')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('images');
    }
}
