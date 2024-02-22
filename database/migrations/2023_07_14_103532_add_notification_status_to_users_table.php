<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationStatusToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('newsletter_notification_status', ['No','Yes'])->default('No');
            $table->enum('promotions_notification_status', ['No','Yes'])->default('No');
            $table->enum('discounts_notification_status', ['No','Yes'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('newsletter_notification_status');
            $table->dropColumn('promotions_notification_status');
            $table->dropColumn('discounts_notification_status');
        });
    }
}
