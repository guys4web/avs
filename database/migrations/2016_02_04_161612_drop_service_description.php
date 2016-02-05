<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropServiceDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function ($table) {
            
            $table->dropColumn('description');

            $table->integer('min_process');
            $table->integer('max_process');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->text('description');

        $table->dropColumn('min_process');
        $table->dropColumn('max_process');
    }
}
