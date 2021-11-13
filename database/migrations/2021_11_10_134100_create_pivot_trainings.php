<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTrainings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pivot_trainings', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('approval_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('lesson_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('test_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('venue_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('provider_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_trainings');
    }
}