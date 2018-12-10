<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('escort_id')->unsigned();
          $table->string('reviewer');
          $table->longText('message');
          $table->foreign('reviewer')->references('username')->on('users');
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
        Schema::dropIfExists('reviews');
    }
}
