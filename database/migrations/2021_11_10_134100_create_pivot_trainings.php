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
            $table->unsignedInteger('approval_id');
            $table->foreign('approval_id')->references('id')->on('approvals')->onDelete('cascade')->unUpdate('cascade');
            $table->unsignedInteger('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade')->unUpdate('cascade');
            $table->unsignedInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade')->unUpdate('cascade');
            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade')->unUpdate('cascade');
            $table->unsignedInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade')->unUpdate('cascade');
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