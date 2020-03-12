<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->unsignedBigInteger('follower_id')->nullable(true)->change();
            $table->unsignedBigInteger('subscription_id')->nullable(true)->change();
            $table->unsignedBigInteger('transaction_id')->nullable(true)->change();
            $table->unsignedBigInteger('course_id')->nullable(true)->change();
            $table->unsignedBigInteger('withdrawal_request_id')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
//            $table->unsignedBigInteger('follower_id')->nullable(false)->change();
//            $table->unsignedBigInteger('subscription_id')->nullable(false)->change();
//            $table->unsignedBigInteger('transaction_id')->nullable(false)->change();
//            $table->unsignedBigInteger('course_id')->nullable(false)->change();
//            $table->unsignedBigInteger('withdrawal_request_id')->nullable(false)->change();
        });
    }
}
