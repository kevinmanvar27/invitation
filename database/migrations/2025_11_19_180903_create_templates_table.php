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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('template_categories');
            $table->string('theme'); // indian, christian, muslim, etc.
            $table->string('style'); // elegant, modern, rustic, etc.
            $table->enum('orientation', ['portrait', 'landscape']);
            $table->boolean('is_premium')->default(false);
            $table->decimal('price', 8, 2)->nullable();
            $table->string('thumbnail_path');
            $table->string('preview_path');
            $table->json('template_data'); // Canvas JSON structure
            $table->integer('downloads_count')->default(0);
            $table->integer('usage_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Add indexes for better query performance
            $table->index('category_id');
            $table->index('theme');
            $table->index('style');
            $table->index('orientation');
            $table->index('is_premium');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
