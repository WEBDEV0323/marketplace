<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("buying_card_no")->nullable();
            $table->string("buying_expiry_year")->nullable();
            $table->string("buying_expiry_month")->nullable();
            $table->string("buying_cvc")->nullable();



            $table->string("selling_card_no")->nullable();
            $table->string("selling_expiry_year")->nullable();
            $table->string("selling_expiry_month")->nullable();
            $table->string("selling_cvc")->nullable();
            $table->string("selling_paypal_email")->nullable();



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
        Schema::dropIfExists('cards');
    }
}
