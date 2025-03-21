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
        Schema::create('study_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->text('answer')->nullable();
            $table->boolean('is_correct')->default(true);
            $table->unsignedInteger('answer_time_seconds')->nullable();
            $table->unsignedSmallInteger('score')->nullable();
            $table->text('user_note')->nullable();
            $table->dateTime('study_datetime')->useCurrent();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('cascade');
                  
            $table->index('user_id');
            $table->index('question_id');
            $table->index('study_datetime');
            $table->index('is_correct');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_records');
    }
};