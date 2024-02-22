<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalPriceCartItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Remove row_id column
            $table->dropColumn('row_id');

            // Add total_price column
            $table->bigInteger('total_price')->nullable();
        });
    }

    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Add back the removed column if needed
            $table->string('row_id');

            // Remove total_price column
            $table->dropColumn('total_price');
        });
    }

}
