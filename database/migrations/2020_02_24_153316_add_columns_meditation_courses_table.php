<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsMeditationCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('trailer')->nullable(true);
        });

        Schema::table('meditations', function (Blueprint $table) {
            $table->double('scale')->default(0);
            $table->dropColumn('duration_time');
        });

        Schema::table('course_materials', function (Blueprint $table) {
            $table->tinyInteger('free')->default(0);
            $table->string('description')->nullable(true);
            $table->integer('view_count');
        });

        Schema::create('meditation_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('meditation_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('meditation_id')->references('id')->on('meditations');
            $table->double('scale');
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
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['trailer']);
        });
        Schema::table('meditations', function (Blueprint $table) {
            $table->dropColumn('scale');
        });
        Schema::table('course_materials', function (Blueprint $table) {
            $table->dropColumn(['free', 'view_count', 'description']);
        });
        Schema::dropIfExists('meditation_ratings');


    }
}
