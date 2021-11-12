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
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');

            $table->foreign('category_id')->references('id')->on('category_trainings')
            ->onDelete('cascade')
            ->unUpdate('cascade');

            $table->unsignedInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategory_trainings')
            ->onDelete('cascade')
            ->unUpdate('cascade');

            //$table->unsignedInteger('training_id')->nullable();
            $table->string('nameLesson');
            $table->longText('description')->nullable();
            $table->string('file');
            //$table->video();
            $table->string('url');
            //$table->boolean('publish')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('approval_id');
            $table->foreign('approval_id')->references('id')->on('approvals')
            ->onDelete('cascade')
            ->unUpdate('cascade');

            $table->unsignedInteger('venue_id')->nullable();
            $table->unsignedInteger('room_id')->nullable();
            
            $table->unsignedInteger('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')
            ->onDelete('cascade')
            ->unUpdate('cascade');

            $table->string('mandatory');
            $table->string('mandatoryTraining');
            $table->string('catatan')->nullable();
            $table->string('publish')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
        
        Schema::table('trainings', function (Blueprint $table) {
            $table->foreign('venue_id')->references('id')->on('venues')
            ->onDelete('cascade')
            ->unUpdate('cascade');
            
            $table->foreign('room_id')->references('id')->on('rooms')
            ->onDelete('cascade')
            ->unUpdate('cascade');
        });

        Schema::create('type_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')
            ->onDelete('cascade')
            ->unUpdate('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id');
            $table->foreign('training_id')->references('id')->on('trainings')
            ->onDelete('cascade')
            ->unUpdate('cascade');

            $table->unsignedInteger('lessons_id');
            $table->foreign('lessons_id')->references('id')->on('lessons')
            ->onDelete('cascade')
            ->unUpdate('cascade');

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

        Schema::create('question_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->unUpdate('cascade');
            $table->string('option_text');
            $table->boolean('correct')->default(0)->nullable();
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
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_options');
    }
}