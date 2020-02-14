<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodeAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_code_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('host_user_id')
                ->nullable(false);
            $table->foreign('host_user_id')
                ->on('users')
                ->references('id');

            $table->string('promo_code')
                ->nullable(false);
            $table->unsignedInteger('type')
                ->nullable(false);

            $table->unsignedBigInteger('follower_user_id')
                ->nullable(true);
            $table->foreign('follower_user_id')
                ->on('users')
                ->references('id');

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
        Schema::dropIfExists('promo_code_analytics');
    }
}
