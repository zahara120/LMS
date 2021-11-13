<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_trainings_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('subcategory_trainings_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('nameLesson');
            $table->longText('description')->nullable();
            $table->string('file');
            $table->string('url');
            //$table->video();
            //$table->unsignedInteger('training_id')->nullable();
            //$table->boolean('publish')->default(0)->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
