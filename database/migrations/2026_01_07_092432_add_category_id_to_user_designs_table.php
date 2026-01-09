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
        Schema::table('user_designs', function (Blueprint $table) {
            // Add category_id as nullable foreign key
            $table->unsignedBigInteger('category_id')->nullable()->after('user_id');
            
            // Add index for better query performance
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_designs', function (Blueprint $table) {
            $table->dropIndex(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
