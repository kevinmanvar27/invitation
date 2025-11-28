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
        Schema::table('rsvp_settings', function (Blueprint $table) {
            $table->string('setting_name')->nullable();
            $table->text('setting_value')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rsvp_settings', function (Blueprint $table) {
            $table->dropColumn(['setting_name', 'setting_value', 'description']);
        });
    }
};
