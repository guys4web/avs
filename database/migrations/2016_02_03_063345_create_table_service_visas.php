<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServiceVisas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_visas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id');
            $table->integer('visa_id');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('service_visas');
    }
}
