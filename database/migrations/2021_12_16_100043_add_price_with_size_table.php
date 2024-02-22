<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceWithSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sizes', function (Blueprint $table) {
          $table->double('regular_price')->default(0)->after('size_id');
          $table->double('sale_price')->default(0)->after('regular_price');
          $table->double('discount')->default(0)->after('sale_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sizes', function (Blueprint $table) {
            $table->dropColumn('regular_price');
            $table->dropColumn('sale_price');
            $table->dropColumn('discount');
        });
    }
}
