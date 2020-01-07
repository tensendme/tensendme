<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryTypeIdToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->unsignedBigInteger('category_type_id')
                ->nullable(false);

            $table->foreign('category_type_id')
                ->on('category_types')
                ->references('id');

            $table->unsignedBigInteger('parent_category_id')
                ->nullable(true);
            $table->foreign('parent_category_id')
                ->on('categories')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('type');

            $table->dropForeign(['category_type_id']);
            $table->dropColumn(['category_type_id']);

            $table->dropForeign(['parent_category_id']);
            $table->dropColumn('parent_category_id');
        });
    }
}
