<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnFromProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('all_quantity');
            $table->dropColumn('tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->after('product_description');
            $table->integer('all_quantity')->default(0)->after('product_description');
            $table->integer('tags')->default(0)->after('product_description');
        });
    }
}
