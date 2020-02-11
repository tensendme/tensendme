<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsCourseMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_materials', function (Blueprint $table) {
            $table->string('img_path')->nullable(true);
            $table->integer('duration_time')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_materials', function (Blueprint $table) {
            $table->dropColumn(['img_path', 'duration_time']);
        });
    }
}
