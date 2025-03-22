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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->enum('feedback_type', ['bug', 'suggestion', 'satisfaction', 'content', 'other'])->default('other');
            $table->text('content');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->enum('status', ['new', 'in_progress', 'resolved', 'closed'])->default('new');
            $table->text('admin_response')->nullable();
            $table->dateTime('submitted_at')->useCurrent();
            $table->dateTime('resolved_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
                  
            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('set null');
                  
            $table->index('user_id');
            $table->index('question_id');
            $table->index('status');
            $table->index('feedback_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};