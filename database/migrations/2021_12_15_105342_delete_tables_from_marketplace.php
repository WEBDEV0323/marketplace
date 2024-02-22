<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteTablesFromMarketplace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('vendors');
        Schema::drop('vendors_product_stocks'); 
        Schema::drop('vendor_order_reciepts');
        Schema::drop('vendor_products');
        Schema::drop('product_cat_shops');
        Schema::drop('product_category_relations');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('vendor_order_reciepts');
        Schema::dropIfExists('vendors_product_stocks');
        Schema::dropIfExists('vendor_products');
        Schema::dropIfExists('product_cat_shops');
        Schema::dropIfExists('product_category_relations');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('vendors');
        // Schema::drop('vendors_product_stocks'); 
        // Schema::drop('vendor_order_reciepts');
        // Schema::drop('vendor_products');
        // Schema::drop('product_cat_shops');
        // Schema::drop('product_category_relations');
        // Schema::dropIfExists('vendors');
        // Schema::dropIfExists('vendor_order_reciepts');
        // Schema::dropIfExists('vendors_product_stocks');
        // Schema::dropIfExists('vendor_products');
        // Schema::dropIfExists('product_cat_shops');
        // Schema::dropIfExists('product_category_relations');
    }
}
