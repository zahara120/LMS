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
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('subcategory_id');
            // $table->unsignedInteger('training_id')->default(0)->nullable();
            $table->string('titleTraining')->unique();
            $table->boolean('status')->default(0)->nullable();
            $table->integer('quota');
            $table->mediumText('objectiveTraining');
            $table->mediumText('backgroundTraining');
            $table->text('description');
            $table->string('alasan')->nullable();
            $table->timestamps();
        });

        Schema::table('approvals', function(Blueprint $table){
            // $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->unUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('category_trainings')->onDelete('cascade')->unUpdate('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategory_trainings')->onDelete('cascade')->unUpdate('cascade');
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