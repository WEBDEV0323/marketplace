<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->integer('vendor_id')->default(0);
            $table->integer('vendor_product_id')->default(0);
            $table->integer('quantity')->default(0);
            $table->bigInteger('order')->default(0);
            $table->bigInteger('flags')->default(0);
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
        Schema::dropIfExists('vendors_product_stocks');
    }
}
