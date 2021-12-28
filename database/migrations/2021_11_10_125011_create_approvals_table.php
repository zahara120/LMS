<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('category_trainings_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('subcategory_trainings_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            // $table->unsignedInteger('training_id')->default(0)->nullable();
            $table->string('titleTraining')->unique();
            $table->integer('quota');
            $table->mediumText('objectiveTraining');
            $table->mediumText('backgroundTraining');
            $table->text('description');
            $table->string('alasan')->nullable();
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
        Schema::dropIfExists('approvals');
    }
}