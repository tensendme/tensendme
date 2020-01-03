<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')
                ->references('id')
                ->on('levels');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
            $table->string('device_token');
            $table->string('promo_code');
            $table->string('nickname');
            $table->string('image_path');
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

            $table->dropForeign(['city_id']);
            $table->dropForeign(['level_id']);
            $table->dropColumn('city_id');
            $table->dropColumn('level_id');
            $table->dropColumn('device_token');
            $table->dropColumn('promo_code');
            $table->dropColumn('nickname');
            $table->dropColumn('image_path');
        });
    }
}
