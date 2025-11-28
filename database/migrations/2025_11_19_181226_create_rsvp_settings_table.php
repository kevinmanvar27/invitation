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
        Schema::create('rsvp_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('design_id')->constrained('user_designs');
            $table->foreignId('user_id')->constrained();
            $table->boolean('rsvp_enabled')->default(false);
            $table->date('deadline')->nullable();
            $table->integer('max_guests_per_invite')->default(2);
            $table->boolean('collect_meal_preferences')->default(false);
            $table->json('custom_questions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvp_settings');
    }
};
