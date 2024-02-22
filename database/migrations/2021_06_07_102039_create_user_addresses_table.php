<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('vendor_id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->text('street_address')->nullable();
            $table->text('appartment_address')->nullable();
            $table->string('city')->nullable();
            $table->string('pastcode')->nullable();
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
        Schema::dropIfExists('user_addresses');
    }
}
