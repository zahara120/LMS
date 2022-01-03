<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('approval_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('approver_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('user_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('approversatu_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->boolean('status_satu')->default(0)->nullable();
            
            $table->foreignId('approverdua_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->boolean('status_dua')->default(0)->nullable();
            
            $table->foreignId('approvertiga_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->boolean('status_tiga')->default(0)->nullable();
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
        Schema::dropIfExists('approval_details');
    }
}
