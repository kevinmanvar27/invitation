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
            $table->foreignId('user_id')->constrained();
            $table->enum('plan_type', ['monthly', 'yearly', 'onetime']);
            $table->decimal('price', 8, 2);
            $table->string('currency')->default('USD');
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            $table->timestamp('started_at');
            $table->timestamp('expires_at')->nullable();
            $table->foreignId('payment_id')->nullable();
            $table->timestamps();
            
            // Add indexes for better query performance
            $table->index('user_id');
            $table->index('plan_type');
            $table->index('status');
            $table->index('payment_id');
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
