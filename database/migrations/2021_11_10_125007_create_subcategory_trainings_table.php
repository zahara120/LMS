<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoryTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategory_trainings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_trainings_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('nameSubcategory');
            $table->text('description');
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
        Schema::dropIfExists('subcategory_trainings');
    }
}
