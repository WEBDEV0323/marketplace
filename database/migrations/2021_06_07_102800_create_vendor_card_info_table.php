<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCardInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_card_info', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->bigInteger('card_number')->nullable();
            $table->string('expire_year')->nullable();
            $table->string('expire_month')->nullable();
            $table->string('CCV')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('vendor_card_info');
    }
}
