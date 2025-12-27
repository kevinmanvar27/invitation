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
        // Column has already been renamed to category_id
        // Just need to add the foreign key and index
        Schema::table('user_designs', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('template_categories')->onDelete('cascade');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_designs', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropIndex(['category_id']);
        });
    }
};
