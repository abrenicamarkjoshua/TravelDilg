<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TravelTypeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
            Schema::create('travelType', function (Blueprint $table) {
            $table->increments('id');
            $table->string('travelType');
            
            $table->timestamps();

        });}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::drop('travelType');
    }
}
