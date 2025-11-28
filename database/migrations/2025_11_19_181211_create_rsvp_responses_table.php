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
        Schema::create('rsvp_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shared_invitation_id')->constrained()->onDelete('cascade');
            $table->string('guest_name');
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
            $table->enum('response', ['attending', 'not_attending', 'maybe']);
            $table->integer('plus_ones_count')->default(0);
            $table->string('meal_preference')->nullable();
            $table->text('special_requests')->nullable();
            $table->timestamp('responded_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvp_responses');
    }
};
