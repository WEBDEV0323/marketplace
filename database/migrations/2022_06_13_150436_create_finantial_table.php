<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinantialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finantials', function (Blueprint $table) {
            $table->id();
            $table->string('non_current_name')->nullable();
            $table->integer('non_current_amount')->nullable();
            $table->date('non_current_date');
            $table->string('non_current_note')->nullable();

            $table->string('current_name')->nullable();
            $table->integer('current_amount')->nullable();
            $table->date('current_date');
            $table->string('current_note')->nullable();

            $table->string('liblaties_name')->nullable();
            $table->integer('liblaties_amount')->nullable();
            $table->date('liblaties_date');
            $table->string('liblaties_note')->nullable();

            $table->string('long_liblaties_name')->nullable();
            $table->integer('long_liblaties_amount')->nullable();
            $table->date('long_liblaties_date');
            $table->string('long_liblaties_note')->nullable();

            $table->string('capital_name')->nullable();
            $table->integer('capital_amount')->nullable();
            $table->date('capital_date');
            $table->string('capital_note')->nullable();
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
        Schema::dropIfExists('finantials');
    }
}
