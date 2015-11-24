<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProvincesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //
            Schema::create('provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('region_id');
            $table->string('province');
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
        Schema::drop('provinces');
    }
}
