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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subscription_id');
            $table->string('transaction_id', 255)->unique();
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->string('currency', 3)->default('JPY');
            $table->enum('payment_method', [
                'credit_card', 'convenience_store', 'carrier_billing', 'bank_transfer'
            ]);
            $table->enum('status', [
                'pending', 'completed', 'failed', 'refunded', 'canceled'
            ])->default('pending');
            $table->dateTime('payment_date')->nullable();
            $table->json('details')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('subscription_id')
                  ->references('id')
                  ->on('subscriptions')
                  ->onDelete('cascade');
                  
            $table->index('user_id');
            $table->index('subscription_id');
            $table->index('status');
            $table->index('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};