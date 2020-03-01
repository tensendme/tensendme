<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('host_user_id');
            $table->unsignedBigInteger('follower_user_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('subscription_id');
            $table->foreign('host_user_id')->references('id')->on('users');
            $table->foreign('follower_user_id')->references('id')->on('users');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
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
        Schema::dropIfExists('follow_subscriptions');
    }
}
