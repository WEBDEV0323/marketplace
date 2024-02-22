<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('coupon_code')->unique();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_coupon')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('added_by')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
