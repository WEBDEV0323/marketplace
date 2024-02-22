<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_guides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('brand_id')->default(0); ;
            $table->bigInteger('shop_category_id')->default(0); ;
            $table->bigInteger('gender')->default(0);
            $table->bigInteger('size_id')->default(0);
            $table->longText('guide_size')->nullable();
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
        Schema::dropIfExists('size_guides');
    }
}
