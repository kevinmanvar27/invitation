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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 8, 2);
            $table->decimal('min_purchase', 8, 2)->nullable();
            $table->timestamp('valid_from');
            $table->timestamp('valid_until')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->timestamps();
            
            // Add indexes for better query performance
            $table->index('discount_type');
            $table->index('valid_from');
            $table->index('valid_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
