<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
          	
            $table->integer('product_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('delivery_charges')->nullable();
            $table->json('quantity')->nullable();
            $table->bigInteger('total_price')->nullable();    
            $table->bigInteger('size_id')->nullable(); 
            $table->bigInteger('variation_id')->nullable(); 
            
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
        Schema::dropIfExists('cart');
    }
}
