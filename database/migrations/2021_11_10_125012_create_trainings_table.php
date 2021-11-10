<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('subcategory_id');
            //$table->unsignedInteger('training_id')->nullable();
            $table->string('nameLesson');
            $table->longText('description')->nullable();
            $table->string('file');
            //$table->video();
            $table->string('url');
            //$table->boolean('publish')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('type_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lesson_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('type_lessons', function(Blueprint $table){
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade')->unUpdate('cascade');
        });

        Schema::table('lessons', function (Blueprint $table) {
            //$table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->unUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('category_trainings')->onDelete('cascade')->unUpdate('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategory_trainings')->onDelete('cascade')->unUpdate('cascade');
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id');
            $table->unsignedInteger('lessons_id');
            $table->string('nameTest')->nullable();
            $table->string('typeTest');
            $table->time('timeTest');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->integer('score');
            $table->timestamps();
        });

        //pivot tabel
        Schema::create('question_test', function (Blueprint $table) {
            $table->unsignedInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade')->unUpdate('cascade');
            $table->unsignedInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->unUpdate('cascade');
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->unUpdate('cascade');
            $table->foreign('lessons_id')->references('id')->on('lessons')->onDelete('cascade')->unUpdate('cascade');
        });

        Schema::create('question_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->string('option_text');
            $table->boolean('correct')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::table('question_options', function(Blueprint $table){
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->unUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_options');
    }
}