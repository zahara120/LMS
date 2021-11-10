<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameCategory')->unique();
            $table->timestamps();
        });

        Schema::create('subcategory_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('nameSubcategory');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('subcategory_trainings', function(Blueprint $table){
            $table->foreign('category_id')->references('id')->on('category_trainings')->onDelete('cascade')->unUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_trainings');
    }
}