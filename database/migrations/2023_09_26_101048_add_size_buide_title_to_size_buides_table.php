<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeBuideTitleToSizeBuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('size_guides', function (Blueprint $table) {
            $table->longText('guide_size_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('size_guides', function (Blueprint $table) {
            $table->dropColumn('guide_size_title');
        });
    }
}
