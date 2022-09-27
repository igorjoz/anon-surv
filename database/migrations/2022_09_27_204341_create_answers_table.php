<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            $table->string('content')->nullable();
            $table->boolean('is_affirmative')->nullable();

            // * relation with CompletedSurvey model
            $table->foreignId('completed_survey_id');
            $table->foreign('completed_survey_id')->references('id')->on('completed_surveys')->onDelete('cascade');

            // * relation with Question model
            $table->foreignId('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

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
        Schema::dropIfExists('answers');
    }
};
