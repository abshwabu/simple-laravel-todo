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
        Schema::table('todos', function (Blueprint $table) {
            // Check if the user_id column already exists
            if (!Schema::hasColumn('todos', 'user_id')) {
                // Drop the old column if it exists
                if (Schema::hasColumn('todos', 'user')) {
                    $table->dropColumn('user');
                }
                // Add the new user_id column
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('user'); // Add back the old column if needed
        });
    }
};
