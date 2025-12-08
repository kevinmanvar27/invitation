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
        Schema::create('user_design_elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_design_id')->constrained('user_designs')->onDelete('cascade');
            $table->string('element_type'); // text, image, shape, etc.
            $table->text('content')->nullable(); // text content or image URL
            $table->float('position_x')->default(0);
            $table->float('position_y')->default(0);
            $table->float('width')->default(100);
            $table->float('height')->default(100);
            $table->float('rotation')->default(0);
            $table->integer('z_index')->default(0);
            $table->json('styles')->nullable(); // font, color, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_design_elements');
    }
};
