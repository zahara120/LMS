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
            $table->id();

            $table->foreignId('approval_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('venue_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('room_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->foreignId('lesson_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('mandatory');
            $table->string('mandatoryTraining');
            $table->string('catatan')->nullable();
            $table->string('publish')->nullable();
            $table->date('start_date');
            $table->date('end_date');
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
    }
}