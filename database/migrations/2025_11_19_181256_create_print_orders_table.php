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
        Schema::create('print_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('design_id')->constrained('user_designs');
            $table->integer('quantity');
            $table->string('paper_type');
            $table->string('finish');
            $table->string('size');
            $table->enum('orientation', ['portrait', 'landscape']);
            $table->decimal('unit_price', 8, 2);
            $table->decimal('total_price', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered'])->default('pending');
            $table->string('tracking_number')->nullable();
            $table->timestamp('ordered_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_orders');
    }
};
