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
        Schema::create('shared_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('design_id')->constrained('user_designs');
            $table->foreignId('user_id')->constrained();
            $table->string('share_token')->unique();
            $table->string('share_method'); // email/social/link/qr
            $table->string('recipient_email')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->integer('view_count')->default(0);
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_invitations');
    }
};
