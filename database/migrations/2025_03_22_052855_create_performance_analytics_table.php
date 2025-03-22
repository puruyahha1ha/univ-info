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
        Schema::create('performance_analytics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->decimal('correct_rate', 5, 2)->default(0.00);
            $table->unsignedInteger('total_questions')->default(0);
            $table->unsignedInteger('total_correct')->default(0);
            $table->decimal('average_answer_time', 10, 2)->nullable();
            $table->enum('strength_level', ['weak', 'average', 'strong'])->default('average');
            $table->unsignedInteger('total_study_time_minutes')->default(0);
            $table->date('last_study_date')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('category_id')
                  ->references('id')
                  ->on('question_categories')
                  ->onDelete('cascade');
                  
            $table->index('user_id');
            $table->index('category_id');
            $table->unique(['user_id', 'category_id']);
            $table->index('strength_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_analytics');
    }
};