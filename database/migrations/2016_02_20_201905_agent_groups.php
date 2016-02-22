<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgentGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_groups', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('agent_id');
            $table->integer('group_id');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::drop('agent_groups');
    }
}
