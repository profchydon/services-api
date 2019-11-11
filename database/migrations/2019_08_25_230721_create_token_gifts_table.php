<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beneficiary')->unsigned();
            $table->string('benefactor')->nullable();
            $table->string('benefactor_name');
            $table->string('amount');
            $table->string('tx_hash');
            $table->foreign('beneficiary')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('token_gifts');
    }
}
