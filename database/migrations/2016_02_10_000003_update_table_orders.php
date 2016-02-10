<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer("user_id");
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->double("unit_price",8,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('orders', function (Blueprint $table) {
          $table->dropColumn("user_id");
      });

      Schema::table('cart_items', function (Blueprint $table) {
          $table->dropColumn("unit_price",8,2)->default(0);
      });
    }
}
