<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeditationAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meditation_audios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('meditation_id');
            $table->unsignedBigInteger('audio_language_id');
            $table->unsignedBigInteger('author_id');
            $table->foreign('meditation_id')->on('meditations')->references('id');
            $table->foreign('audio_language_id')->on('audio_languages')->references('id');
            $table->foreign('author_id')->on('users')->references('id');
            $table->integer('duration');
            $table->tinyInteger('free')->default(1);
            $table->string('img_path')->nullable(true);
            $table->string('audio_path');
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
        Schema::dropIfExists('meditation_audios');
    }
}
