<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersDropNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(true)->change();
            $table->string('name')->nullable(true)->change();
            $table->string('nickname')->nullable(true)->change();
            $table->string('device_token')->nullable(true)->change();
            $table->string('promo_code')->nullable(true)->change();
            $table->unsignedBigInteger('city_id')->nullable(true)->change();
            $table->string('image_path')->nullable(true)->change();
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
            $table->string('email')->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
            $table->string('nickname')->nullable(false)->change();
            $table->string('device_token')->nullable(false)->change();
            $table->string('promo_code')->nullable(false)->change();
            $table->unsignedBigInteger('city_id')->nullable(false)->change();
            $table->string('image_path')->nullable(false)->change();
        });
    }
}
