<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVisas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');            
            $table->string('max_stay');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('visas');
    }
}
