<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PositionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('positionType');
            $table->string('position');

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

         Schema::drop('position');
    }
}
