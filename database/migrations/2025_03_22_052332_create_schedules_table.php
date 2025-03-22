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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->enum('repeat_type', ['none', 'daily', 'weekly', 'monthly'])->default('none');
            $table->unsignedInteger('notification_minutes')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'canceled'])->default('scheduled');
            $table->string('google_calendar_id', 255)->nullable();
            $table->enum('learning_method', ['pomodoro', 'spaced_repetition', 'intensive', 'output_focused'])->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index('user_id');
            $table->index('start_datetime');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};