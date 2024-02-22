<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('text_color');
            $table->string('bg_color');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
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
        Schema::dropIfExists('news_tickers');
    }
}
