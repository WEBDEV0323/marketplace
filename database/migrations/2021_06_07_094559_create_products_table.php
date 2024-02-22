<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('vendor_id');
            $table->string('product_name')->nullable();
            $table->string('product_description')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->bigInteger('regular_price')->nullable();
            $table->bigInteger('sale_price')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('flags')->default(0);
            $table->date('expiry_date')->default(null)->comment('seller products expiry date of listing');
            $table->boolean('expiry_extended')->default(0)->comment('0 => false , 1 -> true');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
