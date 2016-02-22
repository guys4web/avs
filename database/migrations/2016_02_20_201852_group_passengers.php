<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupPassengers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_passengers', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('group_id');
            $table->integer('passenger_id');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('group_passengers');
    }
}
