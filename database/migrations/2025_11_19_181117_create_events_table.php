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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customization_id')->constrained('user_customizations');
            $table->string('event_type');
            $table->string('event_name');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('venue_name');
            $table->text('venue_address');
            $table->string('map_link')->nullable();
            $table->string('dress_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
