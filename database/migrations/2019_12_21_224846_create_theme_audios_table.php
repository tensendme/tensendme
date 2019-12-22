<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_audios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('audio_path');
            $table->unsignedBigInteger('audio_language_id');
            $table->foreign('audio_language_id')
                ->references('id')
                ->on('audio_languages');
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
        Schema::dropIfExists('theme_audios');
    }
}
