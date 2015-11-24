<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttachedDocumentsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //
            Schema::create('attachedDocuments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categories');
            $table->string('location');
            $table->bigInteger('travelApplication_id');
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
         Schema::drop('attachedDocuments');
    }
}
