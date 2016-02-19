<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_requirements', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('visa_id');
            $table->integer('requirement_id');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('visa_requirements');
    }
}
