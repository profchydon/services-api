<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('escort_id')->unsigned();
          $table->string('video_1')->nullable();
          $table->string('video_2')->nullable();
          $table->string('video_3')->nullable();
          $table->string('video_4')->nullable();
          $table->string('video_5')->nullable();
          $table->string('video_6')->nullable();
          $table->string('video_7')->nullable();
          $table->string('video_8')->nullable();
          $table->string('video_9')->nullable();
          $table->string('video_10')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
