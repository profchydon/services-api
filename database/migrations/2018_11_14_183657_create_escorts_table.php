<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escorts', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->string('profile_image')->nullable();
        $table->string('gender')->nullable();
        $table->string('country')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
        $table->string('date_of_birth')->nullable();
        $table->string('ethnicity')->nullable();
        $table->string('bust_size')->nullable();
        $table->string('height')->nullable();
        $table->string('weight')->nullable();
        $table->string('build')->nullable();
        $table->string('looks')->nullable();
        $table->string('availability')->nullable();
        $table->string('smoker')->nullable();
        $table->longText('about')->nullable();
        $table->string('sex_orientation')->nullable();
        $table->string('language')->nullable();
        $table->integer('verified')->default(0)->nullable();
        $table->string('vip')->default(0)->nullable();
        $table->string('views')->nullable();
        $table->string('incall_1hr')->nullable();
        $table->string('incall_1dy')->nullable();
        $table->string('incall_overnight')->nullable();
        $table->string('incall_1wk')->nullable();
        $table->string('outcall_1hr')->nullable();
        $table->string('outcall_1dy')->nullable();
        $table->string('outcall_overnight')->nullable();
        $table->string('outcall_1wk')->nullable();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('escorts');
    }
}
