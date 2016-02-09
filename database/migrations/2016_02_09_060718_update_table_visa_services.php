<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableVisaServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_visas', function(Blueprint $table)
        {
            $table->decimal('price', 8, 2);

        });

        Schema::table('visas', function(Blueprint $table)
        {
            $table->dropColumn('price');

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
    }
}
