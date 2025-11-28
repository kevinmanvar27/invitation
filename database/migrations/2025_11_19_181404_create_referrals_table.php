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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_user_id')->constrained('users');
            $table->foreignId('referred_user_id')->constrained('users');
            $table->decimal('reward_earned', 8, 2)->default(0);
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();
            
            // Add indexes for better query performance
            $table->index('status');
            $table->index('reward_earned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
