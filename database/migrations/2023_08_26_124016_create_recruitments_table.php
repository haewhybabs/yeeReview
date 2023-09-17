<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organisation_id')->unsigned();
            $table->string('candidate_name')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->string('national_id')->nullable();
            $table->string('decision_status')->nullable();
            $table->integer('hiring_manager_id')->unsigned();
            $table->foreign('hiring_manager_id')->references('id')->on('hiring_managers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitments');
    }
};
