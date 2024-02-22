<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->id()->change();
        $table->dropColumn('cookies_id');
     });
}

public function down()
{
    Schema::table('cart_items', function (Blueprint $table) {
        $table->dropColumn('id');
        $table->dropColumn('row_id');
        $table->dropColumn('product_id');
        $table->dropColumn('user_id');
        $table->dropColumn('cookies_id');
        $table->timestamps();
    });
}
 
}
