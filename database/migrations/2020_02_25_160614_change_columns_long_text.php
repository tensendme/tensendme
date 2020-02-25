<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsLongText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->longText('description')->change();
        });
        Schema::table('course_materials', function (Blueprint $table) {
            $table->longText('description')->change();
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->longText('answer')->change();
        });
        Schema::table('meditations', function (Blueprint $table) {
            $table->longText('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
