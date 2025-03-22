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
        Schema::create('user_sns_connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('sns_type', ['twitter', 'facebook', 'instagram', 'line', 'google']);
            $table->string('sns_user_id', 255);
            $table->string('access_token', 255)->nullable();
            $table->string('refresh_token', 255)->nullable();
            $table->dateTime('token_expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index('user_id');
            $table->unique(['user_id', 'sns_type']);
            $table->index('sns_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sns_connections');
    }
};