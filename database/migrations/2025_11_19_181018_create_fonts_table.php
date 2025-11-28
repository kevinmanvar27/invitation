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
        Schema::create('fonts', function (Blueprint $table) {
            $table->id();
            $table->string('font_name');
            $table->string('font_family');
            $table->string('font_file_path')->nullable();
            $table->string('font_weight')->default('normal');
            $table->boolean('is_premium')->default(false);
            $table->json('language_support')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonts');
    }
};
