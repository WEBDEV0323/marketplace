<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorProductCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            $table->integer('category_id')->default(0)->after('product_id');
            $table->integer('brand_id')->default(0)->after('category_id');
            $table->integer('product_type')->default(0)->after('brand_id');
            $table->string('image')->nullable()->after('brand_id');
            $table->double('price')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('brand_id');
            $table->dropColumn('product_type');
            $table->dropColumn('image');
            $table->dropColumn('price');
        });
    }
}
