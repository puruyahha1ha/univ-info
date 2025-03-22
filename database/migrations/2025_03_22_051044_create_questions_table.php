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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('content');
            $table->text('correct_answer');
            $table->text('explanation');
            $table->unsignedBigInteger('category_id');
            $table->unsignedTinyInteger('difficulty')->default(3);
            $table->decimal('correct_rate', 5, 2)->nullable();
            $table->unsignedSmallInteger('exam_year')->nullable();
            $table->enum('question_type', ['past', 'ai_generated', 'original'])->default('original');
            $table->boolean('is_public')->default(true);
            $table->enum('answer_type', ['multiple_choice', 'descriptive', 'true_false'])->default('multiple_choice');
            $table->timestamps();
            
            $table->foreign('category_id')
                  ->references('id')
                  ->on('question_categories')
                  ->onDelete('restrict');
                  
            $table->index('category_id');
            $table->index('difficulty');
            $table->index('exam_year');
            $table->index('question_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};