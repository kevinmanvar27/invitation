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
        Schema::create('user_designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('template_id')->constrained();
            $table->string('design_name');
            $table->json('canvas_data')->nullable(); // Complete canvas JSON data
            $table->string('thumbnail_path')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->enum('status', ['draft', 'completed', 'archived'])->default('draft');
            $table->timestamps();
            
            // Add indexes for better query performance
            $table->index('user_id');
            $table->index('template_id');
            $table->index('status');
            $table->index('is_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_designs');
    }
};
