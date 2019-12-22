<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('amount');
            $table->unsignedBigInteger('balance_id');
            $table->foreign('balance_id')
                ->references('id')
                ->on('balances');
            $table->unsignedBigInteger('follower_id');
            $table->foreign('follower_id')
                ->references('id')
                ->on('followers');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');
            $table->unsignedBigInteger('history_type_id');
            $table->foreign('history_type_id')
                ->references('id')
                ->on('history_types');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses');
            $table->unsignedBigInteger('subscription_id');
            $table->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions');
            $table->unsignedBigInteger('withdrawal_request_id');
            $table->foreign('withdrawal_request_id')
                ->references('id')
                ->on('withdrawal_requests');
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
        Schema::dropIfExists('histories');
    }
}
