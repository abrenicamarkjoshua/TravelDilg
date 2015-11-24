<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('accountType_id');
            $table->string('accountStatus');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('suffix');


            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
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
         Schema::drop('users');
    }
}
