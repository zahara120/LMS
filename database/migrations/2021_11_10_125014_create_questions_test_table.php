<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_test', function (Blueprint $table) {
            $table->id();

            $table->foreignId('test_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('question_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('questions_test');
    }
}
