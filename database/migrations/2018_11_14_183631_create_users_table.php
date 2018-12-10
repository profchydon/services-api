<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('username')->unique();
          $table->string('password');
          $table->string('email')->unique();
          $table->string('phone')->unique();
          $table->string('user_type')->nullable();
          $table->integer('active')->default(0);
          $table->softDeletes()->nullable();
          $table->string('api_key')->unique()->nullable();
          $table->string('remember_token');
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
        Schema::dropIfExists('users');
    }
}
