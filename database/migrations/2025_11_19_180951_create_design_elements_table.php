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
        Schema::create('design_elements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // sticker/icon/border/motif
            $table->string('category');
            $table->string('svg_path')->nullable();
            $table->string('png_path')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_elements');
    }
};
