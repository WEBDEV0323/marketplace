<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorOrderRecieptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_order_reciepts', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('vendor_product_id');
            $table->integer('paid_amount');
            $table->integer('due_amount');
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
        Schema::dropIfExists('vendor_order_reciepts');
    }
}
