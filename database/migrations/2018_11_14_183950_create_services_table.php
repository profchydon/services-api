<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('escort_id')->unsigned()->unique();
          $table->integer('69 (69 sex position)')->nullable();
          $table->integer('Anal Rimming (Licking anus)')->nullable();
          $table->integer('A-Level (Anal sex)')->nullable();
          $table->integer('BDSM (giving)')->nullable();
          $table->integer('BDSM (receiving)')->nullable();
          $table->integer('Being Filmed')->nullable();
          $table->integer('Body Worship')->nullable();
          $table->integer('Bondage')->nullable();
          $table->integer('CIM (Come in mouth)')->nullable();
          $table->integer('COB (Come on body)')->nullable();
          $table->integer('COF (Come on face)')->nullable();
          $table->integer('Couples')->nullable();
          $table->integer('DFK (Deep french kissing)')->nullable();
          $table->integer('Dinner Dates')->nullable();
          $table->integer('Domination')->nullable();
          $table->integer('Domination (giving)')->nullable();
          $table->integer('Domination (receiving)')->nullable();
          $table->integer('Double Penetration')->nullable();
          $table->integer('Erotic massage')->nullable();
          // $table->integer('Extraball (Having sex multiple times)')->nullable();
          $table->integer('Face Sitting')->nullable();
          $table->integer('Fetish')->nullable();
          $table->integer('Fisting (giving)')->nullable();
          $table->integer('Fisting (receiving)')->nullable();
          $table->integer('Foot Fetish')->nullable();
          $table->integer('French Kissing')->nullable();
          $table->integer('Gang Bang')->nullable();
          $table->integer('GFE (Girlfriend experience)')->nullable();
          $table->integer('Golden shower')->nullable();
          $table->integer('Hand Relief')->nullable();
          $table->integer('Handjob')->nullable();
          $table->integer('Hardsports (giving)')->nullable();
          $table->integer('Hardsports (receiving)')->nullable();
          $table->integer('Humiliation (giving)')->nullable();
          $table->integer('Humiliation (receiving)')->nullable();
          $table->integer('Lap dancing')->nullable();
          $table->integer('LT (Long Time; Usually overnight)')->nullable();
          $table->integer('Massage')->nullable();
          $table->integer('MMF 3somes')->nullable();
          $table->integer('Modelling')->nullable();
          $table->integer('O-Level (Oral sex)')->nullable();
          $table->integer('Oral with condom')->nullable();
          $table->integer('OWO (Oral without condom)')->nullable();
          $table->integer('Parties (Mandatory sex parties)')->nullable();
          $table->integer('Period Play')->nullable();
          $table->integer('Pregnant')->nullable();
          $table->integer('Prostrate Massage')->nullable();
          $table->integer('PSE (Porn Star Experience)')->nullable();
          $table->integer('Receiving Oral')->nullable();
          $table->integer('Rimming (giving)')->nullable();
          $table->integer('Rimming (receiving)')->nullable();
          $table->integer('Role Play & Fantasy')->nullable();
          $table->integer('Sex toys')->nullable();
          $table->integer('Smoking (Fetish)')->nullable();
          $table->integer('Spanking (giving)')->nullable();
          $table->integer('Spanking (receiving)')->nullable();
          $table->integer('Strap on')->nullable();
          $table->integer('Swallow')->nullable();
          $table->integer('Swallow (at discretion)')->nullable();
          $table->integer('Swinging')->nullable();
          $table->integer('Tantric Massage')->nullable();
          $table->integer('Threesome')->nullable();
          $table->integer('Tie & Tease')->nullable();
          $table->integer('Travel Companion')->nullable();
          $table->integer('Uniforms')->nullable();
          $table->integer('Watersports (giving)')->nullable();
          $table->integer('Watersports (receiving)')->nullable();
          $table->integer('Watching football')->nullable();
          $table->integer('Walking')->nullable();
          $table->integer('Beach parties')->nullable();
          $table->integer('Swimming')->nullable();
          $table->integer('Attending corporate parties')->nullable();
          $table->integer('Attending political rallies')->nullable();
          $table->integer('Travelling companion')->nullable();
          $table->integer('Travelling outside the city')->nullable();
          $table->integer('Preparing a meal')->nullable();
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
        Schema::dropIfExists('services');
    }
}
