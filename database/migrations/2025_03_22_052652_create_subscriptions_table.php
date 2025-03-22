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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('plan_type', ['free', 'monthly', 'yearly', 'school'])->default('free');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'canceled', 'expired', 'trial'])->default('active');
            $table->boolean('auto_renewal')->default(true);
            $table->string('original_transaction_id', 255)->nullable();
            $table->string('latest_transaction_id', 255)->nullable();
            $table->date('trial_ends_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index('user_id');
            $table->index('status');
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};