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
        Schema::create('user_customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('design_id')->constrained('user_designs');
            $table->foreignId('user_id')->constrained();
            $table->string('bride_name')->nullable();
            $table->string('groom_name')->nullable();
            $table->date('wedding_date')->nullable();
            $table->time('wedding_time')->nullable();
            $table->string('venue')->nullable();
            $table->json('custom_text')->nullable(); // all text fields
            $table->string('language')->default('en');
            $table->string('wording_style')->nullable();
            $table->boolean('rsvp_enabled')->default(false);
            $table->date('rsvp_deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_customizations');
    }
};
