<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TravelApplicationMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('travelApplication', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('status');
            $table->string('remarks');
            $table->string('region');
            $table->string('province');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('sex');
            $table->string('suffix');
              $table->date('birthdate');
            $table->string('positionType');
            $table->string('position');
            $table->string('picture');
            $table->string('mobile');
            $table->string('travelType');
            $table->string('groupDelegation');
            $table->string('sponsor');
            $table->string('benefits');
            $table->string('flightinfo_country');
            $table->string('flightinfo_purpose');
              $table->date('flightinfo_datefrom');
              $table->date('flightinfo_dateto');
            $table->string('flightinfo_natureOfTravelRequested');
            $table->string('flightinfo_travelRequested');

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
        //
         Schema::drop('travelApplication');
    }
}
